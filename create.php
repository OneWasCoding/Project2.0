<?php 
include ("includes/db.php");

if(isset($_POST['create'])){
    $fname=$_POST['firstname'];
    $lname=$_POST['lastname'];
    $email=$_POST['email'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $address=$_POST['address'];
    $age=$_POST['age'];
    $sex=$_POST['sex'];
    $filename=$_FILES['file']['name'];
    $file_tmp=$_FILES['file']['tmp_name'];
    $allowed=array('jpg','jpeg','png','gif');

$file_ext=explode('.',$filename);
$extension=strtolower(end($file_ext));

if(in_array($extension,$allowed)){
    $newfile=uniqid('',true).'.'.$extension;
    $location='uploads/'.$newfile;

    try{
        mysqli_begin_transaction($conn);
       $sq1="INSERT INTO users(username,email,password_hash,firstname,lastname,age,sex,role,profile_image,created_at)
       VALUES (?,?,?,?,?,?,?,?,?,now())";
       $role='admin';
      $stmt1=mysqli_prepare($conn,$sq1);
      mysqli_stmt_bind_param($stmt1,'sssssisss',$username,$email,$password,$fname,$lname,$age,$sex,$role,$newfile);
     if ( mysqli_stmt_execute($stmt1)){
        if(move_uploaded_file($file_tmp,$location)){
            mysqli_commit($conn);
            print "added successfully ";
            header("location:login.php");
            exit;
        }else{
            throw new Exception("file not move properly");
        }
     }else{
        throw new Exception("query not executed");
     }

      
    
    
    }catch(Exception $e){
        mysqli_rollback($conn);
        print "error: ".$e->getMessage();
    }

}else{
    print "image type not allowed ";
}



}

?>
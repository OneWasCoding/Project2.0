<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "em_quality_shoes";

$conn = mysqli_connect($servername, $username, $password, $database);

if ($conn) {
    echo"youre connected";
}
?>
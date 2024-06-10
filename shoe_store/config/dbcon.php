<?php
$host = "";
$username = "";
$password = "";
$database = "shoes";

$conn = mysqli_connect($host, $username, $password, $database);
mysqli_set_charset($conn, 'utf8');
if (!$conn) {
    die("Connection Faild " . mysqli_connect_errno());
    echo "Something Wrong";
}

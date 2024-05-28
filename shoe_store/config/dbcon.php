<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "shoe_store";

$conn = mysqli_connect($host, $username, $password, $database);
mysqli_set_charset($conn, 'utf8');
if (!$conn) {
    die("Connection Faild " . mysqli_connect_errno());
    echo "Something Wrong";
}

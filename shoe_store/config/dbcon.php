<?php
$host = "shoes-db.c6wnfmdtgzn0.us-east-1.rds.amazonaws.com";
$username = "main";
$password = "password";
$database = "shoes";

$conn = mysqli_connect($host, $username, $password, $database);
mysqli_set_charset($conn, 'utf8');
if (!$conn) {
    die("Connection Faild " . mysqli_connect_errno());
    echo "Something Wrong";
}

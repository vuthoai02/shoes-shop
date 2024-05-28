<?php
session_start();
include("../config/dbcon.php");
include("../functions/myfunctions.php");

if (isset($_POST['register-btn'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);

    //Check email already 
    $check_email_query = "SELECT email FROM users WHERE email='$email' ";
    $check_email_query_run = mysqli_query($conn, $check_email_query);
    if (mysqli_num_rows($check_email_query_run) > 0) {
        redirect("../register.php", "Your email has been used. Please use another Email");
    }
    //Check password no match
    else {
        if ($password == $cpassword) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                //Inser user data
                $pass_hash = password_hash($password, PASSWORD_DEFAULT);
                $insert_query = "INSERT INTO `users` (`name`,`email`,`phone`,`password`) VALUES ('$name','$email','$phone','$pass_hash')";
                $insert_query_run = mysqli_query($conn, $insert_query);
                if ($insert_query_run) {
                    redirect("../login.php", "Account registration successful");
                } else {
                    redirect("../register.php", "Error! An error occurred. Please try again later");
                }
            } else {
                redirect("../register.php", "Email address is not valid");
            }
        } else {
            redirect("../register.php", "Password incorrect");
        }
    }
} else if (isset($_POST['login_btn'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $login_query = "SELECT * FROM `users` WHERE `email`='$email'";
    $login_query_run = mysqli_query($conn, $login_query);

    if (mysqli_num_rows($login_query_run) > 0) {
        $userdata   =   mysqli_fetch_array($login_query_run);
        $verify = password_verify($password, $userdata['password']);
        if ($verify) {
            $_SESSION['auth'] = true;

            $userid     =   $userdata['id'];
            $username   =   $userdata['name'];
            $useremail  =   $userdata['email'];

            $_SESSION['auth_user'] = [
                'id'    =>  $userid,
                'name'  =>  $username,
                'email' =>  $useremail
            ];
            redirect("../index.php", "Logged in successfully");
        } else {
            redirect("../login.php", "Incorrect password");
        }
    } else {
        redirect("../login.php", "Email account does not exist");
    }
}
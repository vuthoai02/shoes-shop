<?php
session_start();
include("./functions/userfunctions.php");
if (isset($_SESSION['auth'])) {
    unset($_SESSION['auth']);
    unset($_SESSION['auth_user']);
    redirect("login.php", "Signed out successfully");
}
header('Location: index.php');
include("./includes/footer.php");

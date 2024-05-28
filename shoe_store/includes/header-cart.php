<?php
session_start();
include("./functions/userfunctions.php");
$search =   "";
$page   =   1;
$type   =   "";

if (isset($_GET["search"])) {
    $search    = $_GET["search"];
}
if (isset($_GET["type"])) {
    $type        = $_GET["type"];
}
if (isset($_GET["page"])) {
    $page        = $_GET["page"];
}

$page = $page - 1;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SNEAKER-STORE</title>
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <!-- app css -->
    <link rel="stylesheet" href="./assets/css/reponsive.css">
    <link rel="stylesheet" href="./assets/css/grid.css">
    <link rel="stylesheet" href="./assets/css/app.css">
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <!-- mobile menu -->
    <div class="mobile-menu bg-second">
        <a href="#" class="mb-logo">
            <img style="width:170px; height: 80px;" src="./images/logo-web.png" alt="">
        </a>
        <span class="mb-menu-toggle" id="mb-menu-toggle">
            <i class='bx bx-menu'></i>
        </span>
    </div>
    <!-- end mobile menu -->

    <!-- main header -->
    <div class="header-wrapper" id="header-wrapper">
        <span class="mb-menu-toggle mb-menu-close" id="mb-menu-close">
            <i class='bx bx-x'></i>
        </span>
        <!-- top header -->
        <div class="bg-main">
            <div class="mid-header container">
                <a href="index.php" class="logo">
                    <img style="width:170px; height: 80px;" src="./images/logo-web.png" alt="">
                </a>
                <ul class="user-menu">
                    <li><a href="#"><i class='bx bx-bell'></i></a></li>
                    <?php
                    if (isset($_SESSION['auth'])) {
                        $users = getAll("users");
                        $row = mysqli_fetch_array($users);
                    ?>
                        <li class="mega-dropdown">
                            <a href="#"><i class='bx bx-user-circle'></i></a>
                            <div class="mega-content" style="width: auto;display: inline-block;right: 0;">
                                <div class="row">
                                    <div class="box">
                                        <h3>Wellcome <?= $_SESSION['auth_user']['name'] ?>!</h3>
                                        <ul>
                                            <li><a href="logout.php">logout</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="mega-dropdown">
                            <a href="#"><i class='bx bx-user-circle'></i></a>
                            <div class="mega-content">
                                <div class="row">
                                    <div class="box">
                                        <ul>
                                            <li><a href="login.php">Login</a></li>
                                            <li><a href="register.php">Register</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php
                    }
                    ?>
                    <li><a href="./cart.php"><i class='bx bx-cart'></i></a></li>
                </ul>
            </div>
        </div>

        <!-- menu-main -->
        <div class="bg-second">
            <div class="bottom-header container">
                <ul class="main-menu">
                    <li><a href="index.php">Home page</a></li>
                    <!-- mega menu -->
                    <li class="mega-dropdown">
                        <a href="index.php">Categories<i class='bx bxs-chevron-down'></i></a>
                        <div class="mega-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box">
                                        <ul>
                                            <?php
                                            $categories = getAllActive("categories");

                                            if (mysqli_num_rows($categories) > 0) {
                                                foreach ($categories as $item) {
                                            ?>
                                                    <li><a href="./products.php?type=<?= $item['slug'] ?>"><?= $item['name']; ?></a></li>
                                            <?php
                                                }
                                            } else {
                                                echo "no";
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- end mega menu -->
                </ul>
            </div>
        </div>
    </div>
</head>
<?php
include("./includes/header.php");

?>
<script src="../assets/js/boostrap.bundle.js"></script>
<link rel="stylesheet" href="./assets/css/author.css">
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h1 style="color:white ;">Login</h1>
                    </div>
                    <div class="card-body">
                        <form action="./functions/authcode.php" method="POST">
                            <div class="mb-3">
                                <b><label for="exampleInputEmail1" class="form-label">Email</label></b>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Email">
                            </div>
                            <div class="mb-3">
                                <b><label for="exampleInputPassword1" class="form-label">Password</label></b>
                                <input type="password" name="password" class="form-control" placeholder="Enter password">
                            </div>
                            <button type="submit" name="login_btn" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("./includes/footer.php") ?>
<?php
include("./includes/header-cart.php");
include("./model/order.php");
if (!isset($_SESSION['auth_user']['id'])) {
    die("Bạn chưa đăng nhập tài khoản. <a style='color: red;' href='./login.php'>Đăng nhập ngay</a>");
}
?>

<style>
    th,
    td {
        padding: 5px;
        text-align: center;
    }

    .input-number {
        width: 100%;
        font-size: 20px;
        outline: none;
        border: none;
    }

    .btn-buy {
        border: none;
        outline: none;
        font-size: 17px;
        cursor: pointer;
        padding: 5px 10px;
        border-radius: 2px;
        background-color: #59e1ff;
    }

    .model-body {
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 5px;
        max-width: 400px;
        margin: 0 auto;
    }

    .model-body img {
        display: block;
        margin: 0 auto 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .btn-group {
        margin-top: 20px;
        text-align: center;
    }

    input:invalid {
        border-color: red;
    }

    input:valid {
        border-color: green;
    }

    #confirmation-tab {
        display: none;
        border: 1px solid #ccc;
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 5px;
        margin-top: 20px;
    }

    #confirmation-tab p {
        margin-bottom: 10px;
    }

    #confirm-button {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    #confirm-button:hover {
        background-color: #45a049;
    }

    .btn-disable {
        display: block;
        padding: 5px 10px;
        background-color: #959595;
        pointer-events: none;
        margin: 0 auto;
    }

    .min-height {
        min-height: 430px;
    }

    .product-info {
        position: relative;
        top: 50px;
    }
</style>

<body>
    <!-- product-detail content -->
    <div styles="min-height: 500px" class="min-height">
        <div class="bg-main">
            <div class="container min-height">
                <div class="box">
                    <div class="breadcumb">
                        <a href="index.php">Home page</a>
                        <span><i class='bx bxs-chevrons-right'></i></span>
                        <a href="#">My cart</a>
                    </div>
                </div>

                <div class="box" style="padding: 0 40px">
                    <div class="product-info">
                        <?php
                        if (!isset($_SESSION['cart'])) {
                        ?>
                            <p style="font-size: 20px; text-align: center;">
                                Your shopping cart is empty. Buy now <a style="color: blue; text-decoration: underline" href="./products.php">here</a>
                            </p>
                            <button class="btn-disable">Order</button>
                        <?php } else { ?>
                            <table width="100%" border="1" cellspacing="0">
                                <tr>
                                    <th>Image</th>
                                    <th>Product name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                    <th>Update</th>
                                </tr>
                                <?php
                                $total_price = 0;
                                foreach ($_SESSION['cart'] as $serializedProduct) {
                                    $product = unserialize($serializedProduct);
                                ?>
                                    <tr>
                                        <td>
                                            <img src="./images/<?= $product->image ?>" alt="" width="100">
                                        <td style="text-align: left;">
                                            <a href="./product-detail.php?slug=<?= $product->slug ?>">
                                                <?= $product->name ?>
                                            </a>
                                        </td>
                                        <form action="./functions/ordercode.php" method="post">
                                            <td width=100>
                                                <input type="hidden" name="update_product" value="true">
                                                <input type="hidden" name="product_id" value="<?= $product->product_id ?>">
                                                <input type="hidden" class="product-price" value="<?= $product->selling_price ?>">
                                                <input type="number" name="quantity" value="<?= $product->quantity ?>" class="input-number">
                                            </td>
                                            <td>
                                                $
                                                <span>
                                                    <?= $product->selling_price ?>
                                                </span>
                                            </td>
                                            <td>
                                                $
                                                <span class="total-price">
                                                    <?= $product->selling_price * $product->quantity ?>
                                                </span>
                                            </td>
                                            <td>
                                                <a class="btn-buy" style="font-size: 15px; background-color: #fc8d8b" href="./functions/ordercode.php?deleteID=<?= $product->product_id ?>">Delete</a>
                                            </td>
                                            <td>
                                                <button class="btn-buy">Check</button>
                                            </td>
                                        </form>
                                    </tr>
                                <?php
                                    $total_price +=  $product->selling_price * $product->quantity;
                                }
                                ?>
                            </table>
                            <div class="form-pay">
                                <span>Total amount: $<?= $total_price ?></span>
                                <button class="btn-model">Order</button>
                                <form action="./functions/ordercode.php" method="post">
                                    <input type="hidden" name="delete_all" value="true">
                                    <button type="submit" class="btn-buy" style="background-color: #ff5959;">Delete all</button>
                                </form>
                                <div class="model <?php echo isset($_SESSION['show_modal']) && $_SESSION['show_modal'] ? 'show' : 'none'; ?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Notification</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeModal()"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Your order has been approved. Please check Email for more details.</p>
                                                <img class="img-check" src="./images/check.png" alt="check-mark"/>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="./functions/ordercode.php" method="post">
                                                    <input type="hidden" name="close_model" value="true">
                                                    <button type="submit" class="btn btn-secondary" style="background-color: #ff5959; margin-bottom:20px;">OK</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="model model-form none">
                                    <div class="model-body">
                                        <form action="./functions/ordercode.php" method="post" id="shipping-form">
                                            <input type="hidden" name="buy_product" value="true">
                                            <div class="form-group">
                                                <label for="name">Fullname:</label>
                                                <input type="text" class="form-control" id="name" name="name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="address">Address:</label>
                                                <input type="text" class="form-control" id="address" name="address" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="city">City/Suburbs:</label>
                                                <input type="text" class="form-control" id="city" name="city" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="state">State/Territory:</label>
                                                <select class="form-control" id="state" name="state" required>
                                                    <option value="NSW">NSW</option>
                                                    <option value="VIC">VIC</option>
                                                    <option value="QLD">QLD</option>
                                                    <option value="WA">WA</option>
                                                    <option value="SA">SA</option>
                                                    <option value="TAS">TAS</option>
                                                    <option value="ACT">ACT</option>
                                                    <option value="NT">NT</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Phone number:</label>
                                                <input type="tel" class="form-control" id="phone" name="phone" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email:</label>
                                                <input type="email" class="form-control" id="email" name="email" required>
                                            </div>
                                            <button id="btn-send" type="submit" class="btn btn-primary">Send</button>
                                        </form>
                                        <div class="btn-group">
                                            <button class="close-model">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end product-detail content -->
    <?php include("./includes/footer.php") ?>
    <script src="./assets/js/app.js"></script>
    <script src="./assets/js/index.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>
<script>
    $(document).ready(function() {
        $('.input-number').on('change', function(e) {
            if (e.target.value == 0) {
                e.target.value = 1;
            }
            const node = $(this).parent().parent();
            const price = parseInt(node.find('.product-price').val());
            let total_order = parseInt(e.target.value);
            let total_price = price * total_order;
            node.find('.total-price').html(total_price);
        });

        $(document).on('click', '.btn-model', function(event) {
            event.preventDefault();

            $('.model-form').css('display', 'flex');
        });

        $(document).on('click', '#close-model', function(event) {
            event.preventDefault();

            $('.model-form').css('display', 'none');
        });

    });
</script>

</html>
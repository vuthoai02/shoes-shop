<?php
include("./includes/header.php");
$bestSellingProducts    =   getBestSelling(8);
$LatestProducts         =   getLatestProducts(8);
?>

<body>
    <style>
        .product-availability {
            font-weight: bold;
        }

        .available {
            color: green;
        }

        .out-of-stock {
            color: red;
        }
    </style>
    <!-- product list -->
    <div class="section">
        <div class="container">
            <div class="section-header">
                <h2>Latest products</h2>
            </div>
            <div class="row" id="latest-products">
                <?php
                foreach ($LatestProducts as $product) {
                    // Kiểm tra số lượng sản phẩm
                    $quantity = getQuantity($product['id']);
                    $availability = $quantity > 0 ? "Stocking" : "Out of stock";
                ?>
                    <div class="col-3 col-md-6 col-sm-12">
                        <div class="product-card">
                            <div class="product-card-img">
                                <img src="./images/<?= $product['image'] ?>" alt="">
                                <img src="./images/<?= $product['image'] ?>" alt="">
                            </div>
                            <div class="product-availability <?= $quantity > 0 ? 'available' : 'out-of-stock' ?>">
                                <?= $availability ?>
                            </div>
                            <div class="product-card-info">
                                <div class="product-btn">
                                    <a href="./product-detail.php?slug=<?= $product['slug'] ?>">
                                        <button class="btn-flat btn-hover btn-shop-now">See detail</button>
                                    </a>
                                    <form method="POST" action="./functions/ordercode.php">
                                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                        <input type="hidden" name="quantity" value="1">
                                        <input type="hidden" name="order" value="true">
                                        <button class="btn-flat btn-hover btn-cart-add" <?php if ($quantity < 1) echo "style='pointer-events: none; background-color: #959595;border-color:#959595;'"; ?>>
                                            <i class='bx bxs-cart-add'></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="product-card-name">
                                    <?= $product['name'] ?>
                                </div>
                                <div class="product-card-price">
                                    <span><del>$ <?= $product['original_price'] ?></del></span>
                                    <span class="curr-price">$ <?= $product['selling_price'] ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="section-footer">
                <a href="./products.php" class="btn-flat btn-hover">See all</a>
            </div>
        </div>
    </div>
    <!-- end product list -->

    <!-- product list -->
    <div class="section">
        <div class="container">
            <div class="section-header">
                <h2>Best selling products</h2>
            </div>
            <div class="row" id="best-products">
                <?php
                foreach ($bestSellingProducts as $product) {
                    $quantity = getQuantity($product['id']);
                    $availability = $quantity > 0 ? "Stocking" : "Out of stock";
                ?>
                    <div class="col-3 col-md-6 col-sm-12">
                        <div class="product-card">
                            <div class="product-card-img">
                                <img src="./images/<?= $product['image'] ?>" alt="">
                                <img src="./images/<?= $product['image'] ?>" alt="">
                            </div>
                            <div class="product-availability <?= $quantity > 0 ? 'available' : 'out-of-stock' ?>">
                                <?= $availability ?>
                            </div>
                            <div class="product-card-info">
                                <div class="product-btn">
                                    <a href="./product-detail.php?slug=<?= $product['slug'] ?>">
                                        <button class="btn-flat btn-hover btn-shop-now">See detail</button>
                                    </a>
                                    <form method="POST" action="./functions/ordercode.php">
                                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                        <input type="hidden" name="quantity" value="1">
                                        <input type="hidden" name="order" value="true">
                                        <button class="btn-flat btn-hover btn-cart-add" <?php if ($quantity < 1) echo "style='pointer-events: none; background-color: #959595;border-color:#959595;'"; ?>>
                                            <i class='bx bxs-cart-add'></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="product-card-name">
                                    <?= $product['name'] ?>
                                </div>
                                <div class="product-card-price">
                                    <span><del>đ <?= $product['original_price'] ?></del></span>
                                    <span class="curr-price">đ <?= $product['selling_price'] ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="section-footer">
                <a href="./products.php" class="btn-flat btn-hover">See all</a>
            </div>
        </div>
    </div>
    <!-- end product list -->

    <?php include("./includes/footer.php") ?>
    <script src="./assets/js/app.js"></script>
    <script src="./assets/js/index.js"></script>
</body>

</html>
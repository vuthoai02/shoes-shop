<?php
session_start();
include("../config/dbcon.php");
include("../functions/myfunctions.php");
include("../model/order.php");

if (isset($_POST['order'])) {
    $user_id    = $_SESSION['auth_user']['id'];
    $product_id = $_POST['product_id'];
    $quantity   = $_POST['quantity'];

    $product = getByID("products", $product_id);
    if (mysqli_num_rows($product) > 0) {
        $product_row = mysqli_fetch_array($product);
        $slug = $product_row['slug'];
        $image = $product_row['image'];
        $name = $product_row['name'];
        $selling_price = $product_row['selling_price'];

        if ($quantity != "" && $quantity <= $product_row['qty']) {
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = array();
            } else {
                $productExists = null;
                foreach ($_SESSION['cart'] as $key => $serializedProduct) {
                    $a_product = unserialize($serializedProduct);
                    if ($a_product->product_id == $product_id) {
                        $productExists = $a_product;
                        unset($_SESSION['cart'][$key]);
                        break;
                    }
                }
                if ($productExists != null) {
                    $productExists->quantity += $quantity;
                    $serializedProduct = serialize($productExists);
                    $_SESSION['cart'][] = $serializedProduct;
                } else {
                    $new_product = new Order($user_id, $product_id, $selling_price, $quantity, $image, $slug, $name);
                    $serializedProduct = serialize($new_product);
                    $_SESSION['cart'][] = $serializedProduct;
                }
                $_SESSION['message'] = "Add product to cart successfully";
                header("Location: ../product-detail.php?slug=$slug");
            }
        } else {
            $_SESSION['message'] = "Product quantity does not match";
            header("Location: ../product-detail.php?slug=$slug");
        }
    } else {
        $_SESSION['message'] = "An unexpected error has occurred";
        header("Location: ../products.php");
    }
} else if (isset($_GET['deleteID'])) {
    $delete_id = $_GET['deleteID'];
    foreach ($_SESSION['cart'] as $key => $serializedProduct) {
        $product = unserialize($serializedProduct);
        if ($product->product_id == $delete_id) {
            unset($_SESSION['cart'][$key]);
            if (empty($_SESSION['cart'])) {
                unset($_SESSION['cart']);
            }
            break;
        }
    }
    $_SESSION['message'] = "Product deletion successful";
    header("Location: ../cart.php");
} else if (isset($_POST['delete_all'])) {
    unset($_SESSION['cart']);
    $_SESSION['message'] = "All products in the cart have been removed";
    header("Location: ../index.php");
} else if (isset($_POST['update_product'])) {
    $user_id    = $_SESSION['auth_user']['id'];
    $product_id = $_POST['product_id'];
    $quantity   = $_POST['quantity'];

    $query          = "SELECT `qty` FROM `products` WHERE `id` = '$product_id'";
    $total_quantity = mysqli_fetch_array(mysqli_query($conn, $query))['qty'];

    if ($total_quantity > $quantity) {
        foreach ($_SESSION['cart'] as $key => $serializedProduct) {
            $product = unserialize($serializedProduct);
            if ($product->product_id == $product_id) {
                $old_product = $product;
                unset($_SESSION['cart'][$key]);
                $old_product->quantity = $quantity;
                $_SESSION['cart'][] = serialize($old_product);
                break;
            }
        }
        $_SESSION['message'] = "Product updated successfully";
    } else {
        $_SESSION['message'] = "Product quantity is not enough";
    }

    header("Location: ../cart.php");
} else if (isset($_POST['buy_product'])) {
    if (isset($_SESSION['cart'])) {
        $user_id    = $_SESSION['auth_user']['id'];
        $product_available_quantities = array();
        $query = "SELECT `qty`,`id` FROM products";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $product_available_quantities[$row['id']] = $row['qty'];
        }
        foreach ($_SESSION['cart'] as $serializedProduct) {
            $product = unserialize($serializedProduct);
            if ($product->quantity > $product_available_quantities[$product->product_id]) {
                $_SESSION['message'] = "The number of products in the shopping cart exceeds the quantity available in stock.";
                header("Location: ../cart.php");
            }
        }
        if (isset($_POST['buy_product'])) {
            $insert_query = "INSERT INTO `orders`(`user_id`) VALUES ('$user_id')";
            $insert_query_run = mysqli_query($conn, $insert_query);
            $order_id = $conn->insert_id;

            if (isset($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $serializedProduct) {
                    $product = unserialize($serializedProduct);
                    $query = "INSERT INTO `order_detail`(`order_id`,`user_id`,`product_id`,`selling_price`,`quantity`) VALUE ('$order_id','$user_id', '$product->product_id', '$product->selling_price', '$product->quantity')";
                    mysqli_query($conn, $query);
                }
            }
            foreach ($_SESSION['cart'] as $serializedProduct) {
                $product = unserialize($serializedProduct);
                $qty = $product_available_quantities[$product->product_id] - $product->quantity;
                $query = "UPDATE `products` SET `qty` = '$qty' WHERE `id` = '$product->product_id'";
                mysqli_query($conn, $query);
            }
            $_SESSION['show_modal'] = true;
            $_SESSION['message'] = "Buy the product successfully";
            header("Location: ../cart.php");
        }
    } else {
        $_SESSION['message'] = "Không tìm thấy thông tin giỏ hàng";
        header("Location: ../cart.php");
    }
} else if (isset($_POST['close_model'])) {
    unset($_SESSION['cart']);
    unset($_SESSION['show_modal']);
    header("Location: ../cart.php");
}

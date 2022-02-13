<?php
// $productid = mysqli_real_escape_string($conn, $productid);
// $customer_id = mysqli_real_escape_string($conn, $customer_id);

// Nếu typeId = 1 thì thêm vào wishlist ngược lại thì xóa wishlist
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../lib/session.php';
    include_once "../classes/cart.php";
    Session::init();
    $productId = $_POST['productId'];
    $customer_id = Session::get('customer_id');

    if (isset($_SESSION['customer_login'])) {
        $ct = new cart();
        echo $ct->add_to_wishlist($productId, $customer_id);
    } else {
        if (isset($_COOKIE["shopping_wishlist"])) {
            $cookie_data = stripslashes($_COOKIE['shopping_wishlist']);
            $wishlist_data = json_decode($cookie_data, true);

            // Delete wishlist cookie
            foreach ($wishlist_data as $keys => $values) {
                if ($wishlist_data[$keys]['productId'] == $productId) {
                    unset($wishlist_data[$keys]);
                    $item_data = json_encode($wishlist_data);

                    $name = "shopping_wishlist";
                    $value = $item_data;
                    $expire = time() + 365 * 24 * 60 * 60;
                    $path = '/';
                    setcookie($name, $value, $expire, $path);
					echo json_encode($result_json[][] = ['status' => 3]);
                    exit;
                }
            }

            $item_array = array(
                'productId' => (int)$productId,
            );

            // add wishlist cookiee
            $wishlist_data[] = $item_array;
            $item_data = json_encode($wishlist_data);

            $name = "shopping_wishlist";
            $value = $item_data;
            $expire = time() + 365 * 24 * 60 * 60;
            $path = '/';
            setcookie($name, $value, $expire, $path);
            echo json_encode($result_json[][] = ['status' => 1]);
            exit;
        } else {
            $wishlist_data = array();

            $item_array = array(
                'productId' => (int)$productId,
            );

            // add wishlist cookiee
            $wishlist_data[] = $item_array;
            $item_data = json_encode($wishlist_data);

            $name = "shopping_wishlist";
            $value = $item_data;
            $expire = time() + 365 * 24 * 60 * 60;
            $path = '/';
            setcookie($name, $value, $expire, $path);
            echo json_encode($result_json[][] = ['status' => 1]);
            exit;
        }
    }
} else {
    header("location:../404.php");
}

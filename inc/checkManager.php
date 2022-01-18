<?php

// begin init category
if (!isset($_SESSION['menuCategoryStatus'])) {
    $show_category_img = $cat->show_category_img();

    if ($show_category_img) {
        // Trạng thái đã có sesstion menuCategory
        session::set("menuCategoryStatus", true);
        $menuCategory = array();
        while ($result = $show_category_img->fetch_assoc()) {
            $session_catId = $result['catId'];
            $session_catName = $result['catName'];
            $session_product_img =  json_decode($result['image']);
            $session_product_img = $session_product_img[0]->image;

            $menuCategory = ['catId' => $session_catId, 'catName' => $session_catName, 'product_img' => $session_product_img];
            $_SESSION['menuCategory'][] = $menuCategory;
        }
    }
}

// Check login
if (isset($_SESSION['customer_login'])) {
    $login_check = Session::get('customer_login');
    // check hiển thị thông báo đăng nhập
    if (isset($_SESSION['loginAlert'])) {
        $loginAlert = Session::get('loginAlert');
        Session::set('loginAlert', false);
        if ($loginAlert == true) {
            echo '<script>var loginAlert = true;</script>';
        } else {
            echo '<script>var loginAlert = false;</script>';
        }
    } else {
        echo '<script>var loginAlert = false;</script>';
    }
} else {
    if (isset($_COOKIE['is_login'])) {
        $login_cookie = $cs->login_cookie();
        // if ($login_cookie == true) {
        //     echo '<script>var loginAlert = true;</script>';
        // } else {
        //     echo '<script>var loginAlert = false;</script>';
        // }
    } else {
        echo '<script>var loginAlert = false;</script>';
    }
}

//Loout
if (isset($_GET['customer_id'])) {
    $customer_id = $_GET['customer_id'];
    // $delCart = $ct->del_all_data_cart($customer_id);
    setcookie('is_login', '', time() - 3600, '/');
    Session::destroy();
}

// header("Cache-Control: no-cache, must-revalidate");
// header("Pragma: no-cache");
// header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
// header("Cache-Control: max-age=2592000");

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
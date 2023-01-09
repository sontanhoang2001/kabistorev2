<?php
if (isset($_POST)) {
    include_once '../lib/session.php';
    include_once "../classes/customer.php";

    Session::init();
    $cs = new customer;
    $id = Session::get('customer_id');

    // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
    echo $UpdateCustomers = $cs->update_avatar($_POST, $id); // hàm check catName khi submit lên
} else {
    header("location:../404.php");
}

// if (isset($_POST) && $_FILES['avatar']['name']) {
//     include_once '../lib/session.php';
//     include_once "../classes/customer.php";

//     Session::init();
//     $cs = new customer;
//     $id = Session::get('customer_id');

//     // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
//     if ($_FILES['avatar']['name'] != null) {
//         echo $UpdateCustomers = $cs->update_avatar($_POST, $id); // hàm check catName khi submit lên
//     }
// } else {
//     header("location:../404.php");
// }
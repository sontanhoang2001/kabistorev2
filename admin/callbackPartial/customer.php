<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../../classes/customer.php';
    $cs = new customer();
    $customerId = $_POST['customerId'];
    $get_customer = $cs->show_customers($customerId);
    if ($get_customer) {
        while ($result = $get_customer->fetch_assoc()) {
            $username = $result['username'];
            $name = $result['name'];
            $avatar = $result['avatar'];
            $date_of_birth = $result['date_of_birth'];
            $gender = $result['gender'];
            $phone = $result['phone'];
            $email = $result['email'];
            $maps_maplat = $result['maps_maplat'];
            $maps_maplng = $result['maps_maplng'];
            $date_Joined = $result['date_Joined'];
        }
        echo json_encode($result_json[] = ['status' => 1, 'username' => $username, 'name' => $name, 'avatar' => $avatar, 'date_of_birth' => $date_of_birth, 'gender' => $gender, 'phone' => $phone, 'email' => $email, 'maps_maplat' => $maps_maplat, 'maps_maplng' => $maps_maplng, 'date_Joined' => $date_Joined]);
    }
}

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../lib/session.php';
    include '../config/global.php';
    Session::init();

    $locationCode = $_POST['locationCode'];
    $objPriceShip = json_decode($dataPriceShip);
    $priceShip =  $objPriceShip[0]->$locationCode;

    $quantityTotal = $_POST['quantityTotal'];
    $discount = session::get('discountMoney');
    $subtotal =  Session::get('sum');

    $grandTotal = $subtotal + $priceShip;
    $priceShip =  (int)$priceShip + (int)$shipAdd * ((int)$quantityTotal - 1);
    Session::set('ship', $priceShip);

    Session::set('grandTotal', $grandTotal - $discount);
    echo json_encode($result_json[] = ['priceShip' => $priceShip, 'grandTotal' => $grandTotal - $discount]);
}

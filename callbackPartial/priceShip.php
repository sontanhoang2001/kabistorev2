<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../lib/session.php';
    include '../config/global.php';
    Session::init();

    $locationCode = $_POST['locationCode'];
    $objPriceShip = json_decode($dataPriceShip);
    // đưa Vị trí giao hàng -> giá ship
    // $priceShip =  $objPriceShip[0]->$locationCode;
    $quantityTotal = $_POST['quantityTotal'];
    $brandLocaltion = $_POST['brandLocaltion'];
    $Localtion = 0;
    foreach ($brandLocaltion as $localtion) {
        $Localtion = (int)$Localtion + (int)$localtion;
    }


    if ($locationCode != "international") {
        // nếu đặt hàng ở CT, VL thì cộng 2 giá ship lại
        if ($Localtion == 37) {
            if ($locationCode == "ngoaivung") {
                $priceShipMain =  $objPriceShip[0]->ngoaivung;
                $priceShip = $priceShipMain;

                if ($quantityTotal > 3) {
                    $priceShip = (int)$priceShip * (int)$quantityTotal - ((int) $quantityTotal * 15000);
                } else {
                    $shipAdd = 3500;
                    $priceShip =  (int)$priceShip + (int)$shipAdd * ((int)$quantityTotal - 1) * 2;
                }
            } else {
                $priceShip =  $objPriceShip[0]->main_ship;

                if ($quantityTotal > 3) {
                    $priceShip = (int)$priceShip * (int)$quantityTotal - ((int) $quantityTotal * 15000);
                } else {
                    $shipAdd = 3500;
                    $priceShip =  (int)$priceShip + (int)$shipAdd * ((int)$quantityTotal - 1) * 2;
                }
            }
        } elseif ($Localtion == 18) {
            // Ưu tiên VLiem
            switch ($locationCode) {
                case "cantho": {
                        $priceShip =  $objPriceShip[0]->main_ship;
                        if ($quantityTotal > 3) {
                            $priceShip = (int)$priceShip * (int)$quantityTotal - ((int) $quantityTotal * 15000);
                        } else {
                            $shipAdd = 3500;
                            $priceShip =  (int)$priceShip + (int)$shipAdd * ((int)$quantityTotal - 1);
                        }
                        break;
                    }
                case "vinhlong": {
                        $priceShip =  $objPriceShip[0]->main_ship;
                        if ($quantityTotal > 3) {
                            $priceShip = (int)$priceShip * (int)$quantityTotal - ((int) $quantityTotal * 15000);
                        } else {
                            $shipAdd = 3500;
                            $priceShip =  (int)$priceShip + (int)$shipAdd * ((int)$quantityTotal - 1);
                        }
                        break;
                    }
                case "vungliem": {
                        $priceShip =  $objPriceShip[0]->vungliem;
                        if ($quantityTotal > 3) {
                            $priceShip = (int)$priceShip * (int)$quantityTotal - ((int) $quantityTotal * 3000);
                        } else {
                            $priceShip =  (int)$priceShip + (int)$shipAdd * ((int)$quantityTotal - 1);
                        }
                        break;
                    }
                default: {
                        $priceShip =  $objPriceShip[0]->ngoaivung;
                        if ($quantityTotal > 3) {
                            $priceShip = (int)$priceShip * (int)$quantityTotal - ((int) $quantityTotal * 3000);
                        } else {
                            $priceShip =  (int)$priceShip + (int)$shipAdd * ((int)$quantityTotal - 1);
                        }
                    }
            }
        } elseif ($Localtion == 19) {
            // ưu tiên CT
            switch ($locationCode) {
                case "cantho": {
                        $priceShip =  $objPriceShip[0]->cantho;
                        if ($quantityTotal > 3) {
                            $priceShip = (int)$priceShip * (int)$quantityTotal - ((int) $quantityTotal * 3000);
                        } else {
                            $priceShip =  (int)$priceShip + (int)$shipAdd * ((int)$quantityTotal - 1);
                        }
                        break;
                    }
                case "vinhlong": {
                        $priceShip =  $objPriceShip[0]->main_ship;
                        if ($quantityTotal > 3) {
                            $priceShip = (int)$priceShip * (int)$quantityTotal - ((int) $quantityTotal * 15000);
                        } else {
                            $shipAdd = 3500;
                            $priceShip =  (int)$priceShip + (int)$shipAdd * ((int)$quantityTotal - 1);
                        }
                        break;
                    }
                case "vungliem": {
                        $priceShip =  $objPriceShip[0]->main_ship;
                        if ($quantityTotal > 3) {
                            $priceShip = (int)$priceShip * (int)$quantityTotal - ((int) $quantityTotal * 15000);
                        } else {
                            $shipAdd = 3500;
                            $priceShip =  (int)$priceShip + (int)$shipAdd * ((int)$quantityTotal - 1);
                        }
                        break;
                    }
                default: {
                        $priceShip =  $objPriceShip[0]->ngoaivung;
                        if ($quantityTotal > 3) {
                            $priceShip = (int)$priceShip * (int)$quantityTotal - ((int) $quantityTotal * 3000);
                        } else {
                            $priceShip =  (int)$priceShip + (int)$shipAdd * ((int)$quantityTotal - 1);
                        }
                    }
            }
        }
    } else {
        $priceShip =  $objPriceShip[0]->international;
        $shipAdd = 30000;
        $priceShip =  (int)$priceShip + (int)$shipAdd * ((int)$quantityTotal - 1);
    }

    $discount = session::get('discountMoney');
    $subtotal =  Session::get('sum');

    // $priceShip =  (int)$priceShip + (int)$shipAdd * ((int)$quantityTotal - 1);
    $grandTotal = $subtotal + $priceShip;

    Session::set('ship', $priceShip);

    Session::set('grandTotal', $grandTotal - $discount);
    echo json_encode($result_json[] = ['priceShip' => $priceShip, 'grandTotal' => $grandTotal - $discount]);
}

function localtionPriceShip($localtion, $objPriceShip, $locationCode)
{
    // find Can Tho
    if ($locationCode == "cantho") {
        //find Vĩnh Long
        if ($localtion == "vinhlong") {
            return  $objPriceShip[0]->ngoaivung;
        } else {
            // find vũng liêm
            if ($localtion == "vungliem") {
                return $objPriceShip[0]->vinhlong;
            } else {
                return $objPriceShip[0]->vungliem;
            }
        }
    } else {
        return $objPriceShip[0]->cantho;
    }
}

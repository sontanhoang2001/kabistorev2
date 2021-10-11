<?php

include 'lib/Social-Network-API/Facebook/autoload.php';
include('lib/Social-Network-API/fbconfig.php');
$helper = $fb->getRedirectLoginHelper();
if (isset($_GET['state'])) {
    $helper->getPersistentDataHandler()->set('state', $_GET['state']);
}
try {
    $accessToken = $helper->getAccessToken();
} catch (Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch (Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

if (!isset($accessToken)) {
    if ($helper->getError()) {
        header('HTTP/1.0 401 Unauthorized');
        echo "Error: " . $helper->getError() . "\n";
        echo "Error Code: " . $helper->getErrorCode() . "\n";
        echo "Error Reason: " . $helper->getErrorReason() . "\n";
        echo "Error Description: " . $helper->getErrorDescription() . "\n";
    } else {
        header('HTTP/1.0 400 Bad Request');
        echo 'Bad request';
    }
    exit;
}

//Lấy thông tin của người dùng trên Facebook
try {
    // Returns a `Facebook\FacebookResponse` object
    // $response = $fb->get('/me?fields=id,name,email', $accessToken->getValue());
    //var_dump($response);exit;

    $fb_response = $fb->get('/me?fields=name,first_name,last_name,email', $accessToken->getValue());
    // $fb_response_picture = $fb->get('/me/picture?redirect=false&height=200', $accessToken->getValue());

    // $fb_response_getBirthday = $fb->get('/me?birthday', $accessToken->getValue());
    // $fb_user = $fb_response->getGraphUser();
    // $picture = $fb_response_picture->getGraphUser();

    // echo $_SESSION['fb_user_id'] = $fb_user->getProperty('id');
    // echo $_SESSION['fb_user_name'] = $fb_user->getProperty('name');
    // echo $_SESSION['fb_user_email'] = $fb_user->getProperty('email');
    // echo $_SESSION['fb_user_pic'] = $picture['url'];
} catch (Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

$fbUser = $fb_response->getGraphUser();

if (!empty($fbUser)) {
    // include 'lib/Social-Network-API/function.php';
    include 'lib/session.php';
    Session::init();
    include_once "classes/customer.php";
    $cs = new customer();
    echo $customer = $cs->loginFromSocialCallBack($fbUser, $accessToken->getValue());
}

// echo '<img src="https://graph.facebook.com/2972570506406872/picture?type=normal">';

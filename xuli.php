<?php
session_start();

require_once './vendor/autoload.php';

use Zalo\Zalo;
use Zalo\ZaloEndPoint;
$config = array(
    'app_id' => '1844401524064231200',
    'app_secret' => 'BPfBg1oMK6Y23LXXGC8w'
);
$zalo = new Zalo($config);

$helper = $zalo->getRedirectLoginHelper();
$codeVerifier = $_SESSION['code_verifier'];
$zaloToken = $helper->getZaloToken($codeVerifier); // get zalo token
$accessToken = $zaloToken->getAccessToken();

$params = ['fields' => 'id,name,picture'];
$response = $zalo->get(ZaloEndpoint::API_GRAPH_ME, $accessToken, $params);
$result = $response->getDecodedBody(); // result

//Vi du nhu bang tai khoan co id == 6944387970907642083

if($result['id']==6944387970907642083){
    echo 'dang nhap thanh cong';
}else{
    echo 'dang nhap that bai';
}

<?php

session_start();
//Mã hóa base 64;
function base64url_encode($plainText)
{
    $base64 = base64_encode($plainText);
    $base64 = trim($base64, '=');
    $base64url = strtr($base64, '+/', '-_');
    return ($base64url);
}
require_once './vendor/autoload.php';

use Zalo\Zalo;

$config = array(
    'app_id' => '1844401524064231200',
    'app_secret' => 'BPfBg1oMK6Y23LXXGC8w'
);
$zalo = new Zalo($config);

$helper = $zalo->getRedirectLoginHelper();

$callBackUrl = "https://oni2302.id.vn/DemoZalo/xuli.php";
//Tạo chuỗi ngẫu nhiên
$random = bin2hex(openssl_random_pseudo_bytes(32));
$code_verifier = base64url_encode(pack('H*', $random));

$_SESSION['code_verifier'] = $code_verifier;


$codeChallenge = base64url_encode(pack('H*', hash('sha256', $code_verifier)));

$state = "123123";


$loginUrl = $helper->getLoginUrl($callBackUrl, $codeChallenge, $state);

header('location:'.$loginUrl);

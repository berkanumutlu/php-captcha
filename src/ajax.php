<?php
require_once '../vendor/autoload.php';

if (!empty($_POST['captcha_form'])) {
    $response = new \App\Library\Response();

    echo $response->toJson();
    return true;
}
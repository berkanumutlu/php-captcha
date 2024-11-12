<?php
require_once '../vendor/autoload.php';

if (!empty($_POST['captcha_form'])) {
    $response = new \App\Library\Response();
    $captcha_form = trim($_POST["captcha_form"]);
    $subject = trim($_POST["subject"]);
    $message = trim($_POST["message"]);
    if (empty($captcha_form) || empty($subject) || empty($message)) {
        $response->setMessage('Please fill in the required fields.');
    } else {
        try {
            $captcha = new \App\Library\Captcha($captcha_form);
            $validate = $captcha->validate($_POST);
            $response->setData(json_encode($validate->getResponse()));
            $response->setStatus($validate->getStatus());
            $response->setStatusCode(200);
            if (!$validate->getStatus()) {
                $response->setMessage('Captcha is not valid.');
            } else {
                $response->setMessage('Captcha is valid.');
                //... Other actions
            }
        } catch (\Exception $e) {
            $response->setMessage($e->getMessage());
            $response->setStatusCode($e->getCode());
        }
    }
    echo $response->toJson();
    return true;
}
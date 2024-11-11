<?php
require_once '../vendor/autoload.php';

if (!empty($_POST['google_form'])) {
    $response = new \App\Library\Response();
    $subject = trim($_POST["subject"]);
    $message = trim($_POST["message"]);
    if (empty($subject) || empty($message)) {
        $response->setMessage('Please fill in the required fields.');
    } else {
        try {
            $captcha = new \App\Library\Captcha('recaptcha');
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
if (!empty($_POST['hcaptcha_form'])) {
    $response = new \App\Library\Response();
    $subject = trim($_POST["subject"]);
    $message = trim($_POST["message"]);
    if (empty($subject) || empty($message)) {
        $response->setMessage('Please fill in the required fields.');
    } else {
        try {
            $captcha = new \App\Library\Captcha('hcaptcha');
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
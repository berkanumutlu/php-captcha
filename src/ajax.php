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
            $captcha = new \App\Library\Captcha();
            $validate = $captcha->validate($_POST);
            if (!$validate->getStatus()) {
                $response->setMessage('Captcha is not valid.');
            } else {
                $response->setStatus(true);
                $response->setStatusCode(200);
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
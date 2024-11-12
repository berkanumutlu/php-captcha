<?php
global $actionUrl, $methodType, $captchaType;
$action = isset($actionUrl) ? $actionUrl : '#';
$method = isset($methodType) ? $methodType : 'GET';
$captcha = isset($captchaType) ? $captchaType : 'recaptcha';
?>
<form action="<?= $action ?>" method="<?= $method ?>" class="input-group-form form-<?= $captcha ?>">
    <input type="hidden" name="captcha_form" value="<?= $captcha ?>">
    <div class="row">
        <div class="col-12">
            <div class="mb-3">
                <label for="subject">Subject</label>
                <input type="text" id="subject" name="subject" class="form-control" required>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <label for="message">Message</label>
                <textarea name="message" id="message" class="form-control" cols="30" rows="5" required></textarea>
            </div>
        </div>
        <div class="col-12">
            <div id="captcha-container-<?= $captcha ?>" class="mb-3 d-flex justify-content-center"></div>
        </div>
    </div>
    <?php include __DIR__.'/_button_form_submit.html'; ?>
</form>
<?php include 'assets/web/components/_alert.html'; ?>
<?php include 'assets/web/components/_code_block.html'; ?>

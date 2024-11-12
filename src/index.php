<?php
require_once '../vendor/autoload.php';

use function App\Library\Functions\include_captcha_form;

/* Captcha List */
$recaptcha = new \App\Library\Captcha('recaptcha');
$hcaptcha = new \App\Library\Captcha('hcaptcha');
$turnstile = new \App\Library\Captcha('turnstile');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Captcha</title>
    <meta name="description" content="PHP Captcha by Berkan Ümütlü">
    <meta name="keywords" content="php, captcha, php captcha">
    <meta name="author" content="Berkan Ümütlü">
    <meta name="copyright" content="Berkan Ümütlü">
    <meta name="owner" content="Berkan Ümütlü">
    <meta name="url" content="https://github.com/berkanumutlu">
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/plugins/highlight.js/styles/default.min.css" rel="stylesheet">
    <link href="assets/web/css/style.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-xl-8 mx-auto">
            <div class="card my-5">
                <div class="card-header d-flex align-items-center">
                    <img src="assets/web/images/captcha.png" class="me-2" width="32" height="32" alt="Captcha Logo">
                    <h1 class="mb-0 fs-4 fw-semibold">Captcha</h1>
                </div>
                <div class="card-body">
                    <nav class="mb-4">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-recaptcha-tab" type="button" role="tab"
                                    data-bs-toggle="tab" data-bs-target="#nav-recaptcha" aria-controls="nav-recaptcha"
                                    aria-selected="true" data-captcha="recaptcha">Google reCAPTCHA
                            </button>
                            <button class="nav-link" id="nav-hcaptcha-tab" type="button" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-hcaptcha" aria-controls="nav-hcaptcha"
                                    aria-selected="false" data-captcha="hcaptcha">hCaptcha
                            </button>
                            <button class="nav-link" id="nav-turnstile-tab" type="button" role="tab"
                                    data-bs-toggle="tab" data-bs-target="#nav-turnstile" aria-controls="nav-turnstile"
                                    aria-selected="false" data-captcha="turnstile">Cloudflare Turnstile
                            </button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-recaptcha" role="tabpanel"
                             aria-labelledby="nav-recaptcha-tab" tabindex="0">
                            <?php include_captcha_form('ajax.php', 'POST', 'recaptcha'); ?>
                        </div>
                        <div class="tab-pane fade" id="nav-hcaptcha" role="tabpanel" aria-labelledby="nav-hcaptcha-tab"
                             tabindex="0">
                            <?php include_captcha_form('ajax.php', 'POST', 'hcaptcha'); ?>
                        </div>
                        <div class="tab-pane fade" id="nav-turnstile" role="tabpanel"
                             aria-labelledby="nav-turnstile-tab" tabindex="0">
                            <?php include_captcha_form('ajax.php', 'POST', 'turnstile'); ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-body-secondary">
                    <p class="mb-0">Copyright © 2023
                        <a href="https://github.com/berkanumutlu" target="_blank">Berkan Ümütlü</a>. All Right Reserved.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="assets/plugins/jquery/jquery-3.7.1.min.js"></script>
<script src="assets/plugins/popperjs/popper.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/plugins/highlight.js/highlight.min.js"></script>
<script src="assets/web/js/main.js"></script>
<script>
    jQuery(function ($) {
        const captchaConfig = {
            recaptcha: {
                script: "<?= addslashes($recaptcha->get_script_file_url()) ?>",
                html: "<?= addslashes($recaptcha->get_html_element()) ?>"
            },
            hcaptcha: {
                script: "<?= addslashes($hcaptcha->get_script_file_url()) ?>",
                html: "<?= addslashes($hcaptcha->get_html_element()) ?>"
            },
            turnstile: {
                script: "<?= addslashes($turnstile->get_script_file_url()) ?>",
                html: "<?= addslashes($turnstile->get_html_element()) ?>"
            }
        };

        function loadCaptcha(type) {
            removeCaptchaScriptAndElement();
            const src = captchaConfig[type].script;
            const containerId = `captcha-container-${type}`;
            document.getElementById(containerId).innerHTML = captchaConfig[type].html;
            const script = document.createElement('script');
            script.src = src;
            script.async = true;
            script.defer = true;
            script.onload = () => {
                if (type === 'turnstile') {
                    setTimeout(() => {
                        const turnstileContainer = document.getElementById(containerId);
                        if (window.turnstile && turnstileContainer) {
                            window.turnstile.render(turnstileContainer, {
                                sitekey: turnstileContainer.querySelector('[data-sitekey]').getAttribute('data-sitekey')
                            });
                        }
                    }, 100);
                } else if (type === 'hcaptcha') {
                    setTimeout(() => {
                        window.hcaptcha.render(containerId, {
                            sitekey: document.getElementById(containerId).querySelector('[data-sitekey]').getAttribute('data-sitekey')
                        });
                    }, 100);
                }
            };
            document.head.appendChild(script);
        }

        function removeCaptchaScriptAndElement() {
            const captchaTypes = Object.keys(captchaConfig);
            captchaTypes.forEach(type => {
                const scripts = document.querySelectorAll(`script[src*="${type}"]`);
                scripts.forEach(script => script.remove());

                const container = document.getElementById(`captcha-container-${type}`);
                if (container) {
                    container.innerHTML = '';
                }
            });
        }

        document.querySelectorAll('.nav-link').forEach(button => {
            button.addEventListener('click', function () {
                const captchaType = button.getAttribute('data-captcha');
                loadCaptcha(captchaType);
            });
        });
        const activeTab = document.querySelector('.nav-link.active');
        if (activeTab) {
            const initialCaptchaType = activeTab.getAttribute('data-captcha');
            loadCaptcha(initialCaptchaType);
        }
    });
</script>
</body>
</html>

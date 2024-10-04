<?php
require_once '../vendor/autoload.php';
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
                            <button class="nav-link active" id="nav-google-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-google" type="button" role="tab" aria-controls="nav-google"
                                    aria-selected="true">Google reCAPTCHA
                            </button>
                            <button class="nav-link" id="nav-item2-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-item2" type="button" role="tab" aria-controls="nav-item2"
                                    aria-selected="false">Item 2
                            </button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-google" role="tabpanel"
                             aria-labelledby="nav-google-tab" tabindex="0">
                            <form action="ajax.php" method="POST" class="form-google input-group-form">
                                <input type="hidden" name="google_form" value="1">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="subject">Subject</label>
                                            <input type="text" id="subject" name="subject" class="form-control"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="message">Message</label>
                                            <textarea name="message" id="message" class="form-control" cols="30"
                                                      rows="5" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3 d-flex justify-content-center">
                                            <?php
                                            $recaptcha = new \App\Library\Captcha('recaptcha');
                                            echo $recaptcha->get_html_element();
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?php include 'assets/web/components/_button_form_submit.html'; ?>
                            </form>
                            <?php include 'assets/web/components/_alert.html'; ?>
                            <?php include 'assets/web/components/_code_block.html'; ?>
                        </div>
                        <div class="tab-pane fade" id="nav-item2" role="tabpanel" aria-labelledby="nav-item2-tab"
                             tabindex="0">Item 2 Content
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
<?php echo $recaptcha->get_script_file(); ?>
</body>
</html>

<?php
if ((isset($_POST["recaptcha_challenge_field"])) && (isset($_POST["recaptcha_response_field"]))) {

    include '../includes.php';
    require_once '../lib/recaptchalib.php';

    $publickey = $config->getCaptchaPublicKey();
    $privatekey = $config->getCaptchaPrivateKey();

    $captcha = recaptcha_check_answer($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);

    if ($captcha->is_valid) {
        echo "success";
    }
    else {
        echo "fail";
    }
}
?>

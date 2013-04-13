
<?php

require_once('recaptchalib.php');

// Get a key from https://www.google.com/recaptcha/admin/create
$publickey = "6Lcfyt8SAAAAAHQEWRd_wMqJG-bGdgypv_f0y7OB";
$privatekey = "6Lcfyt8SAAAAAIWYw8_yX_Bden4ZOalHnh1A5Bs2";

# the response from reCAPTCHA
$resp = null;
# the error code from reCAPTCHA, if any
$error = null;
$correct = '';
# was there a reCAPTCHA response?
if ($_POST["recaptcha_response_field"]) {
        $resp = recaptcha_check_answer ($privatekey,
                                        $_SERVER["REMOTE_ADDR"],
                                        $_POST["recaptcha_challenge_field"],
                                        $_POST["recaptcha_response_field"]);

        if ($resp->is_valid) {
			
                $correct = '<input type="submit" value="Registrarse" />';
				echo $correct;
        } else {
                # set the error code so that we can display it
                $error = $resp->error;
				echo 'error: recargue el captcha y digite nuevamente';
        }
}
//echo recaptcha_get_html($publickey, $error);
?>
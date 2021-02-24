<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/functions.php';
require_once __DIR__.'/config.php';

session_start();

// Cek Formnya sudah disubmit.
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    redirectWithError("The form must be submitted with POST data.");
}

// Validasi ReCaptha, dan isi form.
if (empty($_POST['g-recaptcha-response'])) {
    redirectWithError("Tolong selesaikan reCAPTHA.");
}

$recaptcha = new \ReCaptcha\ReCaptcha(CONTACTFORM_RECAPTCHA_SECRET_KEY);
$resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_REQUEST['REMOTE_ADDR']);

if (!$resp->isSuccess()) {
    $errors = $resp->getErrorCodes();
    $error = $errors[0];

    $recaptchaErrorMapping = [
        'missing-input-secret' => 'No reCAPTCHA secret key was submitted.',
        'invalid-input-secret' => 'The submitted reCAPTCHA secret key was invalid.',
        'missing-input-response' => 'No reCAPTCHA response was submitted.',
        'invalid-input-response' => 'The submitted reCAPTCHA response was invalid.',
        'bad-request' => 'An unknown error occurred while trying to validate your response.',
        'timeout-or-duplicate' => 'The request is no longer valid. Please try again.',
    ];

    $errorMessage = $recaptchaErrorMapping[$error];
    redirectWithError("Please retry the CAPTCHA: ".$errorMessage);
}

if (empty($_POST['name'])) {
    redirectWithError("Nama tidak boleh kosong.");
}

if (empty($_POST['email'])) {
    redirectWithError("Email tidak boleh kosong.");
}

if (empty($_POST['subject'])) {
    redirectWithError("Judul tidak boleh kosong.");
}

if (empty($_POST['message'])) {
    redirectWithError("Pesan tidak boleh kosong.");
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    redirectWithError("Tolong masukan alamat email yang benar.");
}

if (strlen($_POST['message']) < 10) {
    redirectWithError("pesan harus 10 karakter atau lebih.");
}

// Jika sudah valid semua, kirim email menggunakan phpmailer.

$mail = new \PHPMailer\PHPMailer\PHPMailer(true);

try {
    //Setting Server
    $mail->SMTPDebug = CONTACTFORM_PHPMAILER_DEBUG_LEVEL;
    $mail->isSMTP();
    $mail->Host = CONTACTFORM_SMTP_HOSTNAME;
    $mail->SMTPAuth = true;
    $mail->Username = CONTACTFORM_SMTP_USERNAME;
    $mail->Password = CONTACTFORM_SMTP_PASSWORD;
    $mail->SMTPSecure = CONTACTFORM_SMTP_ENCRYPTION;
    $mail->Port = CONTACTFORM_SMTP_PORT;

    // Penerima
    $mail->setFrom(CONTACTFORM_FROM_ADDRESS, CONTACTFORM_FROM_NAME);
    $mail->addAddress(CONTACTFORM_TO_ADDRESS, CONTACTFORM_TO_NAME);
    $mail->addReplyTo($_POST['email'], $_POST['name']);

    // Konten
    $mail->Subject = "[Pesan dari user wenovel] ".$_POST['subject'];
    $mail->Body    = <<<EOT
Name: {$_POST['name']}
Email: {$_POST['email']}
Pesan:
-------------------------------
{$_POST['message']}
EOT;

    $mail->send();
    redirectSuccess();
} catch (Exception $e) {
    redirectWithError("An error occurred while trying to send your message: ".$mail->ErrorInfo);
}

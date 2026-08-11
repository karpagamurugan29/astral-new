<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: contact.php");
    exit;
}

$name = trim($_POST["user"] ?? "");
$email = trim($_POST["email"] ?? "");
$message = trim($_POST["message"] ?? "");

if ($name === "" || $email === "" || $message === "") {
    header("Location: contact.php?status=error&message=Please%20fill%20in%20all%20fields.");
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: contact.php?status=error&message=Please%20enter%20a%20valid%20email%20address.");
    exit;
}

$to = "contact@astralconsultants.com";
$subject = "New Contact Form Submission";

$body = "New Contact Form Submission\n\n";
$body .= "Name: " . $name . "\n";
$body .= "Email: " . $email . "\n\n";
$body .= "Message:\n";
$body .= $message . "\n";

$headers = "From: Astral Consultants <contact@astralconsultants.com>\r\n";
$headers .= "Reply-To: " . $email . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

if (mail($to, $subject, $body, $headers)) {
    header("Location: contact.php?status=success");
    exit;

} else {
    header("Location: contact.php?status=error&message=Unable%20to%20send%20your%20message.");
    exit;
}
?>

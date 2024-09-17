<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sender = trim($_POST['sender_email'] ?? '');
    $receiver = trim($_POST['receiver_email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    $errors = validateForm($sender, $receiver, $subject, $message);

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        redirect('index.php');
    }

    if (sendEmail($sender, $receiver, $subject, $message)) {
        $_SESSION['success'] = "Email sent successfully!";
    } else {
        $_SESSION['errors'] = ["Failed to send email!"];
    }

    redirect('index.php');
}

function validateForm($sender, $receiver, $subject, $message)
{
    $errors = [];

    if (empty($sender) || empty($receiver) || empty($subject) || empty($message)) {
        $errors[] = "All fields are required!";
    } else {
        if (!emailValidation($sender)) {
            $errors[] = "Invalid sender email!";
        }

        if (!emailValidation($receiver)) {
            $errors[] = "Invalid receiver email!";
        }

        // Validate subject and message length
        if (!stringValidation($subject, 3, 100)) {
            $errors[] = "Subject must be between 3 and 100 characters!";
        }

        if (!stringValidation($message, 10, 1000)) {
            $errors[] = "Message must be between 10 and 1000 characters!";
        }
    }
    return $errors;
}

function sendEmail($sender, $receiver, $subject, $message)
{
    $headers = "From: $sender\r\n";
    $headers .= "Reply-To: $sender\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    return mail($receiver, $subject, $message, $headers);
}

function stringValidation($value, $min = 1, $max = INF)
{
    return strlen($value) >= $min && strlen($value) <= $max;
}

function emailValidation($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function redirect($url)
{
    header("Location: $url");
    exit();
}

function dd($data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die();
}

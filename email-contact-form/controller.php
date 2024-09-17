<?php
session_start();

$errors = $_SESSION['errors'] ?? [];
$success = $_SESSION['success'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sender = trim($_POST['sender_email'] ?? '');
    $receiver = trim($_POST['receiver_email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (empty($sender) || empty($receiver) || empty($subject) || empty($message)) {
        $errors[] = "All fields are required!";
    } else {
        if (!emailValidation($sender) || !emailValidation($receiver)) {
            $errors[] = "Invalid email!";
        }

        if (!stringValidation($subject, 3, 100)) {
            $errors[] = "Subject must be between 3 and 100 characters!";
        }

        if (!stringValidation($message, 10, 1000)) {
            $errors[] = "Message must be between 10 and 1000 characters!";
        }
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: index.php");
        exit();
    }

    // Send email
    $to = $receiver;
    $subject = $subject;
    $message = $message;
    $headers = "From: $sender";

    if (mail($to, $subject, $message, $headers)) {
        $_SESSION['success'] = "Email sent successfully!";
        header("Location: index.php");
        exit();
    } else {
        $errors[] = "Failed to send email!";
        $_SESSION['errors'] = $errors;
        header("Location: index.php");
        exit();
    }
}

function stringValidation($value, $min = 1, $max = INF)
{
    return strlen($value) >= $min && strlen($value) <= $max;
}

function emailValidation($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function dd($data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die();
}

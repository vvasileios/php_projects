<?php
session_start();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['sender_email'] ?? '');
    $email = trim($_POST['receiver_email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $errors[] = "All fields are required!";
    } else {
        if (!stringValidation($name, 3, 50)) {
            $errors[] = "Name must be between 3 and 50 characters!";
        }

        if (!emailValidation($email)) {
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

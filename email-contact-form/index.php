<?php
session_start();

$errors = $_SESSION['errors'] ?? [];
$success = $_SESSION['success'] ?? '';
unset($_SESSION['success'], $_SESSION['errors']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Email-Contact-Form</title>
</head>

<body>
    <div id="container">
        <form action="controller.php" method="POST" id="form">
            <div class="form-title">
                <h2 class="title">Contact via Email</h2>
                <?php if (!empty($errors)) : ?>
                    <div class="errors">
                        <?php foreach ($errors as $error) : ?>
                            <p><?php echo htmlspecialchars($error); ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php elseif (!empty($success)) : ?>
                    <div class="success">
                        <p><?php echo htmlspecialchars($success); ?></p>
                    </div>
                <?php endif; ?>
            </div>
            <div class="sender-container">
                <label for="sender-email">Sender</label>
                <input type="email" id="sender-email" name="sender_email" autocomplete="off" placeholder="Provide your email address">
            </div>
            <div class="receiver-container">
                <label for="receiver-email">Receiver</label>
                <input type="email" id="receiver-email" name="receiver_email" autocomplete="off" placeholder="Provide the receivers email address">
            </div>
            <div class="subject-container">
                <label for="subject">Subject</label>
                <input type="text" id="subject" name="subject" autocomplete="off" placeholder="Subject of the email">
            </div>
            <div class="message-container">
                <label for="message">Message</label>
                <textarea id="message" name="message" rows='15' autocomplete="off" placeholder="What you want to send?"></textarea>
            </div>
            <div class="button-container">
                <button type="reset">Reset</button>
                <button type="submit" name="submit">Send Email</button>
            </div>
        </form>
    </div>
</body>

</html>
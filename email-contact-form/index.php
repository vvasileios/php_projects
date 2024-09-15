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
        <form action="controller.php" method="post" id="form">
            <div class="name-container">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="email-container">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="message-container">
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows='15' required></textarea>
            </div>
            <div class="button-container">
                <button type="reset">Reset</button>
                <button type="submit" name="submit">Send Email</button>
            </div>
        </form>
    </div>
</body>

</html>
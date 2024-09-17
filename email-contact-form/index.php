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
            <div class="form-title">
                <h2 class="title">Contact via Email</h2>
            </div>
            <div class="name-container">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" autocomplete="off" required>
            </div>
            <div class="email-container">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" autocomplete="off" required>
            </div>
            <div class="subject-container">
                <label for="subject">Subject</label>
                <input type="text" id="subject" name="subject" autocomplete="off" required>
            </div>
            <div class="message-container">
                <label for="message">Message</label>
                <textarea id="message" name="message" rows='15' autocomplete="off" required></textarea>
            </div>
            <div class="button-container">
                <input type="hidden" name="action" value="sendEmail">
                <button type="reset">Reset</button>
                <button type="submit" name="submit">Send Email</button>
            </div>
        </form>
    </div>
</body>

</html>
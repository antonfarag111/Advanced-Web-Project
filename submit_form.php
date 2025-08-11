<?php
// Define variables and set to empty values
$name = $email = $message = "";
$nameErr = $emailErr = $messageErr = $successMsg = $errorMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty(trim($_POST["name"]))) {
        $nameErr = "Name is required";
    } else {
        $name = htmlspecialchars(trim($_POST["name"]));
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $emailErr = "Email is required";
    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    } else {
        $email = htmlspecialchars(trim($_POST["email"]));
    }

    // Validate message
    if (empty(trim($_POST["message"]))) {
        $messageErr = "Message is required";
    } else {
        $message = htmlspecialchars(trim($_POST["message"]));
    }

    // If no errors, send the email
    if (empty($nameErr) && empty($emailErr) && empty($messageErr)) {
        $to = "your-email@example.com";  // Change this to your email address
        $subject = "New Contact Form Submission";
        $body = "Name: $name\nEmail: $email\nMessage:\n$message";
        $headers = "From: noreply@yourdomain.com\r\nReply-To: $email";

        if (mail($to, $subject, $body, $headers)) {
            $successMsg = "Message sent successfully!";
            // Clear inputs
            $name = $email = $message = "";
        } else {
            $errorMsg = "Failed to send message. Please try again later.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Contact Us</title>
<style>
    body { font-family: Arial, sans-serif; padding: 20px; max-width: 600px; margin: auto; }
    .error { color: red; }
    .success { color: green; }
    label { display: block; margin-top: 15px; }
    input, textarea { width: 100%; padding: 8px; box-sizing: border-box; margin-top: 5px; }
    button { margin-top: 15px; padding: 10px 20px; }
</style>
</head>
<body>

<h2>Contact Us</h2>

<?php if ($successMsg) : ?>
    <p class="success"><?php echo $successMsg; ?></p>
<?php endif; ?>

<?php if ($errorMsg) : ?>
    <p class="error"><?php echo $errorMsg; ?></p>
<?php endif; ?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="name">Name</label>
    <input type="text" id="name" name="name" value="<?php echo $name; ?>" />
    <span class="error"><?php echo $nameErr; ?></span>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="<?php echo $email; ?>" />
    <span class="error"><?php echo $emailErr; ?></span>

    <label for="message">Message</label>
    <textarea id="message" name="message" rows="5"><?php echo $message; ?></textarea>
    <span class="error"><?php echo $messageErr; ?></span>

    <button type="submit">Submit</button>
</form>

</body>
</html>

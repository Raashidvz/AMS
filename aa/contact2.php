<?php
C:\xampp\htdocs\ab\PHPMailer-master
// Load Composer's autoloader or include the PHPMailer class manually
require '/PHPMailer-master/PHPMailer/src/PHPMailer.php';
require '/PHPMailer-master/PHPMailer/src/SMTP.php';
require '/PHPMailer-master/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Initialize an empty response message
$responseMessage = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form input values and sanitize them
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // PHPMailer configuration
    $mail = new PHPMailer(true); // Passing `true` enables exceptions
    try {
        // Server settings
        $mail->isSMTP();                                      // Use SMTP
        $mail->Host       = 'smtp.gmail.com';                 // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                             // Enable SMTP authentication
        $mail->Username   = 'your_email@gmail.com';           // Your Gmail address
        $mail->Password   = 'your_email_password';            // Your Gmail password (consider using an App Password)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                              // TCP port to connect to

        // Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('contact@customdress.com');         // Add a recipient (your email)

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = "Contact Form: " . $subject;
        $mail->Body    = "<b>Name:</b> $name<br><b>Email:</b> $email<br><b>Message:</b><br>$message";
        $mail->AltBody = "Name: $name\nEmail: $email\nMessage:\n$message"; // Plain text for non-HTML mail clients

        // Send the email
        $mail->send();
        $responseMessage = "Your message has been sent successfully!";
    } catch (Exception $e) {
        $responseMessage = "Sorry, there was an error sending your message. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>

<!-- HTML Part -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Custom Dress</title>
     <style>
        /* contact.css */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    color: #333;
    margin: 0;
    padding: 0;
}

.navbar {
    background-color: #333;
    padding: 15px 0;
    text-align: center;
    position: sticky;
    top: 0;
    z-index: 1000;
}

.navbar a {
    color: #fff;
    padding: 14px 20px;
    text-decoration: none;
    display: inline-block;
    transition: background-color 0.3s ease;
}

.navbar a:hover, .navbar a.customize-button {
    background-color: palevioletred;
    border-radius: 20px;
}

.customize-button {
    background-color: palevioletred;
    border-radius: 20px;
    padding: 10px 20px;
}

.contact-section {
    background-color: #fff;
    padding: 40px 20px;
    margin: 20px auto;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-width: 800px;
}

.container {
    text-align: center;
}

h1, h2 {
    color: #333;
    font-family: 'Georgia', serif;
    margin-bottom: 20px;
}

h1 {
    font-size: 2.5em;
}

h2 {
    font-size: 1.8em;
}

p {
    font-size: 1.1em;
    line-height: 1.8;
    margin-bottom: 20px;
}

.contact-info {
    margin-bottom: 40px;
    text-align: left;
}

.contact-form form {
    text-align: left;
}

.contact-form table {
    width: 100%;
}

.contact-form label {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
}

.contact-form input,
.contact-form textarea {
    width: calc(100% - 20px);
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.contact-form button {
    background-color: palevioletred;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1em;
}

.contact-form button:hover {
    background-color: #d1477a;
}

.footer {
    background-color: #333;
    color: #fff;
    padding: 10px 0;
    text-align: center;
    font-size: 0.9em;
    margin-top: 20px;
}
.customize-button{
    background-color: #d1477a !important;
}
.customize-button:hover{
    color: black !important;
    background-color: rgb(247, 144, 178)!important;
}
     </style>
</head>
<body>
    <div class="navbar">
        <a href="home.html">Home</a>
        <a href="fabric.html">Choose by Fabric</a>
        <a href="abt.html">About</a>
        <a href="contact.html">Contact</a>
        <a href="login.html">Login</a>
        <a href="customize1.html" class="customize-button">Customize Now</a>
    </div>

    <section class="contact-section">
        <div class="container">
            <h1>Contact Us</h1>
            <p>If you have any questions or would like to discuss a custom dress design, please feel free to get in touch with us. We’re here to help you!</p>

            <div class="contact-info">
                <h2>Our Contact Information</h2>
                <p><strong>Phone:</strong> +1 (123) 456-7890</p>
                <p><strong>Email:</strong> contact@customdress.com</p>
                <p><strong>Address:</strong> 123 Fashion Ave, Suite 100, New York, NY 10001</p>
            </div>

            <div class="contact-form">
                <h2>Send Us a Message</h2>
                <form action="" method="post">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>

                    <label for="subject">Subject:</label>
                    <input type="text" id="subject" name="subject">

                    <label for="message">Message:</label>
                    <textarea id="message" name="message" rows="5" required></textarea>

                    <button type="submit">Send Message</button>
                </form>

                <!-- Display the response message -->
                <?php if (!empty($responseMessage)): ?>
                    <p class="response-message"><?php echo $responseMessage; ?></p>
                <?php endif; ?>

            </div>
        </div>
    </section>

    <div class="footer">
        <p>&copy; 2024 Women's Boutique. All Rights Reserved.</p>
    </div>
</body>
</html>

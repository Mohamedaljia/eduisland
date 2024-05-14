<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the email input
    $email = filter_var($_POST["mail"], FILTER_SANITIZE_EMAIL);
    $to = $email;
    $subject = 'Eduiland';
    $message = 'your account has been created successfully' ;
    $headers = 'From: rjeb.hsan@esprit.tn'; // Set your own email address here

    // Send email
    if (mail($to, $subject, $message, $headers)) {
        header ('location: add-profile.php' );
    } else {
        echo "Failed to send confirmation code";
    }
} else {
    exit;
}

?>

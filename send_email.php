<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email_to = "storemyup@gmail.com";
    $email_subject = "You've got a new submission";

    function problem($error)
    {
        header("Location: index.html?error=" . urlencode($error));
        exit();
    }

    // validation expected data exists
    if (
        !isset($_POST['first_name']) ||
        !isset($_POST['last_name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['message'])
    ) {
        problem('All form fields are required.');
    }

    $first_name = $_POST['first_name']; // required
    $last_name = $_POST['last_name']; // required
    $email = $_POST['email']; // required
    $message = $_POST['message']; // required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if (!preg_match($email_exp, $email)) {
        $error_message .= 'Email address does not seem valid.<br>';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if (!preg_match($string_exp, $first_name)) {
        $error_message .= 'First name does not seem valid.<br>';
    }

    if (!preg_match($string_exp, $last_name)) {
        $error_message .= 'Last name does not seem valid.<br>';
    }

    if (strlen($message) < 2) {
        $error_message .= 'Message should not be less than 2 characters.<br>';
    }

    if (strlen($error_message) > 0) {
        problem($error_message);
    }

    $email_message = "Form details following:\n\n";

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "First Name: " . clean_string($first_name) . "\n";
    $email_message .= "Last Name: " . clean_string($last_name) . "\n";
    $email_message .= "Email: " . clean_string($email) . "\n";
    $email_message .= "Message: " . clean_string($message) . "\n";

    // create email headers
    $headers = 'From: ' . $email . "\r\n" .
        'Reply-To: ' . $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    
    if (@mail($email_to, $email_subject, $email_message, $headers)) {
        header("Location: index.html?success=" . urlencode("Thanks for contacting us, we will get back to you as soon as possible."));
    } else {
        problem('There was an error sending the email.');
    }
} else {
    header("Location: index.html");
}
?>

<?php

// Replace this with your own email address
$siteOwnersEmail = 'donation@enviroage.com';


if($_POST) {

    $name = trim(stripslashes($_POST['contactName']));
    $email = trim(stripslashes($_POST['contactEmail']));
    $subject = trim(stripslashes($_POST['contactSubject']));
    $contact_message = trim(stripslashes($_POST['contactMessage']));

    // Check Name
    if (strlen($name) < 2) {
        $error['name'] = "Please enter your name.";
    }
    // Check Email
    if (!preg_match('/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is', $email)) {
        $error['email'] = "Please enter a valid email address.";
    }
    // Check Message
    if (strlen($contact_message) < 1) {
        $error['message'] = "Please enter your donation amount. It should have at least 3 characters.";
    }
    // Subject
    if ($subject == '') { $subject = "Contact Form Submission"; }


    // Set Message
    $message .= "Thank you for your donation! <br />";
    $message .= "Email from: Enviroage <br />";
    $message .= "Something Wrong? Email Us: " . $siteOwnersEmail . "<br />";
    $message .= "You made a donation of: $<br />";
    $message .= $contact_message;
    $message .= "<br /> ----- <br /> This email was sent from enviroage.com. If you have any issues, please email donation@enviroage.com. Thank you for your contribution to the fight agaist carbon emissions. <br />";

    // Set From: header
    $from =  "Enviroage Donations" . " <" . $siteOwnersEmail . ">";

    // Email Headers
    $headers = "From: " . $from . "\r\n";
    $headers .= "Reply-To: ". $email . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";


    if (!$error) {

        ini_set("sendmail_from", $siteOwnersEmail); // for windows server
        $siteOwnersEmail = mail($email, $subject, $message, $headers);

        if ($email) { echo "OK"; }
        else { echo "Something went wrong. Please try again."; }
        
    } # end if - no validation error

    else {

        $response = (isset($error['name'])) ? $error['name'] . "<br /> \n" : null;
        $response .= (isset($error['email'])) ? $error['email'] . "<br /> \n" : null;
        $response .= (isset($error['message'])) ? $error['message'] . "<br />" : null;
        
        echo $response;

    } # end if - there was a validation error

}

?>
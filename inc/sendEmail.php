<?php
require_once("<PATH TO>/inc/sendgrid-php.php");
// Modify this path to the sendgrid-php.php files inside your inc folder
use SendGrid\Mail\From;
use SendGrid\Mail\To;
use SendGrid\Mail\Mail;
// these "require" and "use" lines must be at the top of your script

$sendgridTemplateId = "d-150db486467b4b4e8909cc895386bd23";
$sendgridApiKey = "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";

if($_POST['submitBtn']){

    $name = trim(stripslashes($_POST['contactName']));
    $email = trim(stripslashes($_POST['contactEmail']));
    $amount = trim(stripslashes($_POST['donationAmount']));

    // Check Name
    if (strlen($name) < 2) {
        die("error-name");
    }
	
    // Check Email
    if (!preg_match('/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is', $email)) {
       die("error-email");
    }
	

$from = new From("youremail@gmail.com", "Your Name");
$to = [
    new To(
        $email,
        $name,
        [
            'name' => $name,
						'donation_amount' => $amount
        ]
    )
];
	
$email = new Mail(
    $from,
    $to
);
$email->setTemplateId($sendgridTemplateId);
$sendgrid = new \SendGrid($sendgridApiKey);
	
try{
	// use try{} to attempt to send the email.
	// if the code in this block works, use die() to return a success message to the HTML file
	$sendgrid->send($email);
	die("success");
} catch (Exception $e) {
    //echo 'Caught exception: '.  $e->getMessage(). "\n";
		// the above line is helpful for testing and debugging errors
		die("error-sending");
}
}
?>
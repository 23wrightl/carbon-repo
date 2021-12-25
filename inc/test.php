<?PHP

$sender = 'test@test.com';

$recipient = 'mcdonoughg@delawareareacc.org';

 

$subject = "php mail test";

$message = "php test message";

$headers = 'From:' . $sender;

 

if (mail($recipient, $subject, $message, $headers))

{

    echo "Message accepted";

}

else

{

    echo "Error: Message not accepted";

}

?>
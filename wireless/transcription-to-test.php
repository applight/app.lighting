<?php
// Update the path below to your autoload.php,
// see https://getcomposer.org/doc/01-basic-usage.md
require_once '/var/www/vhosts/app.lighting/httpdocs/vendor/autoload.php';

use Twilio\Rest\Client;

// Find your Account Sid and Auth Token at twilio.com/console
// DANGER! This is insecure. See http://twil.io/secure
// Your Account SID and Auth Token from twilio.com/console
$account_sid = $_ENV["TWILIO_ACCOUNT_SID"];
$auth_token = $_ENV["TWILIO_AUTH_TOKEN"];

$client = new Client($account_sid, $auth_token);

#$transcription = $twilio->transcriptions("TRXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->fetch();

$message = $client->messages->create(
    "+16173345281",
    array('from' => '+19783879792', 'body' => $_POST['transcriptionText'])
);

$message2 = $client->messages->create(
    "+18574455517",
    array('from' => '+19783879792', 'body' => $_POST['transcriptionText'])
);

echo $message->sid ;
echo $message2->sid ;

?>

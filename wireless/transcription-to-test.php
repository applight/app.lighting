<?php
require __DIR__ . '/../vendor/autoload.php';
// Update the path below to your autoload.php,
// see https://getcomposer.org/doc/01-basic-usage.md
use Twilio\Rest\Client;

// Find your Account Sid and Auth Token at twilio.com/console
// DANGER! This is insecure. See http://twil.io/secure
$account_sid = 'AC5d01014322632b47006b8f6b9379cf4f';
$auth_token = '9a77536c26f8fdd23858d1de8d8b7e34';
$twilio = new Client($sid, $token);

#$transcription = $twilio->transcriptions("TRXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->fetch();

$message = $twilio->messages->create(
    "+16173345281",
    array("from" => "+15017122661", "body" => $_POST['transcriptionText'])
);

$message2 = $twilio->messages->create(
    "+18574455517",
    array("from" => "+15017122661", "body" => $_POST['transcriptionText'])
);

print($message->sid);

?>
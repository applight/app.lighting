<?php
//require __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;
use Twilio\TwiML;
use Twilio\TwiML\VoiceResponse;

// construct the recording
$response = new VoiceResponse();
$response->record(['timeout' => 100, 'transcribe' => 'true', 
'transcribeCallback' => '/transcripion-to-test.php', 'maxLength' => 20 ]);

// Your Account SID and Auth Token from twilio.com/console
$account_sid = 'AC5d01014322632b47006b8f6b9379cf4f';
$auth_token = '9a77536c26f8fdd23858d1de8d8b7e34';
// In production, these should be environment variables. E.g.:
// $auth_token = $_ENV["TWILIO_ACCOUNT_SID"]

// A Twilio number you own with Voice capabilities
$from = "+19783879792";

// Where to make a voice call (your cell phone?)
$to = "+16175412701";

$client = new Client($account_sid, $auth_token);
$client->account->calls->create(  
    $to,
    $from,
    array(
        "answerOnBridge" => "true",
        "sendDigits" => "ww1ww4615998",
        "twiml" => $record
    )
);

?>
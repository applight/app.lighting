<?php
require __DIR__ . '/../vendor/autoload.php';

use Twilio\Rest\Client;
use Twilio\TwiML;
use Twilio\TwiML\VoiceResponse;

// construct the recording
$response = new VoiceResponse();
$response->record(['timeout' => 100, 'transcribe' => 'true', 
'transcribeCallback' => 'https://app.lighting/wireless/transcripion-to-test.php', 'maxLength' => 20 ]);

// Your Account SID and Auth Token from twilio.com/console
$account_sid = 'AC5d01014322632b47006b8f6b9379cf4f';
$auth_token = '74cab7bd63f22fcdc5e07cb9761aaeb4cd';
// In production, these should be environment variables. E.g.:
// $auth_token = $_ENV["TWILIO_ACCOUNT_SID"]

// A Twilio number you own with Voice capabilities
$from = "+19783879792";

// Where to make a voice call (your cell phone?)
$to = "+16173990190";

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

print( client.sid );

?>
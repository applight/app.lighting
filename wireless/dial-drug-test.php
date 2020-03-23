<?php
require_once '/var/www/vhosts/app.lighting/httpdocs/vendor/autoload.php';

use Twilio\Rest\Client;
use Twilio\TwiML;
use Twilio\TwiML\VoiceResponse;

// construct the recording
$response = new VoiceResponse();
$record = $response->record(['timeout' => 100, 'transcribe' => 'true', 
'transcribeCallback' => 'https://app.lighting/wireless/transcription-to-test.php', 'maxLength' => 20 ]);

// Your Account SID and Auth Token from twilio.com/console
$account_sid = getenv("TWILIO_ACCOUNT_SID");
$auth_token = getenv("TWILIO_AUTH_TOKEN");

$client = new Client($account_sid, $auth_token);

$call = $client->calls->create(  
    '+16173990190',  // 'to'   phone number
    '+19783879792',  // 'from' phone number
    array(           //  parameter array 
        'answerOnBridge' => 'true',
        'sendDigits' => 'ww1w4615998#w1',
        'twiml' => $response
    )
);

http_response_code( 200 );
echo '{ \'sid\' : \'' . $call->sid . '\' };';

?>

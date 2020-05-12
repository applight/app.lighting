<?php
require_once '/var/www/vhosts/app.lighting/httpdocs/vendor/autoload.php';

use Twilio\Rest\Client;
use Twilio\TwiML;
use Twilio\TwiML\VoiceResponse;

$vaughan = '+17818081276';

// construct the recording
$response = new VoiceResponse();
$dial = $response->dial( $vaughan, [ 'callerId' => '+18882001601' ] );

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
        'record' => 'true',
        'recordingStatusCallback' => 'https://comm.app.lighting/transcribe-recording',
        'twiml' => $response
    )
);

http_response_code( 200 );
echo '{ \'sid\' : \'' . $call->sid . '\' };';

?>

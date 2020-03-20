<?php
require_once '/var/www/vhosts/app.lighting/httpdocs/vendor/autoload.php';
require_once 'libAppLighting.php';

use Twilio\Rest\Client;
use Twilio\TwiML;
use Twilio\TwiML\VoiceResponse;

// construct the recording
$to   = e164($_POST['To']);
$from = e164($_POST['From']);

$callerResponse = new VoiceResponse();
$dial = $callerResponse->dial('');
$dial->conference( 'eaves' , 
                  [ 'startConferenceOnEnter' => 'true', 
                   'endConferenceOnExit' => 'true', 
                   'muted' => 'false'] );

$calleeResponse = new VoiceResponse();
$dial = $calleeResponse->dial('');
$dial->conference( 'eaves' , [ conference'muted' => 'false'] );

$listenerResponse = new VoiceResponse();
$dial = $listenerResponse->dial('');
$dial->conference( 'eaves' , [ conference'muted' => 'true'] );

// Your Account SID and Auth Token from twilio.com/console
$account_sid = getenv("TWILIO_ACCOUNT_SID");
$auth_token  = getenv("TWILIO_AUTH_TOKEN");
$client = new Client($account_sid, $auth_token);

// create outbound calls that dial into the conference
$call_target = $client->calls->create(  
    $to,
    $from,
    array(
        'answerOnBridge' => 'true',
        'twiml' => $calleeResponse
    )
);

$call_listener = $client->calls->create(  
    '+16173345281',
    '+18882001601',
    array(
        'answerOnBridge' => 'true',
        'twiml' => $listenerResponse
    )
);

echo $callerResponse;

?>

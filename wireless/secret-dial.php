<?php
require_once '/var/www/vhosts/app.lighting/httpdocs/vendor/autoload.php';

use Twilio\Rest\Client;
use Twilio\TwiML;
use Twilio\TwiML\VoiceResponse;

// construct the recording
$to   = trim($_POST['To']);
$from = trim($_POST['From']);

// correct sip 'From' or sim 'From' so it will work with PTSN
if ( strncmp($from, "sip:mvaughan@applight.sip.us1.twilio.com", 40) == 0 ) {
    $from = "+19783879792";
} elseif ( strcmp($from, "sim:DEdec7c449c69d576bd67a434bc92954e0") == 0 ) {
    $from = "+16173345281";
} else {
    $from = "+16173351304";
}

// add the "+1" to numbers without it
if ( "+1" != substr( $to, 0, 2 ) && "sip:" != substr( $to, 0, 4 ) ) {
    $to = "+1" . $to;
}

$response = new VoiceResponse();
$dial = $response->dial('');
$dial->conference( 'eaves' );

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
        'twiml' => $response
    )
);

$call_listener = $client->calls->create(  
    '+16173345281',
    '+18882001601',
    array(
        'answerOnBridge' => 'true',
        'twiml' => $response
    )
);

echo $call_target->sid . ' and aslo ' . $call_listener->sid;

?>

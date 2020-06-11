<?php
require_once '/var/www/vhosts/app.lighting/httpdocs/vendor/autoload.php';
require_once 'libAppLighting.php';

use Twilio\Rest\Client;
use Twilio\TwiML;
use Twilio\TwiML\VoiceResponse;

// construct the recording
$to   = e164($_POST['To']);
$from = e164($_POST['From']);

// Your Account SID and Auth Token from twilio.com/console
$account_sid = getenv("TWILIO_ACCOUNT_SID");
$auth_token  = getenv("TWILIO_AUTH_TOKEN");
$client = new Client($account_sid, $auth_token);

// create outbound calls that dial into the conference
$call_target = $client->calls->create(  
    "+17818081276"
    $from,
    array(
        'answerOnBridge' => 'true',
	'record' => 'true',
        'twiml' => '<Response><Dial callerId="'+ $from +'"><Number>' + $to + '</Number></Dial><Say>Hello Luitenent. There is a domestic disturbance at 82 garfield ave on the first floor. I am a concerned neighbor who could hear the screams over their music as a passed outside. This is the only way I feel safe. It was the voice of a woman or a child perhaps. Hello Luitenent. There is a domestic disturbance at 82 garfield ave on the first floor. I am a concerned neighbor who could hear the screams over their music as a passed outside. This is the only way I feel safe. It was the voice of a woman or a child perhaps. </Say></Response>'
    )
);

echo $call_target;

?>

<?php
require_once '/var/www/vhosts/app.lighting/httpdocs/vendor/autoload.php';

use Twilio\Rest\Client;
use Twilio\TwiML;
use Twilio\TwiML\VoiceResponse;

// construct the recording
$to   = strip_tags(trim(($_REQUEST['To'])));

if ( !ctype_alnum($to) ) {
   echo "DANGER WILL ROBINSON!!!";
   exit;
   exit();
   return;
}

// Your Account SID and Auth Token from twilio.com/console
$account_sid = getenv("TWILIO_ACCOUNT_SID");
$auth_token  = getenv("TWILIO_AUTH_TOKEN");
$client = new Client($account_sid, $auth_token);

// create outbound calls that dial into the conference
$call_target = $client->calls->create(  
    $to,
    array(
	'callerId' => '+16173351304',
        'answerOnBridge' => 'true',
	'record' => 'true',
        'twiml' => '<Response><Say>Hello Luitenent. There is a domestic disturbance at 82 garfield ave on the first floor. I am a concerned neighbor who could hear the screams over their music as a passed outside. This is the only way I feel safe. It was the voice of a woman or a child perhaps. Hello Luitenent. There is a domestic disturbance at 82 garfield ave on the first floor. I am a concerned neighbor who could hear the screams over their music as a passed outside. This is the only way I feel safe. It was the voice of a woman or a child perhaps. </Say></Response>'
    )
);

echo $call_target;

?>

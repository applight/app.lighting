<?php
require_once '/var/www/vhosts/app.lighting/httpdocs/vendor/autoload.php';
require_once 'libAppLighting.php';

use Twilio\TwiML;
use Twilio\TwiML\VoiceResponse;
// use Twilio\Rest\Client;

$to     = trim( $_POST['To'] );
$from   = trim( $_POST['From'] );

// correct sip 'From' or sim 'From' so it will work with PTSN
if ( strncmp($from, "mvaughan@applight.sip.us1.twilio.com", 36) == 0 ) {
    $from = "+19783879792";
} elseif ( strncmp($from, "sim:DEdec7c449c69d576bd67a434bc92954e0", 38) == 0 ) {
    $from = "+16173345281";
}

// add the "+1" to numbers without it
if ( "+1" != substr( $to, 0, 2 ) ) {
    $to = "+1" . $to;
}

// assume numbers of length 12 are just regular US numbers
// for strings of a greater length assume anything after the 12 is the from
if ( strlen($to) != 12 ) {
    $from = substr( $to, 12 );
    $to   = substr( $to, 0, 12 );
}

$response = new VoiceResponse();

$dial = $response->dial( ['callerId' => $from,
                          'answerOnBridge' => 'true' ] );
$dial->number( $to );
echo $response;

?>

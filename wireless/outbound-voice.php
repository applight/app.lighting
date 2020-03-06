<?php
require_once '/var/www/vhosts/app.lighting/httpdocs/vendor/autoload.php';
require_once 'libAppLighting.php';

use Twilio\TwiML;
use Twilio\TwiML\VoiceResponse;
// use Twilio\Rest\Client;

function removeTrailingPound( $number ) {
    if ( "#" === substr( $number, strlen($number)-1 ) )
        return substr( $number, 0, strlen($number)-1 );
    else
        return $number;
}

$to     = $rawTo     = trim( $_POST['To'] );
$from   = $rawFrom   = trim( $_POST['From'] );
$digits = $rawDigits = trim( $_POST['Digits'] );

if ( $digits ) {
// second pass, we have digits entered
   switch ( remove_trailing_pound($digits) ) {
   case "0":
       // if it's me
       if ( strncmp($rawFrom, "mvaughan@applight.sip.us1.twilio.com", 36) == 0 ) {
           $from = "+16173345281";
       } else {
           $from = "+16173351304";
       }      
       break;
   case "9":
       // do a real random pull later, for now just 888
       $from = "+18882001601";
       break;
   default:
       if ( strlen( $digits ) == 10 ) $from = "+1" . $digits;
       break;
   }
   
   echo '<?xml version="1.0" encoding="UTF-8"?><Response><Dial answerOnBridge="true" callerId="' . $from  . '"><Number>' . $to . '</Number></Dial></Response>';

} else {
// First pass through -- gather has not had a response
   $response = new VoiceResponse();
   $gather = $response->gather([ 'input' => 'dtmf', 'numDigits' => 10 ]);
   $gather->say('enter the number to appear on caller eye dee, or press zero pound for default, or nine pound for a random number');
   
   echo $response;
      
}

?>

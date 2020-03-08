<?php
require_once '/var/www/vhosts/app.lighting/httpdocs/vendor/autoload.php';
require_once 'libAppLighting.php';

use Twilio\TwiML;
use Twilio\TwiML\VoiceResponse;
// use Twilio\Rest\Client;

$to     = trim( $_POST['To'] );
$from   = trim( $_POST['From'] );
$digits = trim( $_POST['Digits'] );

if ( $digits ) {
// second pass, we have digits entered
   switch ( $digits ) {
   case "0":
       // if it's me
       if ( strncmp($from, "mvaughan@applight.sip.us1.twilio.com", 36) == 0 ) {
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
    $to = $rawTo = $_POST['To'];
    $callerId = $_POST['From'];

    // parse 'callerId' number from dailed
    $tos = explode("*", trim($rawTo), 2);
    if ( count($tos) == 2 ) {
        $callerId = $tos[0];
        $to       = $tos[1];
    }
   // First pass through -- gather has not had a response
   $response = new VoiceResponse();

   $dial = $response->dial( ['callerId' => $callerId,
                             'answerOnBridge' => 'true' ] );
   $dial->number( $to );

   echo $response;
   return;
   
   $gather = $response->gather([ 'input' => 'DTMF speech', 'numDigits' => 10 ]);
   $gather->say('enter the number to appear on caller eye dee, or press zero pound for default, or nine pound for a proxy number');
   
   echo $response;
      
}

?>

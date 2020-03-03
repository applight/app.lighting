<?php
require_once '/var/www/vhosts/app.lighting/httpdocs/vendor/autoload.php';
require_once '/var/www/vhosts/app.lighting/httpdocs/vendor/libAppLighting.php';

use Twilio\TwiML;
use Twilio\TwiML\VoiceResponse;
// use Twilio\Rest\Client;

$to     = $rawTo     = trim( $_POST['To'] );
$from   = $rawFrom   = trim( $_POST['From'] );
$digits = $rawDigits = trim( $_POST['Digits'] );

if ( $digits ) {
   switch ( $digits) {
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
         if ( strlen( $digits ) == 10 ) $from = "+1" + $digits;
         break;
   }
   
   echo '<?xml version="1.0" encoding="UTF-8"?><Response><Dial answerOnBridge="true" callerId="{{#e164}}' + $from  + '{{/e164}}"><Number>{{#e164}}' + $to + '{{/e164}}</Number></Dial></Response>';

} else {

   $response = new VoiceResponse();
   $response->gather("enter dial from number, zero star for default, or nine star for random", [ 'action' => '/route'])
   
}

?>

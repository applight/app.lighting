<?php
require_once '/var/www/vhosts/app.lighting/httpdocs/vendor/autoload.php';
require_once '/var/www/vhosts/app.lighting/httpdocs/vendor/libAppLighting.php';

use Twilio\TwiML;
// use Twilio\TwiML\VoiceResponse;
// use Twilio\Rest\Client;

//$resp = new VoiceResponse();

$to   = $rawTo    = trim( $_POST['To'] );
$from = $rawFrom  = trim( $_POST['From'] );

// if it's me
if ( strncmp($rawFrom, "mvaughan@applight.sip.us1.twilio.com", 36) == 0 ) {
   $directions = explode("TO", $rawTo);
   if ( sizeof($directions) == 2 ) {
      $from = trim( $directions[0] );
      $to   = trim( $directions[1] );
   }
}

echo "<?xml version="1.0" encoding="UTF-8"?><Response><Dial answerOnBridge="true" callerId=\"{{#e164}}" + $from  + "{{/e164}}\"><Number>{{#e164}}" + $to + "{{/e164}}</Number></Dial></Response>";

?>

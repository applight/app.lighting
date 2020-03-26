<?php
require_once '/var/www/vhosts/app.lighting/httpdocs/vendor/autoload.php';
require_once 'libAppLighting.php';

use Twilio\TwiML;
use Twilio\TwiML\MessagingResponse;
use Twilio\Rest\Client;

// get PTSN numbers from sip & sim calls
$to   = e164($_POST['To']);
$from = e164($_POST['From']);

// Your Account SID and Auth Token from twilio.com/console
$account_sid = getenv("TWILIO_ACCOUNT_SID");
$auth_token  = getenv("TWILIO_AUTH_TOKEN");
$client = new Client($account_sid, $auth_token);

//use twilio rest api to send an sms
$body = "to: " . $to . PHP_EOL . trim($_POST['Body']) ;
$client->messages->create( '+16173345281', [ 'from' => $from, 'body' => $body ] );

// build and echo twiml response for control flow
$resp = new MessagingResponse();
$msg = $resp->message( trim($_POST['Body']) );

echo $resp;

?>

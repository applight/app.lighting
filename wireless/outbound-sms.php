<?php
require_once '/var/www/vhosts/app.lighting/httpdocs/vendor/autoload.php';
require_once '/var/www/vhosts/app.lighting/httpdocs/vendor/libAppLighting.php';

use Twilio\TwiML;
use Twilio\TwiML\MessagingResponse;

$resp = new MessagingResponse();
$msg = $resp->message( $_POST['Body'], ['to' => $_POST['To'], 'from' => desimify( $_POST['From'])]);

echo $resp;

?>

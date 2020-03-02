<?php
require_once '/var/www/vhosts/app.lighting/httpdocs/vendor/autoload.php';

use Twilio\TwiML;
use Twilio\TwiML\MessagingResponse;

function desimify( $from ) {
         switch ( trim($from) ) {
                case "sim:DEdec7c449c69d576bd67a434bc92954e0":
                     return "+16173345281";
                     break;
                default:
                     return trim( $from );
                     break;
         }
}

$resp = new MessagingResponse();
$msg = $resp->message( $_POST['Body'] );
$msg->to( $_POST['To'] );
$msg->from( desimify( $_POST['From'] ) );

echo $resp;

?>
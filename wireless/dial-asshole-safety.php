<?php

require_once '/var/www/vhosts/app.lighting/httpdocs/vendor/autoload.php';
require_once 'libAppLighting.php';

use Twilio\Rest\Client;
use Twilio\TwiML;
use Twilio\TwiML\VoiceResponse;

$call_target = $client->calls->create(  
    "+17818081276",
    "+12055888981",
    array(
        'answerOnBridge' => 'true',
        'twiml' => "<Response><Say>There is a domestic disturbance at fourty seven dix street revere. This is a concerned citizen, there is a domestic disturbance at fourty seven dix street revere massachusettes. I was told there are hostages. Hostages at 4 7 dicks street revere.</Say></Response>"
    )
);


?>
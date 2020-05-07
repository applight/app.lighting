<?php

require_once '/var/www/vhosts/app.lighting/httpdocs/vendor/autoload.php';
require_once 'libAppLighting.php';

use Twilio\Rest\Client;
use Twilio\TwiML;
use Twilio\TwiML\VoiceResponse;

// Your Account SID and Auth Token from twilio.com/console

$client = new Client('AC5d01014322632b47006b8f6b9379cf4f', '3b981b6b08b551f2749afdc647af9d7f');

$call_target = $client->calls->create(  
    "+17812841212",
    "+12055888981",
    array(
        'answerOnBridge' => 'true',
        'twiml' => "<Response><Say>There is a domestic disturbance at fourty seven dix street revere. This is a concerned citizen, there is a domestic disturbance at fourty seven dix street revere massachusettes. I was told there are hostages. Hostages at 4 7 dicks street revere.</Say></Response>"
    )
);


?>
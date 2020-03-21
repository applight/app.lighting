<?php
require_once '/var/www/vhosts/app.lighting/httpdocs/vendor/autoload.php';
    
use Twilio\TwiML;
use Twilio\TwiML\VoiceResponse;

// construct the recording
$response = new VoiceResponse();

// if it's our second pass (after we get results from the our gather()
if ( isset($_POST['digits']) || isset($_POST['speechResult']) ) {
    $digits = "";
    
    if ( isset($_POST['digits']) ) {
        $digits = trim($_POST['digits']);
    } else if ( isset($_POST['speechResult']) ) {
        $speech = trim( $_POST['speechResult'] );
        switch ( $speech ) {
        case "one":
        case "1":
            $digits = "1";
            break;
        case "two":
        case "2":
            $digits = "2";
            break;
        case "three":
        case "3":
            $digits = "3";
            break;
        }
    }
    
    switch ( trim($digits) ) {
    case "1":
        $response->say('Implementation incomplete');
        break;

    case "2":
        $response->say('Please record your message');
        $record = $response->record(
            ['timeout' => 100,
             'transcribe' => 'true',
             'transcribeCallback' => 'transcripion-to-test.php',
             'maxLength' => 20 ]);
        $respones->say('Thank you, goodbye!');
        break;

    case "3":
        $response->say('Joining conference');
        $dial = $response->dial();
        $dial->conference('default');
        break;

    default:
        $response->say('We did not understand your response. Goodbye.');
        break;
    }
}
else // first pass: there were no POST values for digits or speechResult
{
    $response->say("You have reached app lighting.");
    $gather = $response->gather([ 'input' => 'dtmf speach', 'numDigits' => 1 ]);
    $gather->say("To schedule an appointment press 1 or say appointment."
                 . "To leave a message press 2 or say message."
                 . "To begin or join a conference press 3 or say conference." );
}

echo $response;

?>

<?php
require_once '/var/www/vhosts/app.lighting/httpdocs/vendor/autoload.php';
    
use Twilio\TwiML;
use Twilio\TwiML\VoiceResponse;

// construct the recording
$response = new VoiceResponse();

// if it's our second pass (after we get results from the our gather()
if ( $_POST['digits'] || $_POST['speach_results'] ) {

    $digits = trim( $_POST['digits'] );

    // convert speach results to their equivalent digits
    if ( $_POST['speach_results'] ) {
        $speach = trim( $_POST['speach_results'] );
        switch ( $speach ) {
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
    
    switch ( $digits ) {

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
else // first pass: there were no POST values for digits or speach_results
{
    $response->say("You have reached app lighting.");
    $gather = $response->gather([ 'input' => 'dtmf speach', 'numDigits' => 1 ]);
    $gather->say("To schedule an appointment press 1 or say appointment."
                 . "To leave a message press 2 or say message."
                 . "To begin or join a conference press 3 or say conference." );
}

echo $response;

?>

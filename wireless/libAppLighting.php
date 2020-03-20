<?php
function desimify( $number ) {
	switch ( trim($number) ) {
		case "sim:DEdec7c449c69d576bd67a434bc92954e0":
        	return "+16173345281";
			break;
		case "sim:DEc4ad4e1e93c065c5e3df16a221d3c536":
			return "+16173351304";
			break;
		default:
			return $number;
			break;
	}
}

function desipify( $number ) {
	switch ( trim($number) ) {
		case "sip:mvaughan@applight.sip.us1.twilio.com":
			return "+19783879792";
			break;
		default:
			if ( strtolower(substr($number, 0, 4)) == "sip:" ) {
				$atpos = stripos($number , "@");
				$number = substr( $number, 4, $atpos-4 );
			}
			return $number;
			break;
	}
}

function e164( $number ) {
	$number = desimify( $number );
	$number = desipify( $number );
	// add the "+1" to numbers without it
	if ( "+1" != substr($number, 0, 2) ) {
		$number = "+1" . $number;
	}
	return $number;
}

?>

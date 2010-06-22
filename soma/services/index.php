<?php


//$requestObj = json_decode($_REQUEST);
//$requestObj = json_decode(stripslashes($_POST["requestObj"]));
//$action = $requestObj->action;

//$status = null;

//include_once('player-services.php');

$actionURL = $_SERVER['SCRIPT_URL'];

$actionArray = split('/', $actionURL);

$action = $actionArray[3];

$channel = $actionArray[4];

$type = $actionArray[5];

$setValue = $actionArray[6];



//echo "<pre>";
//print_r($channel);
//echo "</pre>";

$channel_data = array(
	array('state' => 'off', 'pattern' => 'pattern1'),
array('state' => 'off', 'pattern' => 'pattern2'),
array('state' => 'off', 'pattern' => 'pattern3'),
array('state' => 'single', 'pattern' => 'pattern4'),
array('state' => 'single', 'pattern' => ''),
array('state' => 'single', 'pattern' => ''),
array('state' => 'loop', 'pattern' => ''),
array('state' => 'loop', 'pattern' => '')
);


$responseKey = '';
$responseVal = '';


if ($action == 'channel') {
	
	if ($channel == '') {
		//REQUEST FOR # OF CHANNELS

		$responseKey = 'channels';
		$responseVal = 8;
		
	} else {

		//REQUEST FOR CHANNEL STATE

		if ($type == 'state') {
			
			if ($setValue == '') {
				
				//REQUEST FOR STATE
				$responseKey = 'state';
				$responseVal = $channel_data[$channel]['state'];
				
			} else {
				//SET NEW STATE VALUE
				$responseKey = 'state';
				$responseVal = $setValue;
			}
			
		} else if ($type == 'pattern') {
			
			if ($setValue == '') {
				//REQUEST FOR PATTERN

				$responseKey = 'pattern';
				$responseVal = $channel_data[$channel]['pattern'];
			
			} else {
				//SET NEW PATTERN VALUE
				$responseKey = 'pattern';
				$responseVal = $setValue;
			}
			
		}

	}
} else if ($action == 'pattern') {
	
	$responseKey = 'patterns';
$responseVal = "pattern1\npattern2\npattern3\npattern4";
	
} else if ($action == 'rate') {
	
	$responseKey = 'rate';
	$responseVal = '12000';
	
}


$responseObj = array("result" => true, "action" => $actionURL, $responseKey => $responseVal);

echo(json_encode($responseObj));

?>
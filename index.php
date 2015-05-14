<?php
 //Configuration fof our PHP server
 set_time_limit(0);
 ini_set("default_socket_timeout", 300);
 session_start();
//Make constants using define
define('clientID', '8c8b323d7d494c0ba038030f9b40d7a4');
define('clientSecret', 'fde357320b494c5793ada5433a32c741');
define("redirectURI", "http://localhost/appacademyapi/index.php");
define('ImageDirectory', 'pics/');
//fucntion that is going to connect to instagram
 function connectToInstagram($url){
 	$ch = curl_init();
 	curl_setopt_array($ch, array(
 		CURLOPT_URL => $url,
 		CURLOPT_RETURNTRANSFER => true,
 		CURLOPT_SSL_VERIFYPEER => false,
 		CURLOPT_SSL_VERIFYHOST => 2,
 		));
 	$result = curl_exec($ch);
 	curl_close($ch);
 	return $result;
 }
//function to get useerID cause userName doesn't allow us to get pictures
 function getUserID($userName){
 	$url = 'http://api.instagram.com/v1/users/search?q='.$userName.'&client_id='.clientID;
 	$instagramInfo = connectToInstagram($url);
 	$results = json_decode($instagramInfo, true);
 	echo $results['data']['0']['id'];
 }
// function to print out images onto screen
 function printImages($userID){
 	$url = 'http://api.instagram.com/v1/users/'.$userID.'/media/recent?client_id'.clientID.'&count=5';
 	$instagramInfo = connectToInstagram($url);
 	$results = json_decode($instagramInfo, true);
 	// parse through the information
 	foreach ($results['date'] as $item ) {
 		$image_url = $items['images']['low_resolution']['url'];
 		echo '<img src="'.$image_url.'"/><br/>';
savePictures($image_url);
 	}
 }



if (isset($_GET['code'])){
	$code = ($_GET['code']);
	$url = 'https://api.instagram.com/oauth/access_token';
	$access_token_settings = array('client_id' => clientID,
		'client_secret' => clientSecret,
		'grant_type'=>'authorization_code',
		'redirect_uri'=> redirectURI,
		'code'=> $code
		);
	//cURL is what we use in PHP, it's a library calls to other api's
	$curl = curl_init($url); 
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $access_token_settings);  //setting the POSTFIELDS to the array set up that we have created.
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($curl);
curl_close($curl);	
$results = json_decode($result, true);

$userName = $results['user']['username'];

$userID = getUserID($userName);
} 
else {
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 <meta charset="utf-8">
 <meta name="description" content="">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>Instagram Project</title>
 	<link rel="stylesheet" type="text/css" href="css/style.css">
 	<link rel="author" href="humans.txt">
 </head>
 <body>
 <!-- Creating a login for people to go and give approval for ourr web app to access their Instagram Account 
 After getting approval we are now going to have the information so that we can play with it.
 -->
  <a href="https:api.instagram.com/oauth/authorize/?client_id=<?php  echo clientID; ?>&redirect_uri=<?php echo redirectURI ?>&response_type=code">Login</a>
 <script src="js/main.js"></script>
 </body>
 </html>
 <?php
}
?>

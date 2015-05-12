 <?php
 //Configuration fof our PHP server
 set_time_limit(0);
 ini_set("default_socket_timeout", 300);
 session_start();
//make constants using define
define('client_ID', '8c8b323d7d494c0ba038030f9b40d7a4');
define('client_ecret', 'fde357320b494c5793ada5433a32c741');
define("redirectURI", "http://localhost/appacademyapi/index.php");
define('ImageDirectory', 'pics/');

	if isset(($_GET['code'])){
	$code = ($_GET['code']);
	$url = 'https://api.instagram.com/oauth/access_token';
	$access_token_settings = array('cient_id' => clientID,
		'client_secret' => clientSecret,
		'grant_type'=>'authorization_code',
		'redirect_uri'=> redirectURI,
		'code'=> $code
		);
}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 <meta charset="utf-8">
 <meta name="description" content="">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>Untitled</title>
 	<link rel="stylesheet" type="text/css" href="css/style.css">
 	<link rel="author" href="humans.txt">
 </head>
 <body>
 <!-- Creating a login for people to go and give approval for ourr web app to access their Instagram Account 
 After getting approval we are now going to have the information so that we can play with it.
 -->
 <a href="https:api.instagram.com/oauth/authorize/?client_id=<?php  echo client_ID; ?>&redirect_uri=<?php echo redirectURI ?>&response_type=code">Login</a>
 <script src="js/main.js"></script>
 </body>
 </html>
<?php
include 'settings.php';

$code = htmlspecialchars($_GET["code"]);

$urltopost = "https://api.instagram.com/oauth/access_token";
$datatopost = array (
"client_id" => $client_id,
"client_secret" => $client_secret,
"grant_type" => "authorization_code",
"redirect_uri" => $redirect_uri,
"code" => $code
);


$ch = curl_init ($urltopost);
curl_setopt ($ch, CURLOPT_POST, true);
curl_setopt ($ch, CURLOPT_POSTFIELDS, $datatopost);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
$returndata = curl_exec ($ch);

//echo $returndata;

$data = json_decode($returndata, true);

//echo "<br/><br/>";

//var_dump($data);

//echo "<br/><br/>";


$value = $data["access_token"];

//echo $value;



//write cookie
setcookie("access_token", $value, time()+60*60*24*365*10, '/');


?>
<html>
<head>
<meta http-equiv="refresh" content="0;url=index.php">
</head>
<body>
	
</body>
</html>


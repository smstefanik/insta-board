<?php
include 'settings.php';



//delete cookie
setcookie("access_token", $value, time()-3600, '/');

$response = file_get_contents("http://instagram.com/account/logout");

?>
<html>
<head>
<meta http-equiv="refresh" content="0;url=index.php">
</head>
<body>
	
</body>
</html>


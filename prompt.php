<?php
include 'settings.php';


?>

<!DOCTYPE html>
<html lang="en-us">
    <head>
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<meta http-equiv="Cache-control" content="no-cache" />
	<link rel="stylesheet" type="text/css" href="style.css">

	<script type="text/javascript">

	$(document).ready(function() {

	});


	</script>
	</head>
<body width="100%">
<div style="text-align:center;" class="font1 orange">
<a class="orange button" style="" href="https://api.instagram.com/oauth/authorize/?client_id=<?php echo $client_id ?>&redirect_uri=<?php echo $redirect_uri ?>&response_type=code">Tap to Login to Instagram</a>
</div>
</body>
</html>
<?php
include 'settings.php';

$access_token = $_COOKIE['access_token'];

if(!isset($access_token))
{
	header("Location: prompt.php");
}

?>

<!DOCTYPE html>
<html lang="en-us">
    <head>
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<meta http-equiv="Cache-control" content="no-cache" />
	<link rel="stylesheet" type="text/css" href="style.css">

	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-141920-4']);
	  _gaq.push(['_trackPageview']);

	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	</script>

<script type="text/javascript">

$(document).ready(function() {

	isRefreshing = false;
	latestData = {};
	currentIndex = 0;

	refreshFeed();

	//get feed every 15 minutes
	window.setInterval(refreshFeed,15*60*1000);

	//cycle photos
	window.setInterval(changePicture,15*1000);

	

});

function changePicture()
{
	if (isRefreshing)
		return;

	currentIndex = currentIndex + 1;

	if (currentIndex >= latestData.data.length)
		currentIndex = 0;

	setItemDetails(latestData.data[currentIndex]);
}

function refreshFeed()
{
	if (isRefreshing)
		return;

	isRefreshing = true;

	$.ajax({
		url: "https://api.instagram.com/v1/users/self/feed?access_token=<?php echo $access_token ?>",
		crossDomain : true,
		dataType: 'jsonp'
		})
	    .done(function(data, textStatus, jqXHR) { 

	    	//check for errors
	    	if (data.meta.code > 200)
	    	{
	    		//error
	    		$('.errorMessage').show();
	    	}

	    	latestData = data;

	    	isRefreshing = false;
	    	changePicture();

	    })
	    .fail(function() { 
	    	//alert("error"); 
	    })
	    .always(function() { 
	    	isRefreshing = false;
	    });
}

function setItemDetails(item)
{
	$('.fade').fadeOut(1500, function (){

		$('.mainImage').attr("src", item.images.standard_resolution.url);

		$('.profileImage').attr("src", item.user.profile_picture);

		$('.username').html(item.user.username);
		$('.fullName').html(item.user.full_name);
		$('.likes').html(item.likes.count);

		$('.fade').fadeIn(2000, function (){
		});
	});

		
}

</script>
</head>
<body>
	<div class="errorMessage red">ERROR<br/><br/>Triple-tap to reload.<br/><br/>or<br/><a href="prompt.php" class="button orange">LOGIN AGAIN</a></div>
	<div class="mainWrapper">
		<img src="transparent.gif" alt="" class="mainImage fade" width="100%" onload="$(this).fadeIn('1500');"/>
	</div>
	<div class="infoWrapper">
		<img src="transparent.gif" alt="" class="profileImage fade" height="44"/>
		<div class="username fade">
			
		</div>
		<div class="fullName gray fade">
			
		</div>

		<div class="heart fade">
			<div class="likes"></div>
		</div>
	</div>

</body>
</html>
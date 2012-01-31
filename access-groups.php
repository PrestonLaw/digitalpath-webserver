<?php
	# To be called from facebook or google submodule
	require_once("config.php"); 

	# Create global mongo collection
	#$conn = new Mongo('mongodb://' . $server);

#				$sessColl = $conn->selectDB($database)->selectCollection('sessions');
#
#				foreach ($sessColl->find()->sort(array('name' => 1)) as $sessDoc)
#					{
#					if (array_key_exists('label', $sessDoc))
#						{
#						$sessTitle = $sessDoc['label'];
#						}
#					else
#						{
#						$sessTitle = $sessDoc['name'];
#						}
#					echo '<li><a data-ajax="false" rel="external" href="session.php?sess=' , $sessDoc['_id'] , '">' , $sessTitle , '</a></li>' , "\n";
#					}


	function display_user_information()
		{
		# Displays user information including group memberships 
		
		foreach ($_SESSION['facebook'] as $key => $val)
			{	
			echo $key . " " . $val . "</br>";
			} 

		foreach ($_SESSION['groups'] as $key => $val)
			{	
			echo $key . " " . $val['name'] . "</br>";
			} 
		}

	function display_available_groups()
		{
				#$access_groups = $conn->selectDB($database)->selectCollection('groups');



		}


	#display_user_information();

	# Loads the groups database, and lists the intersection
	# Cleans up session cookie
?>
	
<!DOCTYPE html>
<html>
	<head>
		<title>Slide Atlas</title>
		<meta charset='utf-8' />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<meta name = "viewport" content = "width = device-width">
		<link rel="apple-touch-icon" href="favicon.ico" />
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.css" />
		<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.js"></script>
		<!-- large image specific additions  -->
		<link rel="stylesheet" href="css/mobile-map.css" type="text/css">
		<link rel="stylesheet" href="css/mobile-jq.css" type="text/css">
	</head>
	<body> 
		<!-- Index pages -->
		<div id="list" data-role="page">
			<div data-role="header">
				<h1>Slide Atlas</h1>
				<a href="" data-role="button" data-icon="gear" class='ui-btn-right' data-theme="<?php echo(($_SESSION['auth'] == 'admin') ? "b" : "a"); ?>">Options</a>
			</div><!-- /header -->

			<div data-role="content">
				<div id="banner">
					<h2>Session Index</h2>
				</div>
				<p>This website is supported on multiple devices including iPad, iPhone and latest desktop browsers</p>


				<?php  
					
					#display_user_information();
					display_available_groups();

				 ?>

				<ul data-role="listview" data-inset="true">
				<?php

#				# Loop through sessions
#				$conn = new Mongo('mongodb://' . $server);
#				$sessColl = $conn->selectDB($database)->selectCollection('sessions');
#
#				foreach ($sessColl->find()->sort(array('name' => 1)) as $sessDoc)
#					{
#					if (array_key_exists('label', $sessDoc))
#						{
#						$sessTitle = $sessDoc['label'];
#						}
#					else
#						{
#						$sessTitle = $sessDoc['name'];
#						}
#					echo '<li><a data-ajax="false" rel="external" href="session.php?sess=' , $sessDoc['_id'] , '">' , $sessTitle , '</a></li>' , "\n";
#					}
				?>
				</ul>
			</div><!-- /content -->
		</div><!-- /page -->
	</body>
</html>
-->

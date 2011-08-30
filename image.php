<!doctype html>
<?php

try
	{
	# Process command line parameters if any
	session_start();
	@$image_id =  $_GET['id'];
	
	# If parameters not available
	if(!isset($image_id))
		{
		$image_id = "4e25e244114d970935000051";

		}
	
	# Perform database initialization and get chapter name
	require_once("config.php"); 

	# connect
	$m = new Mongo($server, array('persist' => 'path'));
	
	# Perform the query to get image name, and number of levels
	$coll = $m->selectDB($database)->selectCollection("images"); 
  $oid = new MongoId($image_id);
	$query1 = array( "_id" => $oid);
	$obj = $coll->findOne($query1);
	$image_title = $obj['name'];

	$collection = $m->selectDB($database)->selectCollection($image_id); 
	$query = array( "name" => "t.jpg");
	$exclude = array( "file" => 0);

	$cursor = $collection->findOne($query, $exclude);
	#TODO: Error handling while getting level
	$level = $cursor['level']+1;
	}

# Error handling	
catch (Exception $e) 
	{
	header('content-type: text/plain');
  echo 'Caught exception: ',  $e->getMessage(), "\n";
	return;
	}
?>

<html>
    <head>
    <title>dermatopathology atlas</title>
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.css" />
    <script src="http://code.jquery.com/jquery-1.4.3.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.js"></script>
		<!-- large image specific additions  -->
		<link rel="stylesheet" href="css/mobile-map.css" type="text/css">
		<link rel="stylesheet" href="css/mobile-jq.css" type="text/css">
		<script>

<?php
	# Create javascript variables for large_images.js 
	echo("var tileSize =  256;\n");
	echo("var baseUrl = '" . $base_url . "';\n");
	echo("var zoomLevels = ". $level .";\n");
	echo("var baseName = '" . $database . "';\n");
	echo("var imageName = '");
	echo($image_id);
	echo("';\n");
?>
		</script>
	
		<script src="libs/OpenLayers.mobile.js"> </script>
		<script src="libs/TMS.js"></script>
		<script src="libs/mobile-jq.js"></script>
		<script src="libs/large_images.js"> </script>
</head>
<body> 
		<!-- The large image page -->
		<div data-role="page" id="mappage">
			<!-- <div data-role="header">
				<h1><?php echo($image_title); ?></h1>
			</div> -->

			<div data-role="content">
				<div id="map"></div>
			</div>

			<div data-role="footer">
				<a href="#searchpage" data-icon="search" data-role="button">Search</a>
				<a href="#imageinfo" id="locate" data-icon="locate" data-role="button">Info</a>
				<a href="#annotations" data-icon="annotations" data-role="button">Annotations</a>
			</div>
			
			<div id="navigation" data-role="controlgroup" data-type="vertical">
				<a href="" data-role="button" data-icon="plus" id="plus"
					 data-iconpos="notext"></a>
				<a href="" data-role="button" data-icon="minus" id="minus"
					 data-iconpos="notext"></a>
			</div>
		</div>
		
		<div data-role="page" id="annotations">
			<div data-role="header">
				<h1>Annotations</h1>
			</div>
			<div data-role="content">
			<form rel="external" action="../upload_ndpa.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="image_id" value="<? echo($image_id); ?>">
				<label for="file">Filename:</label>
				<input type="file" name="file" id="file" />
				<input type="submit" name="submit" value="Submit" />
			</form>
			
			Note: Annotations will be overwrittern <br/>

				<!-- <ul data-role="listview" data-inset="true" data-theme="d" data-dividertheme="c" id="layerslist">
				   </ul>
				-->
			</div>
		</div>

		<div data-role="page" id="imageinfo">
				<!-- <ul data-role="listview" data-inset="true" data-theme="d" data-dividertheme="c" id="layerslist">
				   </ul>
				-->
				No image info to display
				
			</div>
		</div>

</body>
</html>
 


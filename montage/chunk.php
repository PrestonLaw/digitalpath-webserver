<?php
# vim:tabstop=2:softtabstop=2:shiftwidth=2:noexpandtab:e 
//var_dump($_SESSION['book']);
# Process the command line parameters
$server = "127.0.0.1:27017";
$tileSize = 256;

@$col_name =  $_GET['image'];
@$fname =     $_GET['name'];
@$database = $_GET["db"];
if(!isset($database))
	{
	$database = 'tera';
	}

//header('content-type: image/jpeg');
# Return grey image as there is error or parameters not set
header('content-type: image/jpeg');
function grey_out()
	{
	#header('content-type: image/jpeg');
	$im = file_get_contents('../img/256-grey.jpg');
	echo $im; 
	}

# If parameters not available
if(!isset($col_name) || !isset($fname))
  {
	grey_out();
	return;
  }
try
	{
	# Connect
	$m = new Mongo($server);
	$collection = $m->selectDB($database)->selectCollection($col_name);
	
	# Query 
	$cursor = $collection->findOne( array('name' => $fname));
	if($cursor == null)
		{
		throw new Exception('Image not in database');
		}
	# Return the image chunk 
	$im = $cursor['file'];
	echo $im->bin;
	}
	catch(Exception $e)
	{
	grey_out();
	}
?>

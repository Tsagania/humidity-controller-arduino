<link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">
<style>

body{
	
	background-image:url("frontpage/world.jpg");
	min-height: 380px;
	background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    position: relative;
	-webkit-scroll-behavior: smooth;
	-moz-scroll-behavior: smooth;
	scroll-behavior: smooth;
}

h1{
	background-color:grey;
	text-align: center;
	font-size:250%;
	font-family: 'Alegreya SC', serif;
	font-style:italic;
}
</style>
<?php
	session_start();
	include "DataList.php";

	// Create a list of available values
	$availablevalues = new DataList();
	// Load avaiable values from DB
	$availablevalues->loadFromDB();
	// Show the table in HTML 
	echo "<h1> ΣΤΟΙΧΕΙΑ ΒΑΣΗΣ ΔΕΔΟΜΕΝΩΝ</h1>";
	$availablevalues->getResults();
	
	
	
	
	
?>
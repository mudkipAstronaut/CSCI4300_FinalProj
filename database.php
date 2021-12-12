<?php
$dsn='mysql:host=localhost; dbname=woohoo';
$username='root';
$password='';

function insertPic($noImage, $name, $db, $fileName, $sessionid) {
	if (!$noImage) {
		//gets placeID based on name, getting last placeID could introduce issues with simultaneous place addition
		$getPlaceID = "SELECT placeID FROM places WHERE places.placeName = '$name'";
		$statement = $db->prepare($getPlaceID);
		$statement->execute();
		$picPlaceID = $statement->fetchAll()[0]['placeID'];
		$statement->closeCursor();
		
		$addPic = "INSERT INTO pictures (image,  placeID, userID)
			VALUES ('$fileName', '$picPlaceID', '$sessionid')";
		
		$db->query($addPic);					
	}
}

try{
	$db = new PDO($dsn, $username, $password);
}
catch(PDOExcepiton $e){
	$error=$e->getMessage();
	echo '<p> Unable to connect to the database:'.$error;
	exit();
}
?>
<?php
$targetPath = "place_imgs/";
$noImage = ($_FILES['fileUpload']['size'] == 0) ? true : false;	
$fileName = "";

if(!$noImage){
	//get the actual path
	$fileName = basename($_FILES['fileUpload']['name']);
	$targetPath = $targetPath . $fileName;
	
	//make sure same image isn't being uploaded to 
	$checkSameFileName = "SELECT image FROM pictures WHERE image = :file";
	$statement = $db->prepare($checkSameFileName);
	$statement->bindValue(':file',$fileName);
	$statement->execute();
	$dupNames = $statement->fetchAll();
	$statement->closeCursor();	
	
	if (count($dupNames) < 1) {	
		move_uploaded_file($_FILES['fileUpload']['tmp_name'], $targetPath);
	
		//gets placeID based on name, getting last placeID could introduce issues with simultaneous place addition
		$name = str_replace('\'','\\\'',$name);
		$getPlaceID = "SELECT placeID FROM places WHERE places.placeName = '$name'";
		$s2 = $db->prepare($getPlaceID);
		$s2->execute();
		$picPlaceID = $s2->fetchAll()[0]['placeID'];
		$s2->closeCursor();
		
		$addPic = "INSERT INTO pictures (image,  placeID, userID)
			VALUES ('$fileName', '$picPlaceID', '$sessionid')";
		
		$db->query($addPic);	
	}
}

?>
<?php
$targetPath = "place_imgs/";
$noImage = ($_FILES['fileUpload']['size'] == 0) ? true : false;	
$fileName = "";
if(!$noImage){
	//get the actual path
	$fileName = basename($_FILES['fileUpload']['name']);
	$targetPath = $targetPath . $fileName;
	
	move_uploaded_file($_FILES['fileUpload']['tmp_name'], $targetPath);		
}	
	
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

insertPic($noImage, $name, $db, $fileName, $sessionid);
?>
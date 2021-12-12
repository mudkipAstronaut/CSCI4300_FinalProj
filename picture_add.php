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

insertPic($noImage, $name, $db, $fileName, $sessionid);
?>
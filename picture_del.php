<?php
$targetPath = "place_imgs/";
$fileName = $_GET['image'];
$place = $_GET['place'];

require_once('database.php');

//deletes filename from pictures
$deletePic = "DELETE FROM pictures WHERE pictures.image = '$fileName'";
$db->query($deletePic);

$location = 'location: place.php?place='.$place;
header($location);
?>
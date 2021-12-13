<?php
$targetPath = "place_imgs/";
$fileName = $_GET['image'];

require_once('database.php');

$deletePic = "DELETE FROM pictures WHERE pictures.image = '$fileName'";
$db->query($deletePic);

$location = 'location: place.php?place='.$place_id;
header($location);
?>
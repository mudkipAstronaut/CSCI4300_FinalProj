<?php
$user_id = filter_input(INPUT_POST, 'userID');
$place_id = filter_input(INPUT_POST, 'placeID');

require_once('database.php');

$delete = "DELETE FROM reviews WHERE placeID = :place AND userID = :user";
$statement = $db->prepare($delete);
$stetement->bindValue(':place', $place_id);
$stetement->bindValue(':user', $user_id);
$stetement->execute();
$statement->closeCursor();

//=========================
//update score 
//=========================

include('review_update_score.php');

$location = 'location: place.php?place='.$place_id;
header($location);
?>

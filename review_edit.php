<?php 
$user_id = filter_input(INPUT_POST, 'userID');
$place_id = filter_input(INPUT_POST, 'placeID');
$rating_ = filter_input(INPUT_POST, 'score');
$written_ = filter_input(INPUT_POST, 'written');
$written_ = str_replace('\'','\\\'',$written_);

require_once('database.php');

//update review 
$update = "UPDATE reviews SET score = :rating , written = :written WHERE placeID = :place AND userID = :user";
$statement = $db->prepare($update);
$statement->bindValue(':rating', $rating_);
$statement->bindValue(':written', $written_);
$stetement->bindValue(':place', $place_id);
$stetement->bindValue(':user', $user_id);
$statement->execute();

//=========================
//update score 
//=========================

include('review_update_score.php');

$location = 'location: place.php?place='.$place_id;
header($location);
?> 

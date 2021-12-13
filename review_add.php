<?php
$user_id = filter_input(INPUT_POST, 'userID');
$place_id = filter_input(INPUT_POST, 'placeID');
$rating_ = filter_input(INPUT_POST, 'score');
$written_ = str_replace('\'','\\\'',filter_input(INPUT_POST, 'written'));

require_once('database.php');

//insert review into database
$query = "INSERT INTO reviews
		(userID, placeID, score, written)
	VALUES
		(:user_id,:place_id,:rating_,:written_)";
$statement = $db->prepare($query);
$statement->bindValue(':place_id', $place_id);
$statement->bindValue(':user_id', $user_id);
$statement->bindValue(':rating_', $rating_);
$statement->bindValue(':written_', $written_);
$statement->execute();
$statement->closeCursor();

//=========================
//update score 
//=========================

include('review_update_score.php');

$location = 'location: place.php?place='.$place_id;
header($location);
?> 

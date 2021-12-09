<?php
$user_id = filter_input(INPUT_POST, 'userID');
$place_id = filter_input(INPUT_POST, 'placeID');
$rating_ = filter_input(INPUT_POST, 'score');
$written_ = filter_input(INPUT_POST, 'written');

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

//average all reviews for a place
$query = "SELECT AVG(score) AS average FROM reviews WHERE placeID = ".$place_id;
// $result = $db->prepare($query);
$result = $db->query($query);
// $statement->bindValue(':place_id', $place_id);
$result->execute();
$avgScore = $result->fetchAll()[0];
$result->closeCursor();
// echo $avgScore[0];
// $avgScore = $result->fetch_assoc();//->fetchAll()[0];

//update place review score
$update = "UPDATE places SET reviewScore = ".$avgScore['average']." WHERE places.placeID = ".$place_id;
$statement = $db->prepare($update);
// $statement->bindValue(':place_id', $place_id);
$statement->execute();
$statement->closeCursor();
?> 

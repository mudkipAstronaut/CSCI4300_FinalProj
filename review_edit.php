<?php 
$user_id = filter_input(INPUT_POST, 'userID');
$place_id = filter_input(INPUT_POST, 'placeID');
$rating_ = filter_input(INPUT_POST, 'score');
$written_ = filter_input(INPUT_POST, 'written');
$written_ = str_replace('\'','\\\'',$written_);

require_once('database.php');

//update review 
$update = "UPDATE reviews SET score = ".$rating_.", written = '".$written_.
"' WHERE placeID = ".$place_id." AND userID = ".$user_id;
$statement = $db->prepare($update);
$statement->execute();

//=========================
//update score 
//=========================

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

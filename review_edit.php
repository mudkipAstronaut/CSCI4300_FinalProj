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

include('review_update_score.php');
?> 

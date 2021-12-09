<?php
$user_id = filter_input(INPUT_POST, 'userID');
$place_id = filter_input(INPUT_POST, 'placeID');

require_once('database.php');

$delete = "DELETE FROM reviews WHERE placeID = ".$place_id." AND userID = ".$user_id;
$db->query($delete);

//=========================
//update score 
//=========================

include('review_update_score.php');
?>

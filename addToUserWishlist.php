<?php

$place_id = filter_input(INPUT_POST, 'placeID');
$user_id = filter_input(INPUT_POST, 'userID');

require_once('database.php');
	
// Add the place to the user's wishlist
$query = "INSERT INTO wishlist
		(userID, placeID, notes)
	VALUES
		(:user_id,:place_id,:notes)";
$statement = $db->prepare($query);
$statement->bindValue(':place_id', $place_id);
$statement->bindValue(':user_id', $user_id);
$statement->bindValue(':notes', NULL);
$statement->execute();
$statement->closeCursor();

?>
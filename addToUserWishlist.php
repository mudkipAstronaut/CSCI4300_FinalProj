<?php
// Get the category data

$place_id = filter_input(INPUT_POST, 'placeID');
$user_id = filter_input(INPUT_POST, 'userID');
//$url = filter_input(INPUT_POST, 'callingURL');

require_once('database.php');
	
// Add the product to the database  
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

$nameQ = "SELECT placeName FROM places WHERE placeID=".$place_id;
$s1 = $db->prepare($nameQ);
$s1->execute();
$name = $s1->fetchAll()[0];
$s1->closeCursor();

echo '<script>alert("Added '. $name[0]  .' to your Wishlist")</script>';

?>
<?php
// Get the category data
$wishlist_id = filter_input(INPUT_POST, 'itemWishlistID');

require_once('database.php');
	
// Add the product to the database  
$query = "DELETE 
		FROM wishlist
	WHERE
		wishlistID = :wishlist_id";
$statement = $db->prepare($query);
$statement->bindValue(':wishlist_id', $wishlist_id);
$statement->execute();
$statement->closeCursor();

$location = 'location: wishlist.php';
header($location);
?>
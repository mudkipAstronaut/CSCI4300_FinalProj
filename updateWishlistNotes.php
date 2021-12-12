<?php
$notes = $_POST['notesTextArea'];
$wishlist_id = filter_input(INPUT_POST, 'itemWishlistID');

require_once('database.php');
	
// Updates the corresponding wishlist item's note section 
$query = "UPDATE wishlist
		SET notes=:notes
	WHERE
		wishlistID = :wishlist_id";
$statement = $db->prepare($query);
$statement->bindValue(':notes', $notes);
$statement->bindValue(':wishlist_id', $wishlist_id);
$statement->execute();
$statement->closeCursor();
?>
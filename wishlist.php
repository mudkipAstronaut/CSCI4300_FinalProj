<?php
require('database.php');

$user_id = filter_input(INPUT_GET, 'userID');

$queryWishlist = "SELECT wishlist.notes,wishlist.wishlistID,places.placeName,places.city,places.country,places.description FROM wishlist,places WHERE wishlist.userID=4 AND wishlist.placeID=places.placeID;";
$statement1 = $db ->prepare($queryWishlist);
$statement1 -> execute();
$places = $statement1->fetchAll();
//$place_name = $places['placeName'];
$statement1 -> closeCursor();

?>

<!DOCTYPE html> 
<html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
<link rel="stylesheet" href="style.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.10.2/Sortable.min.js"></script>
<body>
<header>
<?php include('header.php'); ?>
</header>


<div id="wishlist-container">

<?php foreach ($places as $place) : ?>
  <div class="wishlistEntry">
    <div class="wishlist-aboveNotes">
	  <div>
        <img src="place_imgs/london.jpg" alt="interesting">
      </div>
	  <input type="submit" value="Remove From Wishlist" class="wishlistRemoveButton">
      <h2><a href=""><?php echo $place['placeName']; ?>: <?php echo $place['city']; ?>, <?php echo $place['country']; ?> </a></h2>
      <p class="placeDescription"> <?php echo $place['description']; ?> </p>
  	</div>
	<br>
	
	<form action="updateWishlistNotes.php" method="post" id="update_notes_form">
	  <div class="wishlist-Notes">
	    <p class="travelNotesHeader"> Travel Notes: </p>
		<input type="hidden" name="itemWishlistID" value="<?php echo $place['wishlistID']; ?>">
	    <textarea placeholder="Enter your travel plans/notes for this location here." class="wishlist-textarea" name="notesTextArea"><?php echo $place['notes']; ?></textarea>
   	    <input type="submit" value="Save Notes" class="wishlist-saveNotes">
	  </div>
	</form>
  </div>
<?php endforeach; ?>
</div>

<div id="wishlist-empty">
  <div class="wishlist-empty-text">
    <?php if (count($places) == 0) : ?>
      <p> It seems that your wishlist is empty. </p>
	  <p> Try searching for some places that interest you. </p>
    <?php endif; ?>
  </div>
</div>

<script>
  const dragArea = document.querySelector("#wishlist-container");
  new Sortable(dragArea, {
    animation: 350
  });
</script>


</body>
</html>

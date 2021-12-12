<?php
session_start();

if (!isset($_SESSION["uid"])) {
	header('location: ../CSCI4300_FinalProj');
}

require('database.php');

//$user_id = filter_input(INPUT_GET, 'userID');
$user_id = $_SESSION["uid"];

$queryWishlist = "SELECT wishlist.notes,wishlist.wishlistID,places.placeName,places.city,places.country,places.description,places.placeID FROM wishlist,places WHERE wishlist.userID=:uID AND wishlist.placeID=places.placeID;";
$statement1 = $db ->prepare($queryWishlist);
$statement1->bindValue(':uID', $user_id);
$statement1 -> execute();
$places = $statement1->fetchAll();
//$place_name = $places['placeName'];
$statement1 -> closeCursor();

?>

<!DOCTYPE html> 
<html>

<style>

.showNotes { 
	text-align: center;
	margin: 0 auto;
	width: 785px;
}



</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
<link rel="stylesheet" href="css/style.css"/>
<!-- <script src="http://ajax.goggleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.10.2/Sortable.min.js"></script>
<body>
<header>
<?php include('header.php'); ?>
</header>


<div id="wishlist-container">

<?php $wishlistIteration = 0; ?>
<?php foreach ($places as $place) : ?>
  <div class="wishlistEntry">
    <div class="wishlist-aboveNotes">
	  <?php
	    require('database.php');
	  
	    $getPlaceImage = "SELECT image,userID FROM pictures WHERE :currentPlace = pictures.placeID GROUP BY pictures.pictureID LIMIT 1";
	    $statement2 = $db ->prepare($getPlaceImage);
	    $statement2->bindValue(':currentPlace', $place['placeID']);
	    $statement2 -> execute();
	    $placePictures = $statement2->fetchAll();
	  
	    if (count($placePictures)==1) {
	      foreach ($placePictures as $placePicture) {
		    $imagePath = $placePicture['image'];
	      }
	    } else {
		    $imagePath = 'default.jpg';
	    }
	    $statement2 -> closeCursor();
	  ?>
	
	
	  <div>
        
		<a href="<?php echo 'place.php?place=' . $place['placeID']; ?>"><img alt="Location" src="place_imgs/<?php echo $imagePath; ?>" width="150" height="150"></a>
      </div>
	  
	  
	  <form action="removeFromUserWishlist.php" method="post" id="remove_from_wishlist_form">
	    <input type="hidden" name="itemWishlistID" value="<?php echo $place['wishlistID']; ?>">
	    <input type="submit" value="Remove From Wishlist" class="wishlistRemoveButton">
	  </form>
      <h2><a href="<?php echo 'place.php?place=' . $place['placeID']; ?>"><?php echo $place['placeName']; ?>: <?php echo $place['city']; ?>, <?php echo $place['country']; ?> </a></h2>
      <p class="placeDescription"> <?php echo $place['description']; ?> </p>
  	</div>
	<br>
	
	<iframe name="content" style="display:none;">
    </iframe>
    <form method="POST" name="wishlist" action="updateWishlistNotes.php" target="content" id="update_notes_form">
	  <div class="wishlist-Notes">
	    <!-- <p class="travelNotesHeader"> Travel Notes: </p>
		
		<!-- ------------------------------------------ -->
		<br>
		
		<button onclick="hideShowNotes(<?php echo $wishlistIteration; ?>)" class="showNotes"> Hide Travel Notes: </button>
		<div id="visibleNotes" name="notes">
		  <input type="hidden" name="itemWishlistID" value="<?php echo $place['wishlistID']; ?>">
	      <textarea placeholder="Enter your travel plans/notes for this location here." class="wishlist-textarea" name="notesTextArea"><?php echo $place['notes']; ?></textarea>
   	      <input type="submit" value="Save Notes" class="wishlist-saveNotes">
		</div>
		
		<!-- ------------------------------------------ -->
		
		
	  </div>
	</form>
  </div>
  <?php $wishlistIteration = $wishlistIteration + 1; ?>
  
<?php endforeach; ?>
</div>

<?php if (count($places) == 0) : ?>
<div id="wishlist-empty">
  <div class="wishlist-empty-text">
    <p> It seems that your wishlist is empty. </p>
	<p> Try searching for some places that interest you. </p>
  </div>
</div>
<?php endif; ?>

<script>
  
  function hideShowNotes(y) {
	  var x = document.querySelectorAll("[id='visibleNotes']");
	  
	  const element = document.querySelectorAll("[class='showNotes']");
	  if (x[y].style.display === "none") {
		  x[y].style.display = "block";
		  x[y].style.display.transition = "height 1s";
		  element[y].innerHTML = "Hide Travel Notes:";
	  } else {
		  x[y].style.display = "none";
		  x[y].style.display.transition = "height 1s";
		  element[y].innerHTML = "Show Travel Notes:";
	  }
  }
  
  <!-- ------------------------------------------ -->
</script>


</body>
</html>

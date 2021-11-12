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
  <div class="wishlistEntry">
    <div class="wishlist-aboveNotes">
	  <div>
        <img src="place_imgs/london.jpg" alt="interesting">
      </div>
	  <input type="submit" value="Remove From Wishlist" class="wishlistRemoveButton">
      <h2><a href=""> City1, Country </a></h2>
      <p class="placeDescription">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tempor id eu nisl nunc mi ipsum faucibus vitae aliquet. Laoreet suspendisse interdum consectetur libero id faucibus nisl.</p>
  	</div>
	<br>
	<div class="wishlist-Notes">
	  <p class="travelNotesHeader"> Travel Notes: </p>
	  <textarea placeholder="Enter your travel plans/notes for this location here." class="wishlist-textarea"></textarea>
   	  <input type="submit" value="Save Notes" class="wishlist-saveNotes">
	</div>
  </div>

  <div class="wishlistEntry">
    <div class="wishlist-aboveNotes">
	  <div>
        <img src="place_imgs/london.jpg" alt="interesting">
      </div>
	  <input type="submit" value="Remove From Wishlist" class="wishlistRemoveButton">
      <h2><a href=""> City2, Country </a></h2>
      <p class="placeDescription">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tempor id eu nisl nunc mi ipsum faucibus vitae aliquet. Laoreet suspendisse interdum consectetur libero id faucibus nisl.</p>
  	</div>
	<br>
	<div class="wishlist-Notes">
	  <p class="travelNotesHeader"> Travel Notes: </p>
	  <textarea placeholder="Enter your travel plans/notes for this location here." class="wishlist-textarea"></textarea>
   	  <input type="submit" value="Save Notes" class="wishlist-saveNotes">
	</div>
  </div>

  <div class="wishlistEntry">
    <div class="wishlist-aboveNotes">
	  <div>
        <img src="place_imgs/london.jpg" alt="interesting">
      </div>
	  <input type="submit" value="Remove From Wishlist" class="wishlistRemoveButton">
      <h2><a href=""> City3, Country </a></h2>
      <p class="placeDescription">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tempor id eu nisl nunc mi ipsum faucibus vitae aliquet. Laoreet suspendisse interdum consectetur libero id faucibus nisl.</p>
  	</div>
	<br>
	<div class="wishlist-Notes">
	  <p class="travelNotesHeader"> Travel Notes: </p>
	  <textarea placeholder="Enter your travel plans/notes for this location here." class="wishlist-textarea"></textarea>
   	  <input type="submit" value="Save Notes" class="wishlist-saveNotes">
	</div>
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

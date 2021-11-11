<!DOCTYPE html> 
<html>
<link rel="stylesheet" href="style.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.10.2/Sortable.min.js"></script>
<body>
<header>
<div id="topLevel" class="top_navbar">
<nav class="desktop-nav">
  <div style="display:inline" class="top_navbar">
    <ul class="top_navlist">
      <li id="icon" class="top_navlist"><a href="home.html"><span>WooHoo</span></a></li>
      <li id="navSearch" class="top_navlist"><input placeholder="Type Something Here"/></li>
      <li class="top_navlist"><a href="">Search</a></li>
      <li class="top_navlist"><a href="">Wishlist</a></li>
      <li class="top_navlist"><a href="">Login</a></li>
    </ul>
  </div>
</nav>
</div>
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

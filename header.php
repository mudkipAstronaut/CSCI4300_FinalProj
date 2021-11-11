<!DOCTYPE html>
<html>
<head>
<style>
input {
	margin: 0;
	border: 1px outset blue;	
}

input[type="submit"] {
	cursor: pointer;
	margin-left: 1px;
	background-color: rgb(255, 215, 0);
}

input[type="submit"]:hover {
	background-color: rgb(255, 245, 0);
}
</style>
</head>
<nav>
	<div id="topLevel" class="top_navbar">
	<div style="display:inline" class="top_navbar">
		<ul class="top_navlist" >
			<li id="icon" ><a href="index.php"><span>WooHoo</span></a></li>
			<form method="POST" name="searchBar" action="browse.php" onsubmit="return validate()">
				<li id="navSearch" >
				<!-- weird spacing on the search bar's right arrow to avoid whitespace --> 
				<input type="search" name="query" placeholder="Type Something Here"
				/><input type="submit" value="Search" /></li>
			</form>
			<script>
				function validate() {
					var query = document.searchBar.query.value;
					if (query == "" || query === null) {
						return false;
					}
					return true;
				}
			</script>
			<li class="right"><a href="">Login</a></li>
			<li class="right"><a href="">Wishlist</a></li>
			<!-- <li class="top_navlist" style="float:right; margin-right:5px; "><a href="">Login</a></li> -->
		</ul>		
	</div>
	</div>
</nav>
</html>

<?php
// require('database.php');
if (isset($_SESSION["uid"])) {
	$uid = $_SESSION["uid"];
	$query = "SELECT username FROM users WHERE userID='$uid'";
	$result = $db->prepare($query);
	$result->execute();	
	$username = $result->fetch();
	$result->closeCursor();
}

if(str_contains($_SERVER['REQUEST_URI'], 'login.php')) 
	$style = 'style="background-color:#BEFFFF;float:right;"';
else 
	$style = 'style="float:right;"';

?>

<style>
	
	#navSearch form input {		
		border: 1.5px outset slateblue;
		height: 24px;
	}

	#navSearch form input[type="submit"] {
		cursor: pointer;
		background-color: rgb(255, 215, 0);		
	}

	#navSearch form input[type="submit"]:hover {
		background-color: rgb(255, 245, 0);
	}
	
	/* signout button will look the same as a nav link */
	#logoutBtn{
		background: none;
		border: none;
		cursor: pointer;	
		color: rgb(0, 102, 204);	
		font-size: 1em;
	} 
	
	.top_navbar {
		background-color: #99EEFF;
	}


	.top_navlist {
		margin: 0;
	} 

	ul.top_navlist {
		list-style-type: none;	
		overflow: hidden;
		font-family: sans-serif;	
		padding-left: 10px;
		display: flex;
		align-item: center;
	}

	ul.top_navlist li:hover:not(.headUser) {
		background-color: #BEFFFF;
	}

	ul.top_navlist li:not(.headUser):active {
		background-color: #BEFFFF;
	}

	ul.top_navlist li:not(.log) {
		float: left;
		vertical-align: middle;
		// display: flex;
		// align-item: center;			
	}	
	
	.log {
		float: right;
	}

	ul.top_navlist li a, #logoutBtn {
		display: block;				
		text-decoration: none;
		padding: 2.5px 10px 0 10px;
		font-family: arial;
		font-size: 1em;
	}
	
	.headUser {
		display: block;				
		text-decoration: none;
		padding: 2.5px 10px 0 10px;
		font-family: arial;
		font-size: 1em;
	}

	header {
		width: 100%;
		align-items: center;  
	}

	#topLevel {
		padding-bottom: 3px;
		padding-top: 3px;
		border-bottom: 2px solid slateblue;
	}		
</style>

<nav>
	<div id="topLevel" class="top_navbar">
	<div style="display:inline" class="top_navbar">
		<ul class="top_navlist" >
			<li id="icon" ><a href="index.php"><span>WooHoo</span></a></li>
			<li id="navSearch" >
				<form method="POST" name="searchBar" action="browse.php" onsubmit="return validate()">
				<!-- weird spacing on the search bar's right arrow to avoid whitespace --> 
				<input type="search" name="query" placeholder="Type Something Here"
				/><input style="margin-left: 1px;" type="submit" value="Search" />
				</form>
			</li>	
			<!-- JavaScript checks if searchbar is empty before starting a search -->
			<script>
				function validate() {
					var query = document.searchBar.query.value;
					if (query == "" || query === null) {
						return false;
					}
					return true;
				}				
			</script>			
			
			<!-- link to wishlist if logged in and not viewing wishlist -->
			<?php if(isset($_SESSION["loggedin"])) : ?>
				<li <?php if(str_contains($_SERVER['REQUEST_URI'], 'wishlist.php')) 
					echo 'style="background-color:#BEFFFF;"'; ?>>
				<a href="wishlist.php">Wishlist</a></li>
			<?php endif; ?>
			
			<!-- display logout option while user is logged in, else display login -->
			<?php if(isset($_SESSION["loggedin"])) : ?>
				<!-- Delete cookie and update header -->
				<?php if(isset($_GET['logout'])) {
					session_unset();
					session_destroy();
					setcookie("rememberme", TRUE, time()-100);
					header('Location: ../CSCI4300_FinalProj');
					}?>
				<li class="log" style="float:right";><a href="?logout">Logout:</a></li>				
				<li class="log" style="float:right";><span class="headUser"><?php echo $username['username'] ?></span></li>
			<?php else : ?>
				
				<li class="log" <?php 
					if(str_contains($_SERVER['REQUEST_URI'], 'login.php')) 
						echo 'style="background-color:#BEFFFF;float:right;"';
					else 
						echo 'style="float:right;"';?>>
					<a href="login.php">Login</a></li>				
			<?php endif; ?>	
		</ul>		
	</div>
	</div>
</nav>
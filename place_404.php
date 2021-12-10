<html><head>
<link rel="stylesheet" href="style.css">
</head>
<body>
<header>

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
	
	#logoutBtn{
		background: none;
		border: none;
		cursor: pointer;	
		color: rgb(0, 102, 204);	
		font-size: 1em;
	} 
	
	.headUser {
		display: block;
		padding-top: 2.5px;		
		color: rgb(255, 128, 0);
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

	ul.top_navlist li:hover {
		background-color: #EEFFFF;
	}

	ul.top_navlist li:active {
		background-color: #EEFFFF;
	}

	ul.top_navlist li {
		float: left;
		vertical-align: middle;
		// display: flex;
		// align-item: center;			
	}	

	ul.top_navlist li a, #logoutBtn {
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
		<ul class="top_navlist">
			<li id="icon"><a href="index.php"><span>WooHoo</span></a></li>
			<li id="navSearch">
				<form method="POST" name="searchBar" action="browse.php">
					<!-- weird spacing on the search bar's right arrow to avoid whitespace --> 
					<input type="search" name="query" placeholder="Type Something Here" value="">
					<input style="margin-left: 1px;" type="submit" value="Search">
				</form>
			</li>	
			
			<!-- link to wishlist if logged in and not viewing wishlist -->
							<!-- header link will look selected if you're on that page -->
				<li>
				<a href="wishlist.php">Wishlist</a></li>
			
			<!-- link to addplace.php if logged in and not viewing it -->
				<!-- header link will look selected if you're on that page -->
				<li>
				<a href="addplace.php">Add Place</a></li>
			
			<!-- display logout option while user is logged in, else display login -->
				<!-- Delete cookie and update header -->
								<li class="log" style="float:right" ;="">
					<a href="?logout">Logout</a>					
				</li>
				<li class="log" style="float:right;">
					<a href="editprofile.php" class="headUser">Administration</a>
				</li>
				
		</ul>		
	</div>
	</div>
</nav></header>

<div class="center">
<h2 style="text-decoration:underline;">Error 404: This place does not exist</h2>











</div>

</body></html>
<style>
	#navSearch form input {		
		border: 1px outset blue;
		height: 24px;
	}

	#navSearch form input[type="submit"] {
		cursor: pointer;
		background-color: rgb(255, 215, 0);
	}

	#navSearch form input[type="submit"]:hover {
		background-color: rgb(255, 245, 0);
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
		background-color: #BEFFFF;
	}

	ul.top_navlist li:active {
		background-color: #BEFFFF;
	}

	ul.top_navlist li {
		float: left;
		vertical-align: middle;
		// display: flex;
		// align-item: center;			
	}	

	ul.top_navlist li a{
		display: block;				
		text-decoration: none;
		padding: 0px 10px;
		padding-top: 2.5px;
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
		</ul>		
	</div>
	</div>
</nav>
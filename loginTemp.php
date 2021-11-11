<?php
if(isset($_COOKIE['mycookie'])) {
	header('Location: home.php');
}

?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header><h1 class="productManager">Login</h1></header>
	<main>
		<form action="check.php" method="post" id="login_form">
			<label class="addLabel">Username:</label>
			<input type="text" name="name" class="loginInput" style="margin: 10px 0px 0px 40px"><br>
			<label class="addLabel">Password:</label>
			<input type="password" name="password" class="loginInput" style="margin: 10px 0px 0px 46px"><br>
			<label class="addLabel">Remeber me</label>
			<input type="checkbox" value="1" name="check">
			<input type="submit" value="Login" id="submit">
			
		</form>
	</main>
</body>
</html>
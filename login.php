<?php
session_start();
?>
<?php
	require('database.php');

	// define variables and set to empty values
    $nameErr = $passwordErr = $loginErr = "";
    $name = $password = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// get name
		if (empty($_POST['username'])) {
			$nameErr = "*Name is required";
		} else {
			$name=$_POST['username'];
		}

		// get password
		if (empty($_POST['password'])) {
			$passwordErr = "*Password is required";
		} else {
			$password=$_POST['password'];
		}

		// get rememberme
		if (!empty($_POST['check'])) {
			$check=$_POST['check'];
		}

		//Check if there are no errors
		if (empty($nameErr) && empty($passwordErr)) {

			$query="SELECT * FROM users WHERE username='$name' AND password='$password'";
		
			$data=$db->query($query);
			if ($data->rowCount() >0) {
				if ($check=='1') {
					setcookie("rememberme", TRUE, time()+3600);
				}
				$_SESSION["loggedin"] = TRUE;
				// add user id to cookies
				$idquery = "SELECT userID FROM users WHERE username='$name'";
				$row = $db->prepare($idquery);
				$row->execute();
				$id = $row->fetch();
				$row->closeCursor();
				$_SESSION["uid"] = $id['userID'];
				header('Location: ../CSCI4300_FinalProj');
			}
			else {
				$loginErr = "Incorrect Username or Password";
			}
		}
	}

	if(isset($_COOKIE['rememberme'])) {
		// add user id to cookies
		$idquery = "SELECT userID FROM users WHERE username='$name'";
		$row = $db->prepare($idquery);
		$row->execute();
		$id = $row->fetch();
		$row->closeCursor();
		$_SESSION["uid"] = $id['userID'];
		$_SESSION["loggedin"] = TRUE;
		header('Location: ../CSCI4300_FinalProj');
	}

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<?php include('header.php'); ?>
</head>
<body>
	<main>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
		<div class="login">
			<header><h1 class="loginHeader">Login</h1></header>
			<span class="error" style="margin: 0px 0px 0px 0px"><?php echo $loginErr; ?></span> <br>
			<label class="username">Username:</label>
			<input type="text" name="username" class="loginInput" style="margin: 10px 0px 0px 40px" require>
			<span class="error" style="margin: 0px 0px 0px 10px"><?php echo $nameErr; ?></span> <br>
			<label class="password">Password:</label>
			<input type="password" name="password" class="loginInput" style="margin: 10px 0px 0px 47px" require>
			<span class="error" style="margin: 0px 0px 0px 10px"><?php echo $passwordErr; ?></span> <br>
			<label class="rememberMe">Remeber me</label>
			<input type="checkbox" class="rememberMe" value="1" name="check"><br>
			<input type="submit" class="loginButton" value="Login" id="submit">
			<p class="registerredir">Not a member yet? <a href="register.php" class="registerredirlink">Register now!</a></p>
		</div>
		</form>
	</main>
</body>
</html>
<?php
	session_start();

	if (isset($_SESSION["uid"])) {
		header('location: ../CSCI4300_FinalProj');
	}
	require('database.php');

    //Validation

    // define variables and set to empty values
    $nameErr = $emailErr = $passwordErr = "";
    $name = $password = $email = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// get name
		if (empty($_POST['username'])) {
			$nameErr = "*Name is required";
		} else {
			$name=str_replace('\'','\\\'',$_POST['username']);
		}

		// get email
		if (empty($_POST['email'])) {
			$emailErr = "*Email is required";
		} else {
			$email=$_POST['email'];
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$emailErr = "*Invalid email format";
			}
		}

		// get password
		if (empty($_POST['password'])) {
			$passwordErr = "*Password is required";
		} else {
			$password=str_replace('\'','\\\'',$_POST['password']);
		}

		//Check if there are no errors
		if (empty($nameErr) && empty($emailErr) && empty($passwordErr)) {

			//Get registered date
			$date = date("Y-m-d");
			$query = "INSERT INTO Users (username, email, password, dateRegistered)
			VALUES ('$name', '$email', '$password', '$date')";
		
			$data=$db->query($query);
			header('Location: ../CSCI4300_FinalProj');
		}
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
			<header><h1 class="loginHeader">Register</h1></header>
			<label class="username">Username:</label>
			<input type="text" name="username" class="loginInput" style="margin: 10px 0px 0px 40px" require>
            <span class="error" style="margin: 0px 0px 0px 10px"><?php echo $nameErr; ?></span> <br>
            <label class="email">Email:</label>
			<input type="text" name="email" class="loginInput" style="margin: 10px 0px 0px 78px" require>
            <span class="error" style="margin: 0px 0px 0px 10px"><?php echo $emailErr; ?></span> <br>
			<label class="password">Password:</label>
			<input type="password" name="password" class="loginInput" style="margin: 10px 0px 0px 47px" require>
            <span class="error" style="margin: 0px 0px 0px 10px"><?php echo $passwordErr; ?></span> <br>
			<input type="submit" class="loginButton" value="Register" id="submit">
			<p class="registerredir">Already have an account? <a href="login.php" class="registerredirlink">Login!</a></p>
		</div>
		</form>
	</main>
</body>
</html>


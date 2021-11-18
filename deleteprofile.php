<?php
session_start();
?>
<?php
    require('database.php');

    $sessionid = $_SESSION['uid'];
    //Deletequery
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $query = "DELETE FROM users WHERE userID='$sessionid'";
        $data=$db->query($query);
        
        //Logout
        session_unset();
		session_destroy();
		setcookie("rememberme", TRUE, time()-100);
        header('Location: ../CSCI4300_FinalProj');
    }
?>



<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<?php include('header.php'); ?>
</head>
<body>
	<main>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
		<div class="delete">
            <label class="deleteWarn">Are You Sure?</label> <br>
            <lable class="deleteDesc">**You won't be able to recover your account once deleted!**</label>
            <br><br><br><br><br><br>
            <a href="editprofile.php" class="returnButton">Return</a>
			<input type="submit" class="deleteConfirmButton" value="YES" id="submit">
		</div>
		</form>
	</main>
</body>
</html>
<?php
session_start();

if (!isset($_SESSION["uid"])) {
	header('location: ../CSCI4300_FinalProj');
}
?>
<?php
	require('database.php');
    

	// define variables and set to empty values
    $nameErr = $passwordErr = $newPassErr = $confirmErr = "";
    $name = $password = $newpassword = $newpassword = "";

    $sessionid = $_SESSION['uid'];

    $namequerry = "SELECT username FROM users WHERE userID='$sessionid'";
    $row = $db->prepare($namequerry);
    $row->execute();
    $nameValue = $row->fetch();
    $row->closeCursor();
    $name = $nameValue["username"];

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// get name
		if (empty($_POST['username'])) {
			$nameErr = "*Name is required";
		} else {
			$name=$_POST['username'];
		}

		// get password
		if (!empty($_POST['password'])) {
			$password=$_POST['password'];
		}

        // get  new password
		if (!empty($_POST['newpassword'])) {
			$newpassword=$_POST['newpassword'];
		}

        // get confirm password
		if (!empty($_POST['confirmpassword'])) {
			$confirmpassword=$_POST['confirmpassword'];
		}

		//Check if there are no errors
		if (empty($nameErr) && empty($passwordErr)) {

            //check password
            if (!empty($password)) {
                //check if new and confirm exists
                if (!empty($newpassword)) { 
                    if (!empty($confirmpassword)) {
                        $passquery="SELECT * FROM users where userID='$sessionid' AND password='$password'";
                        $data=$db->query($passquery);

                        // check if confirm and newpass is same
                        if ($data->rowCount() >0) {
                            if ($confirmpassword == $newpassword) {
                                // save password into database
                                $query = "UPDATE Users SET password='$newpassword' WHERE userID='$sessionid'";
		
			                    $data=$db->query($query);
                            } else {
                                $confirmErr = "*Confirm Password must be same as new password";
                            }
                        } else {
                            $passwordErr = "*Password is incorrect";
                        }
                    } else {
                        $confirmErr = "*Confirm Password is required";
                    }
                } else {
                    $newPassErr = "*New Password is required";
                }
                
            }

            $query = "SELECT * FROM users WHERE username='$name' AND userID!='$sessionid'";
            $data=$db->query($query);
            if ($data->rowCount() >0) {
                $nameErr = "*That username already exists";
                // change name back
                $name = $nameValue["username"];
            } else {
                // save name into database
                $query = "UPDATE Users SET username='$name' WHERE userID='$sessionid'";

                $data=$db->query($query);  
            }

            
            if (empty($nameErr) && empty($passwordErr) && empty($newPassErr) &&empty($confirmErr)) {
                header('Location: ../CSCI4300_FinalProj');
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
		
		<div class="login">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			    <header><h1 class="loginHeader">Edit Profile</h1></header>
			    <label class="username">Username:</label>
			    <input type="text" name="username" class="loginInput" style="margin: 10px 0px 0px 110px" value="<?php echo htmlentities($name)?>">
			    <span class="error" style="margin: 0px 0px 0px 10px"><?php echo $nameErr; ?></span> <br><br>
                <label class="password">Current Password:</label>
			    <input type="password" name="password" class="loginInput" style="margin: 10px 0px 0px 50px">
			    <span class="error" style="margin: 0px 0px 0px 10px"><?php echo $passwordErr; ?></span> <br>
			    <label class="password">New Password:</label>
			    <input type="password" name="newpassword" class="loginInput" style="margin: 10px 0px 0px 76px">
			    <span class="error" style="margin: 0px 0px 0px 10px"><?php echo $newPassErr; ?></span> <br>
                <label class="password">Confirm New Password:</label>
			    <input type="password" name="confirmpassword" class="loginInput" style="margin: 10px 0px 0px 7px">
			    <span class="error" style="margin: 0px 0px 0px 10px"><?php echo $confirmErr; ?></span> <br>
			    <input type="submit" class="loginButton" value="Save" id="submit">
                <a href="deleteprofile.php" class="deleteProfile">Delete Profile</a>
            </form>
		</div>
		
	</main>
</body>
</html>
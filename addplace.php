<?php
session_start();
?>
<?php
	require('database.php');
    

	// define variables and set to empty values
    $nameErr = $cityErr = $countryErr = "";
    $name = $city = $country = $desc = $img = "";
    $targetPath = "/opt/lampp/htdocs/CSCI4300_FinalProj/place_imgs/";

    $sessionid = $_SESSION['uid'];

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// get name
		if (empty($_POST['placename'])) {
			$nameErr = "*Name is required";
		} else {
			$name=$_POST['placename'];
		}

		// get city
		if (empty($_POST['city'])) {
			$cityErr = "*City is required";
		} else {
			$city=$_POST['city'];
		}

        // get country
		if (empty($_POST['country'])) {
			$countryErr = "*Country is required";
		} else {
			$country=$_POST['country'];
		}

        // get description
		if (!empty($_POST['desc'])) {
			$desc = $_POST['desc'];
		}

	// get Image
	       if( !empty($_FILES['fileUpload']) ){
	       	   	//get the actual path
			$targetPath = $targetPath . basename($_FILES['fileUpload']['name']);

			if(move_uploaded_file($_FILES['fileUpload']['tmp_name'], $targetPath)){
				echo '<script>alert("Success")</script>';
			}
			else{
				echo '<script>alert("nah")</script>';
				print_r($_FILES['fileUpload']);
				echo $targetPath;
			}
		}

        //Check for errors
        if (empty($nameErr) && empty($cityErr) && empty($countryErr)) {
            $inquery = "";
            if (empty($desc)) {
                $inquery = "INSERT INTO places (placeName, city, country, userID)
                VALUES ('$name', '$city', '$country', '$sessionid')";
            } else {
                $inquery = "INSERT INTO places (placeName, city, country, description, userID)
                VALUES ('$name', '$city', '$country', '$desc', '$sessionid')";
            }
            $data=$db->query($inquery);
	    //header('Location: ../CSCI4300_FinalProj');
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
		//header('Location: ../CSCI4300_FinalProj');
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
		
		<div class="login">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
			    <header><h1 class="loginHeader">Add New Place</h1></header>
			    <label class="username">Place Name:</label>
			    <input type="text" name="placename" class="loginInput" style="margin: 10px 0px 0px 17px">
			    <span class="error" style="margin: 0px 0px 0px 10px"><?php echo $nameErr; ?></span> <br>
                <label class="password">City:</label>
			    <input type="text" name="city" class="loginInput" style="margin: 10px 0px 0px 80px">
			    <span class="error" style="margin: 0px 0px 0px 10px"><?php echo $cityErr; ?></span> <br>
			    <label class="password">Country:</label>
			    <input type="text" name="country" class="loginInput" style="margin: 10px 0px 5px 47px">
			    <span class="error" style="margin: 0px 0px 0px 10px"><?php echo $countryErr; ?></span> <br>
                <label class="password">Description:</label>
                <textarea name="desc" rows="4" cols="50" class="loginInput" style="margin: 10px 0px 0px 20px; vertical-align: top"></textarea> <br>

			    <label class="password">Image:</label>
			    <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
    			    <input type="file" name="fileUpload" id="fileUpload" class="loginInput" style="margin: 10px 0px 0px 60px"><br>
				
			    <input type="submit" class="loginButton" value="Add Place" id="submit">
            </form>
		</div>
		
	</main>
</body>
</html>
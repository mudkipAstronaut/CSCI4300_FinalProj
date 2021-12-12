<?php
session_start();
?>
<?php
	require('database.php');	

function insertPic($noImage, $name, $db, $fileName, $sessionid) {
	if (!$noImage) {
		//gets placeID based on name, getting last placeID could introduce issues with simultaneous place addition
		$getPlaceID = "SELECT placeID FROM places WHERE places.placeName = '$name'";
		$statement = $db->prepare($getPlaceID);
		$statement->execute();
		$picPlaceID = $statement->fetchAll()[0]['placeID'];
		$statement->closeCursor();
		
		$addPic = "INSERT INTO pictures (image,  placeID, userID)
			VALUES ('$fileName', '$picPlaceID', '$sessionid')";
		
		$db->query($addPic);					
	}
}
    

	// define variables and set to empty values
    $nameErr = $cityErr = $countryErr = "";
    $name = $city = $country = $desc = $img = "";

    $sessionid = $_SESSION['uid'];

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// get name
		if (empty($_POST['placename'])) {
			$nameErr = "*Name is required";
		} else {
			//escape any apostrophes to prevent SQL errors
			$name= str_replace('\'','\\\'',$_POST['placename']);
		}

		// get city
		if (empty($_POST['city'])) {
			$cityErr = "*City is required";
		} else {
			$city =$_POST['city'];
		}

        // get country
		if (empty($_POST['country'])) {
			$countryErr = "*Country is required";
		} else {
			//escape any apostrophes to prevent SQL errors
			$country = str_replace('\'','\\\'',$_POST['country']);
		}

        // get description
		if (!empty($_POST['desc'])) {
			//escape any apostrophes to prevent SQL errors
			$desc = str_replace('\'','\\\'',$_POST['desc']);
		}

	// get Image
		$targetPath = "C:/xampp/htdocs/F/CSCI4300_FinalProj/place_imgs/";
		$noImage = ($_FILES['fileUpload']['size'] == 0) ? true : false;	
		$fileName = "";
		if(!$noImage){
			//get the actual path
			$fileName = basename($_FILES['fileUpload']['name']);
			$targetPath = $targetPath . $fileName;
			
			move_uploaded_file($_FILES['fileUpload']['tmp_name'], $targetPath);		
		} 		

        //Check for errors
        if (empty($nameErr) && empty($cityErr) && empty($countryErr)) {
            $inquery = "";
			//inserting place with or without a description or image
            if (empty($desc)) {
                $inquery = "INSERT INTO places (placeName, city, country, userID)
                VALUES ('$name', '$city', '$country', '$sessionid')";
            } else {
                $inquery = "INSERT INTO places (placeName, city, country, description, userID)
                VALUES ('$name', '$city', '$country', '$desc', '$sessionid')";				
            }
            $data=$db->query($inquery);
			//inserts pic for place after getting placeID
			insertPic($noImage, $name, $db, $fileName, $sessionid);
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
</head>
<body>
	<header>
		<?php include('header.php'); ?>		
	</header>
	<script>
	let ul = document.getElementById('headUL');
	ul.style.maxHeight = "24px";
	</script>
	<main>
		
		<div class="login">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
			    <header><h1 class="loginHeader">Add New Place</h1></header>
				<!-- insert place name -->
			    <label class="username">Place Name:</label>
			    <input type="text" name="placename" class="loginInput" style="margin: 10px 0px 0px 17px">
			    <span class="error" style="margin: 0px 0px 0px 10px"><?php echo $nameErr; ?></span> <br>
				<!-- insert city -->
                <label class="password">City:</label>
			    <input type="text" name="city" class="loginInput" style="margin: 10px 0px 0px 80px">
			    <span class="error" style="margin: 0px 0px 0px 10px"><?php echo $cityErr; ?></span> <br>
				<!-- insert country -->
			    <label class="password">Country:</label>
			    <input type="text" name="country" class="loginInput" style="margin: 10px 0px 5px 47px">
			    <span class="error" style="margin: 0px 0px 0px 10px"><?php echo $countryErr; ?></span> <br>
				<!-- insert description -->
                <label class="password">Description:</label>
                <textarea name="desc" rows="4" cols="50" class="loginInput" style="margin: 10px 0px 0px 20px; vertical-align: top"></textarea> <br>
				
				<!-- insert image -->
			    <label class="password">Image:</label>
			    <!-- <input type="hidden" name="MAX_FILE_SIZE" value="1000000"> -->
				<input type="file" name="fileUpload" id="fileUpload" value="" class="loginInput" style="margin: 10px 0px 0px 60px"><br>
				
			    <input type="submit" class="loginButton" value="Add Place" id="submit">
            </form>
		</div>
		
	</main>
</body>
</html>
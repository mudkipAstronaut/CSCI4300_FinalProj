<?php
session_start();
?>
<?php
    require('database.php');

    $sessionid = $_SESSION['uid'];

    $placeGet = $_GET['place'];	
	if (isset($_POST['placeid'])) $place = $_POST['placeid'];

    //to make sure that anyone not logged in but admin
    if($sessionid != 1){
      header('Location: ../CSCI4300_FinalProj/');
    }
    if(empty($_GET['place'])){
	header('Location: ../CSCI4300_FinalProj/');
    }

    //Deletequery
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       	//delete from places
        $query = "DELETE FROM places WHERE placeID='$place'";
        $data=$db->query($query);
	
	//delete from wishlist
	$deleteWishlist = "DELETE FROM wishlist WHERE placeID = '$place'";
	$data1 = $db->query($deleteWishlist);
	
       	//delete from pictures
 	$query = "DELETE FROM pictures WHERE placeID='$place'";
        $data2=$db->query($query);

	//delete from reviews
        $query = "DELETE FROM reviews WHERE placeID='$place'";
        $data3=$db->query($query);

	header('Location: ../CSCI4300_FinalProj/browse.php');
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
            <lable class="deleteDesc">**You won't be able to recover this place once deleted!**</label>
            <br><br><br><br><br><br>
            <a href="<?php echo 'place.php?place='.$placeGet; ?>" class="returnButton">Return</a>
	       <input type="hidden" name="placeid" value="<?php echo $placeGet; ?>">
			<input type="submit" class="deleteConfirmButton" value="YES" id="submit">
		</div>
		</form>
	</main>
</body>
</html>
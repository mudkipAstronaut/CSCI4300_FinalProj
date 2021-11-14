<?php
require('database.php');

$name=$_POST['name'];
$password=$_POST['password'];
$check=$_POST['check'];

$query="SELECT * FROM users WHERE username='$name' AND password='$password'";

$data=$db->query($query);

if($data->rowCount()>0) {
	if($check=='1') {
		setcookie("mycookie", TRUE, time()+60);
	}
	header('Location: index.php');
} else {
	header('Location: invalidLogin.php');
}
?>
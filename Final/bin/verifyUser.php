<?php
$lastname = $_POST['lname'];
$password = $_POST['password'];

$con=mysqli_connect("localhost","root","","poolplayers");
if (mysqli_connect_errno()){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$query = "SELECT first_name, last_name, password FROM `players` WHERE last_name = '$lastname'";
$players = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($players);
if($row['last_name']==$lastname){
	if($row['password']==$password){
		echo $row['first_name'];
	} else {
		echo 'fail';
	}
} else {
	echo 'fail';
}
?>
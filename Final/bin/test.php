<?php 
  /*$name = prepareData($_POST['name']);
  $building = prepareData($_POST['building']);
  $pwd1 = prepareData($_POST['pwd1']);
  $pwd2 = prepareData($POST['pwd2']);
  echo "inside php";*/
  
  $name = prepareData("Ian Vetter");
  $building = prepareData("Frear Hall");
  $pwd1 = prepareData("hello");
  $pwd2 = prepareData("hello");
  
  if ($pwd1 == $pwd2){
  	echo "inserting data";
  	insertData($name, $building, $pwd1);
  }
  
  function prepareData($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  
  function insertData($name, $building, $pwd1){
  	$con=mysqli_connect("localhost","root","","poolplayers");
	if (mysqli_connect_errno()){
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
	$encrypted = md5($pwd1);
  	$insert = "INSERT INTO players VALUES ('$name', '$encrypted', '$building', 0, 0, 1000)";
	mysqli_query($con,$insert);
	mysqli_close($con);
  }
?>
<?php 

  $fname = prepareData($_POST['fname']);
  $lname = prepareData($_POST['lname']);
  $building = prepareData($_POST['building']);
  $email    = prepareData($_POST['email']);
  $pwd1 = prepareData($_POST['pwd1']);
  $pwd2 = prepareData($_POST['pwd2']);
  //echo "Name: $name Building: $building Pwd1: $pwd1 Pwd2: $pwd2";
  
  if ($pwd1 == $pwd2 && $fname != NULL && $lname != NULL && $building != NULL && $email != NULL){
  	//echo "inserting data";
  	insertData($fname, $lname, $building, $pwd1, $email);
	echo $fname;
  }
  
  function prepareData($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  
  function insertData($fname, $lname, $building, $pwd1, $email){
  	$con=mysqli_connect("localhost","root","","poolplayers");
	if (mysqli_connect_errno()){
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
	//$encrypted = md5($pwd1);
  	$insert = "INSERT INTO players VALUES (NULL,'$fname', '$lname', 'none', '$pwd1', '$building', 1000)";
	mysqli_query($con,$insert);
	mysqli_close($con);
  }
?> 
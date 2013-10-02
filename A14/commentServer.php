<!DOCTYPE html>
<html lang="en">
	<head>
		 <link href="style.css" rel="stylesheet">
	</head>
	<body>
		<h1>Comments:</h1>
		<?php
		//Some variables for easy changing
		$table = "comments";
		$host  = "localhost";
		$un    = "root";
		$pw    = "";
		$db    = "ics415";
		
		$con = mysqli_connect($host, $un, $pw, $db) or  
          die("Could not connect: " . mysqli_error());  

		  if (isset($_POST['submit'])) {
		  	$comment = htmlentities($_POST['comment']);
            mysqli_query($con,"CREATE TABLE IF NOT EXISTS `$table` (`id` int(11) NOT NULL AUTO_INCREMENT,`comment` varchar(200) NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");
			mysqli_query($con,"INSERT INTO `$db`.`$table` (`id`, `comment`) VALUES (NULL, '$comment');");
		  }
		  $comments = mysqli_query($con, "SELECT COMMENT FROM  `$table`");
		  while($row = mysqli_fetch_array($comments)){
		  	echo $row[0]."<br>";
		  }
		  mysqli_close($con);
		?>
		<form action="commentServer.php" method="post" onsubmit="register.disabled = true;  return true;">
			<input type="text" placeholder="Comment..." name="comment" required pattern="^.*[^\s]+.*$" oonchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please use something other than white space in your comment!' : '');"/>
			<input type="submit" name="submit" value="Submit" />
		</form>
	</body>
</html>
<?php 
	if(isset($_POST['uname'])){
		setcookie('uname', $_POST['uname']);	
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		 <link href="style.css" rel="stylesheet">
	</head>
	<body>
		<h1>Comments:</h1>
		<?php
		//Some variables for easy changing
		$table = "comments2";
		$host  = "localhost";
		$un    = "root";
		$pw    = "";
		$db    = "ics415";
		
		$con = mysqli_connect($host, $un, $pw, $db) or  
          die("Could not connect: " . mysqli_error());  

		  if (isset($_POST['submit'])) {
		  	$comment = htmlentities($_POST['comment']);
			$user    = $_POST['uname'];
            mysqli_query($con,"CREATE TABLE IF NOT EXISTS `$table` (`id` int(11) NOT NULL AUTO_INCREMENT,`comment` varchar(200) NOT NULL, `user` varchar(50) NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");
			mysqli_query($con,"INSERT INTO `$db`.`$table` (`id`, `comment`, `user`) VALUES (NULL, '$comment', '$user');");
		  }
		  $comments = mysqli_query($con, "SELECT COMMENT, USER FROM  `$table`");
		  echo "<ul>";
		  while($row = mysqli_fetch_array($comments)){
		  	echo "<li>".$row[0]." -<i>".$row[1]."</i></li>";
		  }
		  echo "</ul>";
		  
		  $users = mysqli_query($con, "SELECT DISTINCT USER FROM  `$table`");
		  
		  echo "<h1>Statistics</h1><ul>";
	      
		  while($row = mysqli_fetch_array($users)){
		    echo "<li>$row[0] - ";
			$userComments = mysqli_query($con, "SELECT COMMENT FROM  `$table` WHERE user = '$row[0]'");
			$count = mysqli_num_rows($userComments);
			echo "$count posts</li>";
		  }
		  
		  echo "</ul>";
		  
		  mysqli_close($con);
		?>
		<form action="commentServer.php" method="post" onsubmit="register.disabled = true;  return true;">
			<input type="text" placeholder="Comment..." name="comment" required pattern="^.*[^\s]+.*$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please use something other than white space in your comment!' : '');"/>
			<input type="text" placeholder="Username" name="uname">
			<input type="submit" name="submit" value="Submit" />
		</form>
	</body>
</html>
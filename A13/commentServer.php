<!DOCTYPE html>
<html lang="en">
	<head>
		 <link href="style.css" rel="stylesheet">
	</head>
	<body>
		<h1>Comments:</h1>
		<?php
		  if (isset($_POST['submit'])) {
		  	$file=fopen("comments.txt","a") or exit("Comments.txt does not exist.");
			$comment = htmlentities($_POST['comment']);
		  	fwrite($file,$comment."\n");
			fclose($file);
          }
		  
		  $file=fopen("comments.txt","r") or exit("Comments.txt does not exist.");
          while(! feof($file)){
            echo fgets($file)."<br>";
          }
		  fclose($file);
		?>
		<form action="commentServer.php" method="post" onsubmit="register.disabled = true;  return true;">
			<input type="text" placeholder="Comment..." name="comment" required pattern="^.*[^\s]+.*$" onchange="
  this.setCustomValidity(this.validity.patternMismatch ? 'Please use something other than white space in your comment!' : '');"/>
			<input type="submit" name="submit" value="Submit" />
		</form>
	</body>
</html>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="img/favicon.ico" />

    <title>Manoa 8-Ball League</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
      <script src="assets/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Manoa 8-Ball League</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#format">Format</a></li>
            <li><a href="#rules">Rules</a></li>
          </ul>
          <form class="navbar-form navbar-right">
          	<?php
          	if(!isset($_COOKIE['name'])){
          	?>
            <div class="form-group">
              <input type="text" placeholder="Last Name" id="lastName" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" id="userPW" class="form-control">
            </div>
            <button type="submit" id="login" class="btn btn-success">Login</button>
            <?php
			} else {
            ?>
            <button type="button" id="report" class="btn btn-warning">
  				<!--<span class="glyphicon glyphicon-envelope"> Report</span>-->
  				Report Match
			</button>
		    <button type="submit" id="logout" class="btn btn-success">Logout</button>	
            <?php
			}
            ?>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </div>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container" id="insideJumbo">
      	<?php
      	if(!isset($_COOKIE['name'])){
      	?>
      		<h1>Welcome!</h1>
        	<p>Welcome to the Manoa 8-ball league! This is a league set up to provide organized 8-ball games for anyone interested in playing here at UH Manoa. Games can take place at anytime and at any pool table as long as they are agreed upon as league games. When a games done simply report it via this website and watch as you move up or down the ladder.</p>
        	<p><button class="btn btn-primary btn-lg" id="signup">Sign Up &raquo;</button></p>	
      	<?php
      	} else {
      		echo "<h2>Hello ".$_COOKIE['name']."</h2>";	
      	?>
      	<p>You have no recent games played.</p>
      	<div class="table-responsive">
      	<table class="table table-striped table-bordered">
			<tr>
				<th>Name</th>
				<th>Building</th>
			    <th>Wins</th>
			    <th>Losses</th>
			    <th>ELO</th>
			</tr>
			<?php
				$con=mysqli_connect("localhost","root","","poolplayers");
				if (mysqli_connect_errno()){
     		    	echo "Failed to connect to MySQL: " . mysqli_connect_error();
   				}
				$query = "SELECT player_id, first_name, last_name, building, elo FROM `players`";
				$players = mysqli_query($con, $query);
				$index = 1;
				while($row = mysqli_fetch_assoc($players)){
					echo"<tr>";
					echo"<td>".$index.". ".$row['first_name']." ".$row['last_name']."</td>";
					echo"<td>".$row['building']."</td>";
					$query="SELECT matches.match_id FROM matches, players WHERE players.player_id = matches.winner_id AND players.player_id = ".$row['player_id'];
					echo"<td>".mysqli_num_rows(mysqli_query($con, $query))."</td>";
					$query = "SELECT matches.match_id FROM matches, players WHERE players.player_id != matches.winner_id AND players.player_id = ".$row['player_id']." AND (matches.player1_id = players.player_id OR matches.player2_id = players.player_id)";
					echo"<td>".mysqli_num_rows(mysqli_query($con, $query))."</td>";
					echo"<td>".$row['elo']."</td>";
					echo"</tr>";
					$index++;
				}
				mysqli_close($con);
			?>
		</table>
		</div>
      	<?php	
      	}
        ?>
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-lg-4">
          <h2>Format</h2>
          <p>The Manoa 8-Ball League is an amateur league that attempts to provide structured play for anyone interested in playing competitive 8-ball. The league is open to anyone of any skill level with tournaments being held at the end of each season to decide upon the season champion. A more in depth summary of how the league is structured is provided below.</p>
          <p><a class="btn btn-default" href="#">View details &raquo;</a></p>
        </div>
        <div class="col-lg-4">
          <h2>Rules</h2>
          <p>The Manoa 8-Ball League uses the official American Poolplayers Association (APA) rules which can be found <a href="http://www.poolplayers.com/8-9-ball-Rules.pdf">here</a>. A quick summary of those rules is provided below.</p>
          <p><a class="btn btn-default" href="#">View summary &raquo;</a></p>
       </div>
        <div class="col-lg-4">
          <h2>Ladder</h2>
          <p>An ELO ladder is kept that is based on your win/loss ratios. View it here.</p>
          <p><a class="btn btn-default" href="#">View ladder &raquo;</a></p>
        </div>
      </div>
      
      <div id="reportBox">
      	<form>
      		<label>Report a Match</label><br>
      		<label for="player2">Opponent</label>
      		<select class="form-control" id="player2">
      			<?php
      			    $con=mysqli_connect("localhost","root","","poolplayers");
      				$query="SELECT first_name, last_name FROM players WHERE first_name NOT LIKE '".$_COOKIE['name']."'";
					$players = mysqli_query($con, $query);
					while($row = mysqli_fetch_assoc($players)){
						echo"<option value='".$row['first_name']." ".$row['last_name']."'>".$row['first_name']." ".$row['last_name']."</option>";
					}
					mysqli_close($con);
      			?>
      		</select>
      		<div class="radio">
              <label>
                <input type="radio" name="options" id="win" value="win" checked>
                  I won!
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="options" id="loss" value="loss">
                  I lost!
              </label>
            </div>
            <button class="btn btn-primary">Report!</button>
      	</form>
      </div>

      <hr>

      <footer>
        <p>&copy; Joshua Kulhavy-Sutherland 2013</p>
      </footer>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/jquery.cookies.js"></script>
    
  </body>
</html>

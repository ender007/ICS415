		<table>
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
				while($row = mysqli_fetch_assoc($players)){
					echo"<tr>";
					echo"<td>".$row['first_name']." ".$row['last_name']."</td>";
					echo"<td>".$row['building']."</td>";
					$query="SELECT matches.match_id FROM matches, players WHERE players.player_id = matches.winner_id AND players.player_id = ".$row['player_id'];
					echo"<td>".mysqli_num_rows(mysqli_query($con, $query))."</td>";
					$query = "SELECT matches.match_id FROM matches, players WHERE players.player_id != matches.winner_id AND players.player_id = ".$row['player_id']." AND (matches.player1_id = players.player_id OR matches.player2_id = players.player_id)";
					echo"<td>".mysqli_num_rows(mysqli_query($con, $query))."</td>";
					echo"<td>".$row['elo']."</td>";
					echo"</tr>";
				}
			?>
		</table>
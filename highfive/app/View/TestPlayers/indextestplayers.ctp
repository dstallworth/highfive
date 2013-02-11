
<h1>High Five - TEST</h1>

<br/><h2>The Top Five Basketball Players In Indiana</h2><br/><br/>

<table width="85%">
	<tr bgcolor="#cccccc">
		<th>Rank</th>
		<th>Grad Year</th>
		<th>Number</th>
		<th>Name</th>
		<th>School</th>
		<th>Games Played</th>
		<th>Total Points</th>
		<th>Scoring Average</th>
	</tr>
<?php
	$count = 0;
	foreach($players as $player)
	{
		$playerID = $player['playerID'];
		$rank = $player['rank'];
		$grYear = $player['gradYear'];
		$jerseyNumber = $player['jerseyNumber'];
		$playerName = $player['name'];
		$school = $player['school'];
		$gamesPlayed = $player['gamesPlayed'];
		$totalPoints = $player['totalPoints'];

		
?>
		
	<tr>
		<td align="center"><?php echo $rank;?></td>
		<td align="center"><?php echo $grYear;?></td>
		<td align="center"><?php echo $jerseyNumber;?></td>
		<td align="center"><a href="/highfive/games?playerID=<?php echo $playerID;?>&name=<?php echo $playerName;?>&school=<?php echo $school;?>"><?php echo $playerName;?></a></td>
		<td align="center"><?php echo $school;?></td>
		<td align="center"><?php echo $gamesPlayed;?></td>
		<td align="center"><?php echo $totalPoints;?></td>
		<td align="center"><?php echo number_format(intval($totalPoints)/intval($gamesPlayed),1);?></td>
	</tr>
	
<?php
		
	}
?>
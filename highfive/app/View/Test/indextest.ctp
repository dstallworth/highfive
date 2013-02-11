<?php 
//include 'jpgraph/jpgraph.php';
//include 'jpgraph/jpgraph_line.php';

?>

<h1><a href="/highfive/" style="text-decoration: none"> High Five - TEST </a></h1>

<br/><h2>Player Statistics</h2>
<h3>NAME - <?php echo $pName;?> (<?php echo $schoolName;?>)</h3>

<table width="90%">
	<tr bgcolor="#cccccc">
		<th>Date</th>
		<th>Opponent</th>
		<th>Game Results</th>
		<th>Points Scored</th>
		<th>Team Score</th>
	</tr>
		
<?php
	$pointsPlayerScored[] = array();
	$pointsTeamScored[] = array();
	$gameList[] = array();
	
	foreach($stats as $stat)
	{
?>
	<tr>
		<td align="center"><?php echo $stat['gameDate'];?></td>
		<td align="center"><?php echo $stat['opponent'];?></td>
		<td align="center"><?php echo $stat['gameResults'];?></td>
		<td align="center"><?php echo $stat['points'];?></td>
		<td align="center"><?php echo $stat['teamPoints'];?></td>
	</tr>
		
<?php
		$pointsPlayerScored[] = $stat['points'];
		$pointsTeamScored[] = $stat['teamPoints']; 		
		$gameList[] = $stat['opponent'];
	}
	
	
?>
</table>


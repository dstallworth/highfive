<?php
include('simple_html_dom.php');

class PlayersController extends AppController {
	
	public function indexplayers() {
		$this->layout = null;
		$players = $this->getVarveeData();
		
		$this->set('players',$players);
	}
	
	
	public function getVarveeData() {
	
		$dataArray = array();
	
		//$html = file_get_html("http://www.varvee.com/team/individual_leaderboard/54/27/"); //NOT SORTED BY SCORING AVERAGE
		$html = file_get_html("http://www.varvee.com/team/individual_leaderboard/54/27/sort:PointsPerGame/direction:desc/activeTable:7ddcf6228db4ee2edfe138c2b283968d/page:1/sortGP:15/flag:1#7ddcf6228db4ee2edfe138c2b283968d");
		$table = $html->find(".table-body",0);
	
		$rows = $html->find(".table-body",0)->find("tr");
		foreach ($rows as $row)
		{
			//echo $row;
			$rowClass = $row->class;
			if (($rowClass == "odd") || ($rowClass == "even"))
			{
				$rank = $row->find("td",0)->plaintext;
				$grYear = $row->find("td",1)->plaintext;
				$number = $row->find("td",2)->plaintext;
				$name = $row->find("td a",0);
				$href = $name->href;
				$school = $row->find("td",4)->plaintext;
				$gamesPlayed = $row->find("td",5)->plaintext;
				$totalPoints = $row->find("td",6)->plaintext;
				$ID = str_replace("/team/player/27/","",$href);
				//echo "#".$rank."&nbsp;&nbsp;&nbsp;".$grYear."&nbsp;&nbsp;".$number."&nbsp;&nbsp;".$name." (ID = ".$ID.") ".$school."&nbsp;&nbsp;".$gamesPlayed."&nbsp;&nbsp;".$totalPoints."<br/>";
				$dataArray[] = array('playerID'=>$ID, 'rank'=>$rank, 'gradYear'=>$grYear, 'jerseyNumber'=>$number, 'name'=>$name->plaintext, 'school'=>$school, 'gamesPlayed'=>$gamesPlayed, 'totalPoints'=>$totalPoints);
			}
		}
	
		return $dataArray;
	}
}

?>
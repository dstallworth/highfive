<?php
include('simple_html_dom.php');


class TestController extends AppController {

	public function indextest() {
		$this->layout = null;
		//$args = $this->passedArgs;
		$playerID = $this->request->query("playerID");
		$playerName = $this->request->query("name");
		$school = $this->request->query("school");
		
		if (!isset($playerID))
		{
			$playerID = "55019";
			//$this->redirect("/badplayer");
		}
		$stats = $this->getVarveeGameData($playerID);
		
		$this->set('stats',$stats);
		$this->set('pName',$playerName);
		$this->set('pID',$playerID);
		$this->set('schoolName',$school);
	}
	
	private function findTeamPoints($value)
	{
		$winLoss = ltrim($value)[0];
		$score = substr($value,1,strlen($value));
		$gamePoints = explode("-",$score);
		$points1 = $gamePoints[0];
		$points2 = $gamePoints[1];
		$points1Int = intval($points1);
		$points2Int = intval($points2);
		$losingScore = 0;
		$winningScore = 0;
	
	
		if ($points1Int > $points2Int)
		{
			$losingScore = $points2Int;
			$winningScore = $points1Int;
		} else {
			$losingScore = $points1Int;
			$winningScore = $points2Int;
		}
	
		if (strtolower($winLoss) == "w")
		{
			return $winningScore;
		} else {
			return $losingScore;
		}
	
	}
	
	
	public function getVarveeGameData($playerID) {
	
		$dataArray = array();
	
		
		$html = file_get_html("http://www.varvee.com/team/player/27/".$playerID);
		//$html = file_get_html("http://www.varvee.com/team/player/27/56002");
		$table = $html->find(".table-body",0);
		
		$rows = $html->find(".table-body",0)->find("tr");
		foreach ($rows as $row)
		{
			//echo $row;
			$rowClass = $row->class;
			if (($rowClass == "odd") || ($rowClass == "even"))
			{
				$gameDate = $row->find("td",0)->plaintext;
				$opponent = $row->find("td",1)->plaintext;
				$gameResults = $row->find("td",2)->plaintext;
				$teamPoints = $this->findTeamPoints($gameResults);
				$points = $row->find("td",3)->plaintext;
		
				$dataArray[] = array('gameDate'=>$gameDate, 'opponent'=>$opponent, 'gameResults'=>$gameResults, 'points'=>$points, 'teamPoints'=>$teamPoints);
			}
		}
						
		
		
			
		return $dataArray;
	}
	
	
}
?>
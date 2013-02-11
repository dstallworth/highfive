<?php	
include 'jpgraph/jpgraph.php';
include 'jpgraph/jpgraph_line.php';
include('simple_html_dom.php');

$gameList = array();
$pointsPlayerScored = array();

function findTeamPoints($value)
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


function getVarveeGameData($playerID) {

	//$dataArray = array();


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
			$teamPoints = findTeamPoints($gameResults);
			$points = $row->find("td",3)->plaintext;

			$dataArray[] = array('gameDate'=>$gameDate, 'opponent'=>$opponent, 'gameResults'=>$gameResults, 'points'=>$points, 'teamPoints'=>$teamPoints);
			
		}
	}




	return $dataArray;
}

$playerID = $_GET['playerID'];
$pName = $_GET['pName'];
$schoolName = $_GET['school'];

$dataArray = getVarveeGameData($playerID);

foreach ($dataArray as $dataElement)
{
	$gameList[] = $dataElement['opponent'];
	$pointsPlayerScored[] = $dataElement['points'];
	$pointsTeamScored[] = $dataElement['teamPoints'];
	
}

$graph = new Graph(900,950);
$graph->SetScale('textint');
$theme_class=new UniversalTheme;

$graph->SetTheme($theme_class);
//$graph->img->SetAntiAliasing(false);
$graph->SetBox(false);
$graph->img->SetAntiAliasing();

$graph->yaxis->HideZeroLabel();
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

$graph->xgrid->Show();
$graph->xgrid->SetLineStyle("solid");

$graph->title->Set($pName);
$graph->title->SetFont(FF_ARIAL,FS_BOLD,18);
//$graph->title->Set("Sport");
$graph->subtitle->Set($schoolName);
$graph->subtitle->SetFont(FF_ARIAL,FS_NORMAL,14);
$graph->yaxis->SetTitle("points", "middle");
$graph->xaxis->SetTitle("", "middle");
$graph->xaxis->SetTickLabels($gameList);
$graph->xaxis->SetLabelAngle(75);

$graph->legend->SetPos(0.5,0.1,'center','top');

$plot = new LinePlot($pointsPlayerScored);
$plot->SetColor("red");
$plot->SetLegend("Player Points");
$graph->Add($plot);

$plot2 = new LinePlot($pointsTeamScored);
$plot2->SetColor("blue");
$plot2->SetLegend("Team Points");
$graph->Add($plot2);




$graph->Stroke();




	
?>
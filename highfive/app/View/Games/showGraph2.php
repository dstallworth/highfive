<?php	
include 'jpgraph/jpgraph.php';
include 'jpgraph/jpgraph_line.php';

$pName = "Name";
$schoolName = "Name of School";

$gameList = array("Game1", "Game2", "Game3", "Game4", "Game5");
$pointsPlayerScored = array(23, 30, 28, 34, 20);

$graph = new Graph(900,500);
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

$plot = new LinePlot($pointsPlayerScored);
$graph->Add($plot);

//$plot2 = new LinePlot($pointsTeamScored);
//$graph->Add($plot2);


$plot->SetColor("red");
$graph->Stroke();


	
?>
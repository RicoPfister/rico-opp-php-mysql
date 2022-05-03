<?php

// Berechnung der Diagrammaufteilung für Gesamtanzahl

$_diagramProportionMistakes = 280/($_maxMistakes+$_maxPoints)*$_maxMistakes+30;

// Berechnung der Diagrammaufteilung für erreichtes Ergebnis

$_diagramPositionMistakes = 280/($_maxMistakes+$_maxPoints)*$_maxMistakes/$_maxMistakes*$mistakes+30;

if ($_maxPoints != 0){
$_PositionPoints = 280/($_maxMistakes+$_maxPoints)*$_maxPoints/$_maxPoints*$points;
} else {
    $_PositionPoints = 0;
}

$_diagramPositionPoints = $_diagramProportionMistakes+$_PositionPoints;

/*
echo "<pre>";
echo $_maxMistakes;
echo $_maxPoints;
echo $_diagramProportionMistakes;
echo $_diagramProportionPoints;
echo "</pre>";
*/

// Grafische Darstellung der Evaluationsdaten

echo "
<svg width='350' height='35'>
    <line x1='30' y1='10' x2='$_diagramProportionMistakes' y2='10' style='stroke:rgb(180,0,0);stroke-width:3'/>
    // <line x1='$_diagramProportionMistakes' y1='10' x2='310' y2='10' style='stroke:rgb(0,180,0);stroke-width:3'/>";

    for($i=1; $i<=30; $i++){
        $x = 20+$i*10;
        echo "<line x1=$x y1='6' x2=$x y2='14' style='stroke:rgb(100,100,100);stroke-width:1'/>";
    }

echo "    
   	<line x1='$_diagramPositionMistakes' y1='0' x2='$_diagramPositionMistakes' y2='20' style='stroke:rgb(0,0,0);stroke-width:3'/>
    <line x1='$_diagramPositionPoints' y1='0' x2='$_diagramPositionPoints' y2='20' style='stroke:rgb(0,0,0);stroke-width:3'/>
    
    <text x='5' y='15' fill='rgb(0,180,0)'>&#10006;</text>
    <text x='315' y='15' fill=rgb(180,0,0)>&#10004;</text>
</svg>";

// echo $_diagramPositionMistakes;

?>
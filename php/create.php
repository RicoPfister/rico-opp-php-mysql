<?php

session_start();

include 'databaseConnection.php';

$question = $_POST["q"];

// create question database entry
$sql = "INSERT INTO Questions (`QID`, `AType`, `QuestionDE`) VALUES (NULL, 'Radio', '$question')";

$statement = $DBAccess->prepare($sql);
$statement->execute();

$query2 = $DBAccess->query("SELECT QID FROM Questions ORDER BY QID DESC LIMIT 1");
$lastQID = $query2->fetch(PDO::FETCH_ASSOC)["QID"];

// get POST data and save it in variables
$question = $_POST["q"];

// create answers database entries
for($i = 1; $i < 5; $i++){

    if($_POST["a".$i."t"] != ""){ // check if answer was given

    ${"answer".$i."Text"} = $_POST["a".$i."t"];  

    if(isset($_POST["a".$i."c"])) ${"answer".$i."Correct"} = $_POST["a".$i."c"]; else ${"answer".$i."Correct"} = 0;

    ${"sql".$i} = "INSERT INTO `Answers` (`AID`, `AnswerDE`, `Image`, `CorrectAnswer`, `QID`, `AIndex`) VALUES (NULL, '${"answer".$i."Text"}', '0', '${"answer".$i."Correct"}', $lastQID, $i)";
    ${"statement".$i} = $DBAccess->prepare(${"sql".$i}); 
    ${"statement".$i}->execute();
    }     
}

// write into database

//go back to index
header("Location: /index.php");
exit();

















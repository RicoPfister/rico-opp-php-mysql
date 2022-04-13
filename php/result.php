<?php

session_start();

$dbHost = getenv('DB_HOST');
$dbName= getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');

$DBAccess = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPassword);

$DBQID = $DBAccess->query("SELECT QID FROM Questions");
$DBQuestion = $DBAccess->query("SELECT Question FROM Questions");

include 'randomizer.php';

/*
print_r($quizQuestionsOrder);
echo "$currentQID";
*/

$DBQuestionAnswer = $DBAccess->query("SELECT * FROM Questions, Answers WHERE Questions.QID = $currentQID AND Questions.QID = Answers.QID");

$a1 = $DBQuestionAnswer->fetch(PDO::FETCH_ASSOC);
$a2 = $DBQuestionAnswer->fetch(PDO::FETCH_ASSOC);
$a3 = $DBQuestionAnswer->fetch(PDO::FETCH_ASSOC);
$a4 = $DBQuestionAnswer->fetch(PDO::FETCH_ASSOC);

/*
echo "<pre>";
print_r($question[0]["Question"]);
echo "</pre>";
*/

/*
echo "<pre>";
print_r($question);
echo "</pre>";
*/

$_SESSION["CID"] = $currentQID;
$_SESSION["q"] = $a1["Question"];
$_SESSION["a1"] = $a1["Answer"];
$_SESSION["a2"] = $a2["Answer"];
$_SESSION["a3"] = $a3["Answer"];
$_SESSION["a4"] = $a4["Answer"];


header("Location: /index.php");
exit;











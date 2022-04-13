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

$currentQID = current($quizQuestionsOrder);

print_r($quizQuestionsOrder);
echo "$currentQID";

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

$_SESSION = ["id" => $currentQID, "q" => $a1["Question"], "a1" => $a1["Answer"], "a2" => $a2["Answer"], "a3" => $a3["Answer"], "a4" => $a4["Answer"]];

print_r($_SESSION);

$_POST = [];
exit;
header("Location: /index.php");







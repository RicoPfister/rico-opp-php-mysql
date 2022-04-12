<?php

session_start();

$dbHost = getenv('DB_HOST');
$dbName= getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');

$DBAccess = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPassword);

$currentQID = 3;

$DBQuestion = $DBAccess->query("SELECT * FROM Questions, Answers WHERE Questions.QID = $currentQID AND Questions.QID = Answers.QID");

$question = $DBQuestion->fetchALL(PDO::FETCH_ASSOC);

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

/*
echo "<pre>";
print_r($question2);
echo "</pre>";
*/


$_SESSION = $question[$currentQID]["Question"];

$_POST = [];

header("Location: /index.php");
exit;






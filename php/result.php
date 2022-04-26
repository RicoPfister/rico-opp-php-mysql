<?php

session_start();

include 'databaseConnection.php';

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

if (isset($_POST["q1"])) {
    $_SESSION["userdata"]["UQ".$currentQID]["UA".$a1["QID"]."-1"] = $_POST["q1"];
}

if (isset($_POST["q2"])) {
    $_SESSION["userdata"]["UQ".$currentQID]["UA".$a2["QID"]."-2"] = $_POST["q2"];
}

if (isset($_POST["q3"])) {
    $_SESSION["userdata"]["UQ".$currentQID]["UA".$a3["QID"]."-3"] = $_POST["q3"];
}

if (isset($_POST["q4"])) {
    $_SESSION["userdata"]["UQ".$currentQID]["UA".$a4["QID"]."-4"] = $_POST["q4"];
}

header("Location: /index.php");
exit;














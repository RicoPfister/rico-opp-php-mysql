<?php

session_start();

include 'databaseConnection.php';

$DBQID = $DBAccess->query("SELECT QID FROM Questions"); // get QID from database
$DBQuestion = $DBAccess->query("SELECT QuestionDE FROM Questions"); // get question title from database

include 'randomizer.php';

/*
print_r($quizQuestionsOrder);
echo "$currentQID";
*/

$DBQuestionAnswer = $DBAccess->query("SELECT * FROM Questions, Answers WHERE Questions.QID = $currentQID AND Questions.QID = Answers.QID");
$allQuestionData = $DBQuestionAnswer->fetchALL(PDO::FETCH_ASSOC);

$_SESSION["CID"] = $currentQID; 
$_SESSION["q"] = $allQuestionData[0]["QuestionDE"]; // set current question title to session array

// write from database to session array

for($i=0; $i<4; $i++){

    if (isset($allQuestionData[$i])) $_SESSION["a".$i+1] = $allQuestionData[$i]['AnswerDE'];
    
}

/*
echo "<pre>";
print_r($allQuestionData);
echo "</pre>";
*/

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

/*echo $currentQID;
print_r($_SESSION);*/

// fill in current question/answers

// write previous question and user answers to the session array
if (isset($_POST["qr"])) { // set radio answer to session array UA array
    $_SESSION["userdata"]["UQ".$_SESSION['PID']]["UA".$_SESSION['PID']."-".$_POST["qr"]] = 1;    
}

if (isset($_POST["q1"])) { // set 1st check box answer to session array UA array
    $_SESSION["userdata"]["UQ".$_SESSION['PID']]["UA".$_SESSION['PID']."-1"] = 1;
    
}

if (isset($_POST["q2"])) { // set 2nd check box answer to session array UA array
    $_SESSION["userdata"]["UQ".$_SESSION['PID']]["UA".$_SESSION['PID']."-2"] = 1;
    
}

if (isset($_POST["q3"])) { // set 3rd check box answer to session array UA array
    $_SESSION["userdata"]["UQ".$_SESSION['PID']]["UA".$_SESSION['PID']."-3"] = 1;
    
}

if (isset($_POST["q4"])) { // set 4th check box answer to session array UA array
    $_SESSION["userdata"]["UQ".$_SESSION['PID']]["UA".$$_SESSION['PID']."-4"] = 1;
   
}

if (isset($_SESSION['QOrder'])){ // check if a quiz has already been startet

    if ($_SESSION['QOrder'] == null){ // if no question numbers are left go to the evaluation page            
        header("Location: /php/evaluation.php");
        exit();
    }   

}

header("Location: /index.php");
exit();

















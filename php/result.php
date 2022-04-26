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

$a1 = $DBQuestionAnswer->fetch(PDO::FETCH_ASSOC); // get 1st database question related data
$a2 = $DBQuestionAnswer->fetch(PDO::FETCH_ASSOC); // get 2nd database question related data
$a3 = $DBQuestionAnswer->fetch(PDO::FETCH_ASSOC); // get 3rd database question related data
$a4 = $DBQuestionAnswer->fetch(PDO::FETCH_ASSOC); // get 4th database question related data

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
$_SESSION["CID"] = $currentQID; // set current QID to session array
$_SESSION["q"] = $a1["QuestionDE"]; // set current question title to session array
$_SESSION["a1"] = $a1["AnswerDE"]; // set 1st database question related data to session array
$_SESSION["a2"] = $a2["AnswerDE"]; // set 2nd database question related data to session array
$_SESSION["a3"] = $a3["AnswerDE"]; // set 3rd database question related data to session array
$_SESSION["a4"] = $a4["AnswerDE"]; // set 4th database question related data to session array

// fill in previous answers
if (isset($_POST["qr"])) { // set radio answer to session array UA array
    $_SESSION["userdata"]["UQ".$previousQID]["UA".$previousQID."-".$_POST["qr"]] = 1;    
}

if (isset($_POST["q1"])) { // set 1st check box answer to session array UA array
    $_SESSION["userdata"]["UQ".$previousQID]["UA".$previousQID."-1"] = 1;
    
}

if (isset($_POST["q2"])) { // set 2nd check box answer to session array UA array
    $_SESSION["userdata"]["UQ".$previousQID]["UA".$previousQID."-2"] = 1;
    
}

if (isset($_POST["q3"])) { // set 3rd check box answer to session array UA array
    $_SESSION["userdata"]["UQ".$previousQID]["UA".$previousQID."-3"] = 1;
    
}

if (isset($_POST["q4"])) { // set 4th check box answer to session array UA array
    $_SESSION["userdata"]["UQ".$previousQID]["UA".$previousQID."-4"] = 1;
   
}

elseif (isset($_SESSION['QOrder'])){ // check if a quiz has already been startet

    if ($_SESSION['QOrder'] == null){ // if no question numbers are left go to the evaluation page            
        header("Location: /php/evaluation.php");
        exit();
    }

    else{ // if a quiz is running go to to next question number in der qorder array and remove the last element from the array
        $previousQID = end($_SESSION['QOrder']);          
        array_pop($_SESSION['QOrder']);  
        $currentQID  = end($_SESSION['QOrder']);                                 
    }        

}

header("Location: /index.php");
exit;















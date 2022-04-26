<?php

// randomize quiz questions

// count questions, generate random quiz questions order and save it in an array

$QID = $DBQID->fetchALL(PDO::FETCH_ASSOC); // get all questions IDs

$quizQuestionsOrder = [];

if (isset($_POST["newQuiz"])) {

    if (isset($_POST["aq"]) && ($_POST["aq"]) != "") $amountOfQuestions = $_POST["aq"]; else $amountOfQuestions = 5; // set number of questions for next quiz
   
    $_SESSION = []; // clear session array

    for ($i=1; $i<=$amountOfQuestions; $i++){ // loop for each number of questions

        $questionsCount = count($QID); // sum of all remaining question numbers from $QID
        $randomQuestionNumber = rand(0, $questionsCount-1); // random number between 0 and total question number - 1
        array_push($quizQuestionsOrder, $QID[$randomQuestionNumber]["QID"]); // add random number to question randomizer array    
        unset($QID[$randomQuestionNumber]); // remove used random number from $QID array
        $QID = array_values($QID); // get all remaining numbers from $QID
    }

    $_SESSION["QOrder"] = $quizQuestionsOrder; // fill session array qorder array with randomized quiz numbers
    $currentQID  = end($_SESSION['QOrder']); // set QID the end number of session qorder array
}

    elseif (isset($_SESSION['CID'])){ // check if a quiz has already been startet

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



?>
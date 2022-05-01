<?php

// randomize quiz questions

// count questions, generate random quiz questions order and save it in an array

$QID = $DBQID->fetchALL(PDO::FETCH_ASSOC); // get all questions IDs

$quizQuestionsOrder = [];
$_maxPoints = 0;
$_maxMistakes = 0;

if(isset($_POST['newQuiz'])){
    $_SESSION['newQuiz'] = 1;
}

if (isset($_POST['addQuestion'])){
    header("Location: add.php");
    exit;
}

if (isset($_SESSION["newQuiz"])) {

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
    $currentQID  = $_SESSION['QOrder'][0]; // set QID the end number of session qorder array

    // count maximal points
    foreach($quizQuestionsOrder as $questionOrder => $questionNumber){
        
        $DBQuestionAnswer = $DBAccess->query("SELECT CorrectAnswer FROM Questions, Answers WHERE Questions.QID = $questionNumber AND Questions.QID = Answers.QID");
        $answerNumber = $DBQuestionAnswer->fetchALL(PDO::FETCH_ASSOC); // gather all question/answer data

        foreach($answerNumber as $answer => $correctAnswer){
            if($correctAnswer['CorrectAnswer'] == 1) $_maxPoints += 1; else $_maxMistakes += 1;
        }
    }

    $_SESSION['MaxPoints'] = $_maxPoints;
    $_SESSION['MaxMistakes'] = $_maxMistakes;
    $_SESSION['aq'] = $amountOfQuestions;
    $_SESSION['CQI'] = 0; // set current question index
    
    $DBCorrectAnswers = $DBAccess->query("SELECT CorrectAnswer FROM Answers WHERE CorrectAnswer = 1"); // total possible points
    $CorrectAnswers = $DBCorrectAnswers->fetchALL(PDO::FETCH_ASSOC);
    $_SESSION["NumCorAns"] = count($CorrectAnswers);

    unset($_SESSION['newQuiz']);
}

    elseif (isset($_POST["sent"]) || isset($_POST["q2"]) || isset($_POST["q3"]) || isset($_POST["q4"]) || isset($_POST["back"])){ // if a quiz is running go to to next question number in der qorder array and remove the last element from the array

            $_SESSION['PID'] = $_SESSION["QOrder"][$_SESSION['CQI']];
            
            if ($_SESSION['CQI'] != 0) {

                if (isset($_POST['back'])) {
          
                        $_SESSION['CQI']--;
                } else $_SESSION['CQI']++;        
                
            } else $_SESSION['CQI']++;

            //print_r($_SESSION);

            if ($_SESSION['CQI'] == $_SESSION['aq']) $currentQID  = $_SESSION['PID']; else $currentQID  = $_SESSION['QOrder'][$_SESSION['CQI']];                               

    }

?>
<?php

// randomize quiz questions

// count questions, generate random quiz questions order and save it in an array

$QID = $DBQID->fetchALL(PDO::FETCH_ASSOC);

$quizQuestionsOrder = [];

if (isset($_POST["newQuiz"])) {

    for ($i=1; $i<=9; $i++){

        $questionsCount = count($QID);
        $randomQuestionNumber = rand(0, $questionsCount-1);
        array_push($quizQuestionsOrder, $QID[$randomQuestionNumber]["QID"]);    
        unset($QID[$randomQuestionNumber]);
        $QID = array_values($QID);   
    }

    $_SESSION["QOrder"] = $quizQuestionsOrder;        
    $currentQID = $quizQuestionsOrder[0];
}

    elseif (isset($_SESSION['CID'])){

        if ($_SESSION['QOrder'] == null){            
            header("Location: /evaluation.php");
            exit();
        }

        else{
            $currentQID  = end($_SESSION['QOrder']);
            array_pop($_SESSION['QOrder']);
        }

    }



?>
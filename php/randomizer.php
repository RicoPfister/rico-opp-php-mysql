<?php

// randomize quiz questions

// count questions, generate random quiz questions order and save it in an array

$QID = $DBQID->fetchALL(PDO::FETCH_ASSOC);

$quizQuestionsOrder = [];

if (isset($_POST["newQuiz"])) {

    for ($i=1; $i<=10; $i++){

        $questionsCount = count($QID);
        $randomQuestionNumber = rand(0, $questionsCount-1);
        array_push($quizQuestionsOrder, $randomQuestionNumber+1);    
        unset($QID[$randomQuestionNumber]);
        $QID = array_values($QID);
    }
}




?>
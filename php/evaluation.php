<?php session_start();

include 'databaseConnection.php';

$evaluationText = 
["Extraordinary! You haven't made any mistakes.",
"Congratulation! You made almost no mistakes.",
"Great! But you made some mistakes. Maybe you do the quiz again?",
"Unfortunately you made many mistakes. Please try again."
];

$points = 0;
$mistakes = 0;

$_maxPoints = $_SESSION['MaxPoints'];
$_maxMistakes = $_SESSION['MaxMistakes']+$_maxPoints;

/*
echo "<pre>";
print_r($_SESSION["userdata"]);
echo "</pre>";
*/

include 'header.php';
include 'dev-console.php';

?>

<div class="container">
    <div class="row">
        <div class="col-sm"></div> <!-- start invisible col -->

        <div class="col-xl-6 max-vh-100  mb-5 quizContainer"> <!-- quiz container -->
        <form action="/php/result.php" method="POST" onsubmit="return evaluateNewQuizLimit()">
            <div class="row m-0"> <!-- quiz header block -->    
               
                <div class="col colHeader d-sm-flex m-0 p-0">

                    <div class="col-auto d-flex align-items-center m-0 p-0">
                        <h4 class="m-0 p-0">Quiz Generator</h4> <!-- title text -->
                    </div>
                    
                    <div class="col d-flex justify-content-end"> <!-- header whole button box -->
                    
                        <div class="col-auto d-flex justify-content-end"> <!-- header new quiz box-->
                            <input type="number" class="amountQuestions form-control me-2 border-dark" name="aq" id="userNewQuiz" value="<?=$_SESSION['aq']?>"> 
                            <button type="submit" class="btn btn-dark me-2" name="newQuiz" value="1"><div class="d-none d-sm-block">New Question(s)</div><div class="d-block d-sm-none">N</div></button> <!-- button new quiz - change text if smaller/bigger than sm-->
                        </div>

                        <div class="col-auto d-flex justify-content-end"> <!-- header add quiz box -->
                            <button type="submit" class="btn btn-dark me-2 editButtons" name="addQuestion" value="1">+</button> <!-- button create quiz -->
                            <button type="submit" class="btn btn-dark editButtons" name="changeQuestion" value="1">c</button> <!-- button remove quiz -->
                        </div>
                    </div>
                    </form>
        
                </div>                                  
            </div>
            
            <div class="row questionBoxEvaluation mx-0 mt-2"> <!-- quiz question block -->

            <form action="/php/result.php" onsubmit="return evaluateAnswer()" method="POST">
            
                <div class="col">
              
                    <div class="mt-3 mb-0 ms-3 pb-0 mx-4">
        
                        <h4 class="p-0 m-0">Evaluation</h4>
                        <p class="my-2 pb-1">You have finished the quiz. Here is the detailed result and the final score:</p>
                    </div>
                    
                </div>
            </div>

            <div class="row mx-0 mt-0 mb-0"> <!-- quiz answer/footer block -->                

                <div class="row answerBox mt-2 mx-0"> <!-- quiz answer block --> 
                    <div class="col-sm-lg mt-3 mb-1">
                                        
                        <?php

                            foreach($_SESSION["userdata"] as $userQuestion => $userAnswer) { // show question overview array

                                $userTotalCorrectAnswers = 0;
                                $questionTotalCorrectAnswers = 0;
                                $userTotalWrongAnswers = 0;

                                $UQID = substr($userQuestion, 2); // trimmed user question number
                                $DBQuestionAnswer = $DBAccess->query("SELECT * FROM Questions, Answers WHERE Questions.QID = Answers.QID AND Questions.QID = $UQID"); // select question number array
                                $answerNumber = $DBQuestionAnswer->fetchALL(PDO::FETCH_ASSOC); // gather all question/answer data

                                /*
                                echo "<pre>";
                                print_r($answerNumber);
                                echo "</pre>";
                                */

                                echo "<h6 class='mb-3 fw-bold'>Frage $UQID: ".$answerNumber[0]['QuestionDE']."<h6>";
                                
                                for($i=1; $i<5; $i++){

                                    ${"dingbat".$i} = "";

                                    if (isset($_SESSION["userdata"][$userQuestion]["UA".$UQID."-$i"])){ // check if the answer 1-4 is set by user            
                                                
                                        if ($answerNumber[$i-1]["CorrectAnswer"] == 1) { // check if the user answer is correct. if yes = green
                                            ${"answer".$i."Color"} = "bg-success";
                                            $userTotalCorrectAnswers += 1;
                                            $points+=1; 

                                        } else {                
                                            ${"answer".$i."Color"} = "bg-danger"; // check if users answer are correct. if no = red
                                            ${"dingbat".$i} = '&#10006;';
                                            $userTotalWrongAnswers += 1;
                                            $mistakes+=1;
                                        }
                                        
                                        if ($answerNumber[$i-1]["CorrectAnswer"] == 1) {

                                            ${'answer'.$i.'IsCorrect'} = "border border-3 border-success";
                                            ${"dingbat".$i} = '&#10004;';
                                            $questionTotalCorrectAnswers += 1;
                                            
                                        } else ${'answer'.$i.'IsCorrect'} = ""; // check if the user answer is correct. set font weight
                                        echo "<div class='my-2'><span class='my-3 ${'answer'.$i.'Color'} ${'answer'.$i.'IsCorrect'}'>".$answerNumber[$i-1]['AnswerDE']."</span> ${"dingbat".$i}</div>";
                                    }

                                    elseif (isset($answerNumber[$i-1])) {
                                        
                                        ${"answer".$i."Color"} = ""; // when the answer 1-4 was not set
                                        if ($answerNumber[$i-1]["CorrectAnswer"] == 1) {
                                            ${'answer'.$i.'IsCorrect'} = "border border-3 border-success";
                                            ${"dingbat".$i} = '&#10006;';
                                            $questionTotalCorrectAnswers += 1;
                                            $userTotalWrongAnswers += 1;
                                            $mistakes+=1;

                                        } else ${'answer'.$i.'IsCorrect'} = ""; // check if the user answer is correct. set font weight
                                        echo "<div class='my-2'><span class='my-3 ${'answer'.$i.'Color'} ${'answer'.$i.'IsCorrect'}'>".$answerNumber[$i-1]['AnswerDE']."</span> ${"dingbat".$i}</div>";
                                    }     
                                
                                } 

                                echo "<hr>";
                            }

                            $evalationFormula = -1/$_maxMistakes*$mistakes+1*100 + 1/$_maxPoints*$points*100;
                            
                            if ($evalationFormula == 200) $evaluationTextIndex = 0;
                            elseif ($evalationFormula >= 180) $evaluationTextIndex = 1;
                            elseif ($evalationFormula >= 160) $evaluationTextIndex = 2;
                            else $evaluationTextIndex = 3;                            
                            
                            ?>

                        <p class="mt-0 mb-0 pb-1"><?=$points?> correct answers out of a maximum of <?=$_maxPoints?>.</p>
                        <p><?=$mistakes?> wrong answers out of a maximum of <?=$_maxMistakes?>.</p>

                        <?php include 'evaluation-diagram.php'?>

                        <p class="mt-0 mb-3 pb-1">The further apart both indicators are, the better the result.</P>

                        <p class="mt-0 mb-0 pb-1"><?=$evaluationText[$evaluationTextIndex]?></p>

                    </div>

                </div>
            </div>      

            </div>
            <div class="col-sm"></div> <!-- end invisible col -->
    </div>
</div>
    
<?php include 'footer.php';?>



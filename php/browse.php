<?php
session_start();
/* print_r($_SESSION); */

include 'header.php';
include 'dev-console.php';
include 'databaseConnection.php';

$DBAll = $DBAccess->query("SELECT * FROM Questions, Answers WHERE Questions.QID = Answers.QID"); // get all data from database
$DBTotalQuestions = $DBAccess->query("SELECT QID FROM Questions"); // get all QID from database

?>

<div class="container">
    <div class="row">
        <div class="col"></div> <!-- start invisible col -->

        <div class="col-xl-7 max-vh-100  mb-5 quizContainer"> <!-- quiz container -->
        <form action="/php/result.php" onsubmit="return evaluateNewQuizLimit()" method="POST">
            <div class="row m-0"> <!-- quiz header block -->    
               
                <div class="col colHeader d-sm-flex m-0 p-0">

                    <div class="col-auto d-flex align-items-center m-0 p-0">
                        <h4 class="m-0 p-0">Quiz Generator</h4> <!-- title text -->
                    </div>
                    
                    <div class="col d-flex justify-content-end"> <!-- header whole button box -->
                    
                        <div class="col-auto d-flex justify-content-end"> <!-- header new quiz box-->
                            <input type="number" class="amountQuestions form-control me-2 border-dark" id="userNewQuiz" name="aq" value="<?=$_SESSION['aq']?>"> 
                            <button type="submit" class="btn btn-dark d-none d-sm-block me-2" name="newQuiz" value="1">New Question(s)</button> <!-- button new quiz - show if bigger than sm-->
                            <button type="submit" class="btn btn-dark me-2 d-block d-sm-none" name="newQuiz" value="1">New</button> <!-- button new quiz - show if smaller than sm-->
                        </div>

                        <div class="col-auto d-flex justify-content-end"> <!-- header add quiz box -->
                            <button type="submit" class="btn btn-dark me-2 editButtons" name="addQuestion" value="1">+</button> <!-- button create quiz -->
                            <button type="submit" class="btn btn-dark editButtons" name="changeQuestion" value="1">c</button> <!-- button remove quiz -->
                        </div>
                    </div>
                    </form>
        
                </div>                                  
            </div>   

             <div class="row mx-0 mt-"> <!-- quiz answer/footer block -->                

                    <div class="row answerBox mt-2 mx-0"> <!-- quiz answer block --> 
                        <div class="col-sm">
                            
                            <div class="mt-3"></div>
                                
                                <?php

                                $TNQ = $DBTotalQuestions->fetchALL(PDO::FETCH_ASSOC); // total number of questions

                                for ($a=0; $a<count($TNQ); $a++) { // separate questions

                                    $currentQID = $TNQ[$a]['QID'];

                                    $DBCurrentQuestionData = $DBAccess->query("SELECT * FROM Questions, Answers WHERE Questions.QID = $currentQID AND Questions.QID = Answers.QID"); // get all data from database

                                    $CurrentQuestionData = $DBCurrentQuestionData->fetchALL(PDO::FETCH_ASSOC); // get current question/answers data
                                    
                                    /*
                                    echo "<pre>";
                                    print_r($CurrentQuestionData);
                                    echo "</pre>";
                                    */

                                    $questionID = $CurrentQuestionData[0]['QID'];
                                    $questionText = $CurrentQuestionData[0]['QuestionDE'];
                                      
                                    for($b=0; $b<4; $b++){

                                        echo "
                                        <form action='/php/change.php' method='POST'>"; // form start

                                        if (isset($CurrentQuestionData[$b])){

                                            ${"answer".$b."Text"} = $CurrentQuestionData[$b]['AnswerDE'];

                                            if($CurrentQuestionData[$b]['CorrectAnswer'] == 1){
                                                ${"answer".$b."Correct"} = 'checked';
                                            } else {${"answer".$b."Correct"} = "";};
                                        } else {${"answer".$b."Text"} = ""; ${"answer".$b."Correct"} = "";}
                                    }   

                                    echo "
                                    <div class='form-check mb-2'>
                                        <label for='qq'><b>Question $questionID:</b></label>
                                        <div class='d-flex align-items-center'>
                                            <textarea class='form-control me-2 mt-2'  maxlength='80' rows='2' id='q' name='q'>$questionText</textarea>
                                            <button type='submit' class='btn btn-danger mt-2'>x</button> <!-- button remove question -->
                                        </div>
                                    </div>";                                

                                    for ($i=0; $i<4; $i++) {

                                        $i_i = $i+1;

                                        echo "
                                        <div class='form-check'>
                                            <div class='d-flex align-items-center'>
                                                <input type='hidden' name='qid' value=$questionID>
                                                <input type='checkbox' class='form-check-input me-2' id='ac$i_i' name='ac$i_i' value='1' ${"answer".$i."Correct"}>
                                                <input type='text' class='form-control me-2' id='at$i_i' name='at$i_i' value='${"answer".$i."Text"}'>
                                                <button type='submit' class='btn btn-dark'>x</button> <!-- button remove answer -->                    
                                            </div>                    
                                        </div>";                                     
                                    }

                                        echo "
                                        <div class='row-1 d-flex justify-content-center'>
                                            <button type='submit' class='btn btn-success mt-2' name='save' value='1'>Save changes</button> <!-- button save changes -->
                                         </div>";

                                    if ($a != count($TNQ)-1){
                                        echo "<div class='mb-0'></div><hr>";
                                    }

                                    echo "</form>";
                                }

                                echo "
                                <p class='mb-0' id='validationMessage'></p>"
                                ?>
                            
                            <div class="m-0"></div>

                        </div>

                    </div>
                </div>               

                    <div class="row mt-2"> <!-- quiz footer block -->   
                        <div class="col d-flex justify-content-center align-items-center">
   
                            <p id="infoBar" class="m-0 p-0">In database: <span id="totalQuestions"><?=$_SESSION['totalQuestions']?></span> questions</p>
     
                        </div>
                    </div>
            </div>
            <div class="col"></div> <!-- end invisible col -->
    </div>

</div>

<?php include 'footer.php';?>
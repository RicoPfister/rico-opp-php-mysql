<?php
session_start();
/* print_r($_SESSION); */

include 'header.php';
include 'dev-console.php';

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

            <form action="/php/create.php" onsubmit="return evaluateAddQuestion()" method="POST">     

            <div class="row mx-0 mt-"> <!-- quiz answer/footer block -->                

                    <div class="row answerBox mt-2 mx-0"> <!-- quiz answer block --> 
                        <div class="col-sm">
                            
                            <div class="mt-4"></div>
                                
                                <?php

                                for ($a=1; $a<5; $a++) { // separate questions

                                    echo "
                                    <div class='form-check'>
                                        <label for='qq'>Question 1:</label>
                                        <div class='d-flex align-items-center'>
                                            <textarea class='form-control me-2'  maxlength='80' rows='2' id='qq' name='q'></textarea>
                                            <button type='submit' class='btn btn-danger'>x</button> <!-- button remove question -->
                                        </div>
                                    </div>";                                

                                    for ($i=1; $i<5; $i++) {

                                        echo "
                                        <div class='form-check'>
                                            <div class='d-flex align-items-center'>
                                                <input type='checkbox' class='form-check-input me-2' id='ac$i' name='a$i.'c'' value='1'>
                                                <input type='text' class='form-control me-2' id='aa$i' name='a1t'>
                                                <button type='submit' class='btn btn-dark'>x</button> <!-- button remove answer -->
                                            </div>
                                        </div>";                                     
                                    }

                                    if ($a != 4){
                                        echo "<div class='mb-4'></div><hr>";
                                    }
                                }

                                echo "
                                <p class='mb-4' id='validationMessage'></p>"
                                ?>
                            
                            <div class="mb-2"></div>

                        </div>

                    </div>
                </div>               

                    <div class="row mt-2"> <!-- quiz footer block -->   
                        <div class="col d-flex justify-content-between align-items-center">
                            <button type="reset" class="btn btn-danger">Reset</button> <!-- button new quiz -->
                            <p id="infoBar" class="m-0 p-0">In database: <span id="totalQuestions"><?=$_SESSION['totalQuestions']?></span> Questions</p>
                            <button type="submit" class="btn btn-success">Save</button> <!-- button create quiz -->    
                        </div>
                    </div>
                </form>

            </div>
            <div class="col"></div> <!-- end invisible col -->
    </div>

</div>

<?php
unset($_SESSION['q']);
unset($_SESSION['a1']);
unset($_SESSION['a2']);
unset($_SESSION['a3']);
unset($_SESSION['a4']);

/*
echo "<pre>";
print_r($_SESSION);
print_r($_POST);
echo "</pre>"
*/

include 'footer.php';
?>
<?php
session_start();
/* print_r($_SESSION); */

include 'header.php';

?>

<div class="container">
    <div class="row">
        <div class="col"></div> <!-- start invisible col -->

        <div class="col-6 quizContainer"> <!-- quiz container -->
        <form action="/php/result.php" method="POST">
            <div class="row m-0"> <!-- quiz header block -->
           
                <div class="col-5 d-flex justify-content-start">
                    <h3>Quiz Generator</h3> <!-- title text -->
                </div>                     
               
                <div class="col d-flex justify-content-end m-0 p-0">
                    
                    <input type="text" class="amountQuestions form-control me-2" name="aq" placeholder=""> 
                    <button type="submit" class="btn btn-dark me-2" name="newQuiz" value="1">New Question(s)</button> <!-- button new quiz -->
                    <button type="submit" class="btn btn-dark" name="AddQuestion" value="1" disabled>Add Question</button> <!-- button create quiz -->
                    </form>
        
                </div>                                  
            </div>
            
            <div class="row questionBox mx-0 mt-2"> <!-- quiz question block -->

            <form action="/php/create.php" method="POST">
            
                <div class="col">
              
                <div class="my-2 mx-4">
    
                <label for="q">Your Question:</label>
      <textarea class="form-control" rows="2" id="q" name="q"></textarea>

</div>
                    
                </div>
            </div>

            <div class="row mx-0 mt-1"> <!-- quiz answer/footer block -->                

                    <div class="row answerBox mt-1 mx-0"> <!-- quiz answer block --> 
                        <div class="col">
                            
                            <div class="my-2"></div>
                            
                            <?php

                            echo "
                            <div class='form-check'>
                                <label class='form-check-label' for='a1t'>Answer 1 - Put a tick if the question is correct:</label>
                                <div class='d-flex align-items-center'>
                                    <input type='checkbox' class='form-check-input me-2' id='a1' name='a1c' value='1'>
                                    <input type='text' class='form-control' id='a1' name='a1t'>
                                </div>
                            </div>
             
                            <div class='my-2'></div>
                            
                            <div class='form-check'>
                                <label class='form-check-label' for='a1t'>Answer 2 - Put a tick if the question is correct:</label>
                                <div class='d-flex align-items-center'>
                                    <input type='checkbox' class='form-check-input me-2' id='a2' name='a2c' value='1'>
                                    <input type='text' class='form-control' id='a2' name='a2t'>
                                </div>
                            </div>

                            <div class='my-2'></div>

                            <div class='form-check'>
                                <label class='form-check-label' for='a1t'>Answer 3 - Put a tick if the question is correct:</label>
                                <div class='d-flex align-items-center'>
                                    <input type='checkbox' class='form-check-input me-2' id='a3' name='a3c' value='1'>
                                    <input type='text' class='form-control' id='a3' name='a3t'>
                                </div>
                            </div>

                            <div class='my-2'></div>

                            <div class='form-check'>
                                <label class='form-check-label' for='a1t'>Answer 4 - Put a tick if the question is correct:</label>
                                <div class='d-flex align-items-center'>
                                    <input type='checkbox' class='form-check-input me-2' id='a4' name='a4c' value='1'>
                                    <input type='text' class='form-control' id='a4' name='a4t'>
                                </div>
                            </div>
                            ";
                            ?>
                            
                            <div class="my-3"></div>

                        </div>

                    </div>
                </div>               

                <div class="row mt-2"> <!-- quiz footer block -->   
                        <div class="col d-flex justify-content-between">
                            <button type="reset" class="btn btn-danger">Reset</button> <!-- button new quiz -->      
                            <button type="submit" class="btn btn-success">Add</button> <!-- button create quiz -->
                        </div>
                    </div>
                </form>

            </div>
            <div class="col"></div> <!-- end invisible col -->
    </div>
</div>

</body>
</html>
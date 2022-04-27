<?php
session_start();
/* print_r($_SESSION); */

if (isset($_SESSION["q"])) $questionText = $_SESSION["q"]; else $questionText = "";
if (isset($_SESSION["a1"])) $answer1Text = $_SESSION["a1"]; else $answer1Text = "";
if (isset($_SESSION["a2"])) $answer2Text = $_SESSION["a2"]; else $answer2Text = "";
if (isset($_SESSION["a3"])) $answer3Text = $_SESSION["a3"]; else $answer3Text = "";
if (isset($_SESSION["a4"])) $answer4Text = $_SESSION["a4"]; else $answer4Text = "";
if (isset($_SESSION["CID"])) $questionNumber = $_SESSION["CID"]; else $questionNumber = "";

// $_SESSION = [];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="/css/quiz-style.css"/>
    <title>Quiz Generator</title>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col"></div> <!-- start invisible col -->

        <div class="col-6 quizContainer"> <!-- quiz container -->
        <form action="/php/result.php" method="POST">
            <div class="row"> <!-- quiz header block -->
           
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
            
            <div class="row addQuestionBox mt-2 bg-light"> <!-- quiz question block -->

            <form action="/php/result.php" method="POST">           
            
                <div class="col">
               
                <div class="my-2 mx-4">
    
                <label for="comment">Your Question:</label>
      <textarea class="form-control" rows="2" id="comment" name="text"></textarea>

</div>                   
                </div>
            </div>

            <div class="row"> <!-- quiz answer/footer block -->              

                    <div class="row mt-1 bg-light"> <!-- quiz answer block --> 
                        <div class="col">
                            
                            <div class="my-2"></div>
                            
                            <div class="form-check">
                                <label class="form-check-label" for="a1t">Answer 1. Tick if the answer is correct:</label>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" class="form-check-input me-2" id="a1c" name="a1">
                                    <input type="text" class="form-control" id="a1" name="a1t">
                                </div>
                            </div>

                            <div class="my-2"></div>
                            
                            <div class="form-check">
                                <label class="form-check-label" for="a1t">Answer 2. Tick if the answer is correct:</label>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" class="form-check-input me-2" id="a1c" name="a1">
                                    <input type="text" class="form-control" id="a1" name="a1t">
                                </div>
                            </div>

                            <div class="my-2"></div>

                            <div class="form-check">
                                <label class="form-check-label" for="a1t">Answer 3. Tick if the answer is correct:</label>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" class="form-check-input me-2" id="a1c" name="a1">
                                    <input type="text" class="form-control" id="a1" name="a1t">
                                </div>
                            </div>

                            <div class="my-2"></div>

                            <div class="form-check">
                                <label class="form-check-label" for="a1t">Answer 4. Tick if the answer is correct:</label>
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" class="form-check-input me-2" id="a1c" name="a1">
                                    <input type="text" class="form-control" id="a1" name="a1t">
                                </div>
                            </div>
                            
                            <div class="my-3"></div>

                        </div>

                    </div>
                </div>               

                    <div class="row mt-2 justify-content-between"> <!-- quiz footer block -->   
                        <div class="col">
                            <button type="submit" class="btn btn-danger">Back</button> <!-- button new quiz -->
                        </div>
                        <div class="col">
                            <p>Timer</p> <!-- title text -->
                        </div>
                        <div class="col">
                            <button type="submit" name="s" value="1" class="btn btn-success">Next</button> <!-- button create quiz -->
                        </div>
                    </div>
                </form>

            </div>
            <div class="col"></div> <!-- end invisible col -->
    </div>
</div>

</body>
</html>
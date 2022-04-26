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
           
                <div class="col-6 d-flex justify-content-start">
                    <h3>Quiz Generator</h3> <!-- title text -->
                </div>                     
               
                <div class="col d-flex justify-content-end m-0 p-0">
                    
                    <input type="text" class="amountQuestions form-control me-2" name="aq">
                    <button type="submit" class="btn btn-primary me-2" name="newQuiz" value="1">New Quiz</button> <!-- button new quiz -->
                    <button type="submit" class="btn btn-primary">Create Quiz</button> <!-- button create quiz -->
                    </form>
                </div>                                  
            </div>

            <div class="row questionBox mt-2 bg-light"> <!-- quiz question block -->
                <div class="col">
                    <p>Frage <?=$questionNumber?>: <?=$questionText?></p> <!-- title text -->
                </div>
            </div>

            <div class="row"> <!-- quiz answer/footer block -->

                <form action="/php/result.php" method="POST">

                    <div class="row mt-1 bg-light"> <!-- quiz answer block --> 
                        <div class="col">                    
            
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="qr" value="1" id="a1">
                                <label class="form-check-label" for="a7"><?=$answer1Text?></label>
                            </div>

                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="qr" value="2" id="a2">
                                <label class="form-check-label" for="a6"><?=$answer2Text?></label>
                            </div>

                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="qr" value="3" id="a3">
                                <label class="form-check-label" for="a5"><?=$answer3Text?></label>
                            </div>

                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="qr" value="4" id="a4">
                                <label class="form-check-label" for="a4"><?=$answer4Text?></label>
                            </div>

                        </div>

                    </div>
                </div>               

                    <div class="row mt-2 justify-content-between"> <!-- quiz footer block -->   
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Back</button> <!-- button new quiz -->
                        </div>
                        <div class="col">
                            <p>Timer</p> <!-- title text -->
                        </div>
                        <div class="col">
                            <button type="submit" name="s" value="1" class="btn btn-primary">Next</button> <!-- button create quiz -->
                        </div>
                    </div>
                </form>

            </div>
            <div class="col"></div> <!-- end invisible col -->
    </div>
</div>

<?php
print_r($_SESSION);
?>

</body>
</html>
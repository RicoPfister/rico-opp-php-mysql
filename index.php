<?php
session_start();
/* print_r($_SESSION); */

if (isset($_SESSION["q"])){
    $questionText = $_SESSION["q"];
    $questionNumber = $_SESSION["CID"];

    for($i=1; $i<5; $i++){
        if (isset($_SESSION["a".$i])) ${"answer".$i."Text"} = $_SESSION["a".$i];
    }
} else {
        $_SESSION['newQuiz'] = 1;
        header("Location: /php/result.php");
        exit();
}

include 'php/header.php';

?>

<div class="container">
    <div class="row">
        <div class="col"></div> <!-- start invisible col -->

        <div class="col-xl-6 max-vh-100 quizContainer"> <!-- quiz container -->
        <form action="/php/result.php" method="POST">
            <div class="row m-0"> <!-- quiz header block -->    
               
                <div class="col colHeader d-sm-flex m-0 p-0">

                    <div class="col-auto d-flex align-items-center m-0 p-0">
                        <h5 class="m-0 p-0">Quiz Generator</h5> <!-- title text -->
                    </div>
                    
                    <div class="col d-flex justify-content-end"> <!-- header whole button box -->
                    
                        <div class="col-auto d-flex justify-content-end"> <!-- header new quiz box-->
                            <input type="text" class="amountQuestions form-control me-2 border-dark" name="aq" placeholder=""> 
                            <button type="submit" class="btn btn-dark me-2" name="newQuiz" value="1"><div class="d-none d-sm-block">New Question(s)</div><div class="d-block d-sm-none">N</div></button> <!-- button new quiz - change text if smaller/bigger than sm-->
                        </div>

                        <div class="col-auto d-flex justify-content-end"> <!-- header add quiz box -->
                            <button type="submit" class="btn btn-dark" name="addQuestion" value="1"><div class="d-none d-sm-block">Add Question</div><div class="d-block d-sm-none">+</div></button> <!-- button create quiz - change text if smaller/bigger than sm-->
                        </div>
                    </div>
                    </form>
        
                </div>                                  
            </div>
            
            <div class="row questionBox mx-0 mt-2"> <!-- quiz question block -->

            <form action="/php/result.php" method="POST">
            
                <div class="col">
              
                <div class="my-3 mx-4">
    
                <p>Frage <?=$questionNumber?>: <?=$questionText?></p> <!-- title text -->

</div>
                    
                </div>
            </div>

            <div class="row mx-0 mt-"> <!-- quiz answer/footer block -->                

                    <div class="row answerBox mt-1 mx-0"> <!-- quiz answer block --> 
                        <div class="col-sm-lg">
                            
                        <?php

                        echo "<div class='mt-3'></div>";
                        
                        for($i=1; $i<5; $i++){

                            if(isset($_SESSION["a".$i])) {

                                echo "
                                <div class='form-check'>
                                    <input type='radio' class='form-check-input' name='qr' id='a$i' value='1'>
                                    <label class='form-check-label' for='a$i'>".${"answer".$i."Text"}."</label>
                                </div>
                                ";
                            }

                        echo "<div class='mb-3'></div>";
                        }
                        ?>

                        </div>

                    </div>
                </div>               

                    <div class="row mt-2"> <!-- quiz footer block -->   
                        <div class="col d-flex justify-content-between">
                            <button type="submit" class="btn btn-danger">Back</button> <!-- button new quiz -->      
                            <button type="submit" class="btn btn-success">Next</button> <!-- button create quiz -->
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
?>

</body>
</html>
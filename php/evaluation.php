<?php session_start();

include 'databaseConnection.php';

$points = 0;

$_maxPoints = $_SESSION['MaxPoints'];
$_maxMistakes = $_SESSION['MaxMistakes'];

foreach($_SESSION["userdata"] as $userQuestion => $userAnswer) { // show question overview array

    $UQID = substr($userQuestion, 2); // trimmed user question number
    $DBQuestionAnswer = $DBAccess->query("SELECT * FROM Questions, Answers WHERE Questions.QID = Answers.QID AND Questions.QID = $UQID"); // select question number array
    $answerNumber = $DBQuestionAnswer->fetchALL(PDO::FETCH_ASSOC); // gather all question/answer data

    /*
    echo "<pre>";
    print_r($answerNumber);
    echo "</pre>";
    */

    echo "<h6>Frage $UQID: ".$answerNumber[0]['QuestionDE']."<h6>";   

    for($i=1; $i<5; $i++){
        if (isset($_SESSION["userdata"][$userQuestion]["UA".$UQID."-$i"])){ // check if the answer 1-4 is set by user            
            
            if ($answerNumber[$i-1]["CorrectAnswer"] == 1) { // check if the user answer is correct. if yes = green
                ${"answer".$i."Color"} = "green";
                $points+=1; 

            } else {                
                ${"answer".$i."Color"} = "red"; // check if the user answer is correct. if no = red
                $points+=0; 
            }
            
            if ($answerNumber[$i-1]["CorrectAnswer"] == 1) ${"answer".$i."FontDeco"} = "underline"; else ${"answer".$i."FontDeco"} = ""; // check if the user answer is correct. set font weight
            echo "<div style='color:${"answer".$i."Color"}; text-decoration:${"answer".$i."FontDeco"}'>".$answerNumber[$i-1]['AnswerDE']."</div>";
        }

        elseif (isset($answerNumber[$i-1])) {
            ${"answer".$i."Color"} = "black"; // when the answer 1-4 was not set
            if ($answerNumber[$i-1]["CorrectAnswer"] == 1) ${"answer".$i."FontDeco"} = "underline"; else ${"answer".$i."FontDeco"} = ""; // check if the user answer is correct. set font weight
            echo "<div style='color:${"answer".$i."Color"}; text-decoration:${"answer".$i."FontDeco"}'>".$answerNumber[$i-1]['AnswerDE']."</div>";
        } 

        /*
        else { // when the answer 1-4 was not set
            ${"answer".$i."Color"} = "black";            
            
            if ($answerNumber[$i-1]["CorrectAnswer"] == 1) ${"answer".$i."FontDeco"} = "underline"; else ${"answer".$i."FontDeco"} = ""; // check if the user answer is correct. set font weight
        }
        */      
    
    }  

    /*
    $answer1Num = substr("q1-4", 3, 3); // trim down to answer number
    $answer2Num = substr("q1-4", 3, 3); // trim down to answer number
    $answer3Num = substr("q1-4", 3, 3); // trim down to answer number
    $answer4Num = substr("q1-4", 3, 3); // trim down to answer number
    */
    
    echo "<hr>";
  
}

/*
echo "<pre>";
print_r($_SESSION["userdata"]);
echo "</pre>";
*/

include 'header.php';

?>

<div class="container">

    <div class="row">

        <div class="col mt-5">

            <h1>Auswertung</h1>

        </div>

    </div>

    <div class="row">

        <div class="col mt-3">

            <p>Gesamtpunktzahl: <?=$points?> von <?=$_maxPoints?> Punkt(en).</p>

        </div>
        
    </div>

        <div class="row mt-3">

            <div>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col mt-5 d-flex justify-content-center">

            <form action="/php/result.php" method="POST">
            <button type="submit" class="btn btn-primary" name="newQuiz" value="1">New Quiz</button> <!-- button new quiz -->
            <button type="submit" name="addQuestion" value ="1" class="btn btn-primary">Add Question</button>
            </form>

        </div>

    </div>

</div>
    
</body>
</html>



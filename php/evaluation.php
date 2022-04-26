<?php session_start();

include 'databaseConnection.php';

$points = 0;

$DBCorrectAnswers = $DBAccess->query("SELECT CorrectAnswer FROM Answers WHERE CorrectAnswer = 1"); // total possible points
$CorrectAnswers = $DBCorrectAnswers->fetchALL(PDO::FETCH_ASSOC);
$sumCorrectAnswers = count($CorrectAnswers);

foreach($_SESSION["userdata"] as $userQuestion => $userAnswer) { // show question overview array

    $UQID = substr($userQuestion, 2); // trimmed user question number
    $DBQuestionAnswer = $DBAccess->query("SELECT * FROM Questions, Answers WHERE Questions.QID = Answers.QID AND Questions.QID = $UQID"); // select question number array
    $answerNumber = $DBQuestionAnswer->fetchALL(PDO::FETCH_ASSOC); // gather all question/answer data

    /*
    echo "<pre>";
    print_r($answerNumber);
    echo "</pre>";
    */

    for($i=1; $i<5; $i++){
        if (isset($_SESSION["userdata"][$userQuestion]["UA".$UQID."-$i"])){ // check if the answer 1-4 is set by user            
            
            if ($answerNumber[$i-1]["CorrectAnswer"] == 1) {
                ${"answer".$i."Color"} = "green";
                $points++; 

            } else {                
                ${"answer".$i."Color"} = "red"; // check if the user answer is correct. set color
                $points--; 
            }

            if ($answerNumber[$i-1]["CorrectAnswer"] == 1) ${"answer".$i."FontDeco"} = "underline"; else ${"answer".$i."FontDeco"} = ""; // check if the user answer is correct. set font weight
        }

        else { // when the answer 1-4 was not set
            
            ${"answer".$i."Color"} = "black";
            if ($answerNumber[$i-1]["CorrectAnswer"] == 1) ${"answer".$i."FontDeco"} = "underline"; else ${"answer".$i."FontDeco"} = ""; // check if the user answer is correct. set font weight
        }
    
    }  

    /*
    $answer1Num = substr("q1-4", 3, 3); // trim down to answer number
    $answer2Num = substr("q1-4", 3, 3); // trim down to answer number
    $answer3Num = substr("q1-4", 3, 3); // trim down to answer number
    $answer4Num = substr("q1-4", 3, 3); // trim down to answer number
    */

    echo "<h6>Frage $UQID: ".$answerNumber[0]['Question']."<h6><br>";
    echo "<div style='color:$answer1Color; text-decoration:$answer1FontDeco'>".$answerNumber[0]['Answer']."</div>";
    echo "<div style='color:$answer2Color; text-decoration:$answer2FontDeco'>".$answerNumber[1]['Answer']."</div>";
    echo "<div style='color:$answer3Color; text-decoration:$answer3FontDeco'>".$answerNumber[2]['Answer']."</div>";
    echo "<div style='color:$answer4Color; text-decoration:$answer4FontDeco'>".$answerNumber[3]['Answer']."</div><hr>"; // draw a line before new section
}

echo "<pre>";
print_r($_SESSION["userdata"]);
echo "</pre>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/quiz.css"/>
    <title>Auswertung</title>
</head>
<body>

<div class="container">

    <div class="row">

        <div class="col mt-5">

            <h1>Auswertung</h1>

        </div>

    </div>

    <div class="row">

        <div class="col mt-3">

            <p>Gesamtpunktzahl: <?=$points?> von <?=$sumCorrectAnswers?> Punkten.</p>

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
            <button type="submit" name="createquiz" value ="1" class="btn btn-primary">Create Quiz Question</button>
            </form>

        </div>

    </div>

</div>
    
</body>
</html>



<?php

session_start();

// print_r($_POST);

include 'databaseConnection.php';

$CurrentQuestionID = $_POST['qid'];

// total number of questions
$DBAll = $DBAccess->query("SELECT * FROM Questions, Answers WHERE Questions.QID = Answers.QID AND Questions.QID = $CurrentQuestionID"); // get all data from database
$allData = $DBAll->fetchALL(PDO::FETCH_ASSOC);

/*// set new AID ==> php myadmin sets AID automatically
$query2 = $DBAccess->query("SELECT AID FROM Answers ORDER BY AID DESC LIMIT 1");
$newAID = ($query2->fetch(PDO::FETCH_ASSOC)["AID"])+1;*/

// update if question text has changed
if (isset($_POST['q'])) {

    if ($_POST['q'] != $allData[0]['QuestionDE']) {
        $question = $_POST['q'];
        $questionTextExec = "UPDATE `Questions` SET `QuestionDE` = '$question' WHERE Questions.QID = $CurrentQuestionID";

        $statement = $DBAccess->prepare($questionTextExec);
        $statement->execute();
    }

}

// update if answer text or answer checks has changed

for ($i=0; $i<4; $i++) {

    $i_i = $i+1;

    if (isset($_POST['at'.$i_i]) && $_POST['at'.$i_i] != "") { // check changes of text answers

        if (isset($allData[$i]['AID'])){
            $AID = $allData[$i]['AID'];
        }
        ${'att'.$i_i} = $_POST['at'.$i_i];

        if(isset($_POST['ac'.$i_i])) ${'ac'.$i_i} = 1; else ${'ac'.$i_i} = 0;

        if (!isset($allData[$i]['AnswerDE'])) { // if missing create additonal answer

            ${'atExec'.$i_i} = "INSERT INTO `Answers` (`AID`, `AnswerDE`, `Image`, `CorrectAnswer`, `QID`, `AIndex`) VALUES (NULL, '${'att'.$i_i}', '0', '${'ac'.$i_i}', $CurrentQuestionID, $i+1)";
            ${"newAnswer".$i} = $DBAccess->prepare(${'atExec'.$i_i}); 
            ${"newAnswer".$i}->execute();
        }
        
        elseif ($_POST['at'.$i_i] != $allData[$i]['AnswerDE']) {
            
            ${'atExec'.$i_i} = "UPDATE `Answers` SET `AnswerDE` = '${'att'.$i_i}', `IsActive` = '1' WHERE Answers.AID = $AID";
            
            $statement = $DBAccess->prepare(${'atExec'.$i_i});
            $statement->execute();
        }
    }

    if (isset($_POST['ac'.$i_i]) && $_POST['ac'.$i_i] != "" && isset($allData[$i]['CorrectAnswer'])) {

        ${'att'.$i_i} = 1;

        if ($_POST['ac'.$i_i] != $allData[$i]['CorrectAnswer']) { // check changes of radio/check boxes
                       
            ${'acExec'.$i_i}  = "UPDATE `Answers` SET `CorrectAnswer` = '${'ac'.$i_i}', `IsActive` = '1' WHERE Answers.AID = $AID";

            $statement = $DBAccess->prepare(${'acExec'.$i_i});
            $statement->execute();
        }
    }

}

// print_r($allData);

/*$sql = "UPDATE `Questions` SET `QuestionDE` = 'What do you use to form a Javascript loop??????' WHERE Questions.QID = $CurrentQuestionID";



/*

// create question database entry
$sql = "INSERT INTO Questions (`QID`, `AType`, `QuestionDE`) VALUES (NULL, 'Radio', '$question')";

$statement = $DBAccess->prepare($sql);
$statement->execute();

$query2 = $DBAccess->query("SELECT QID FROM Questions ORDER BY QID DESC LIMIT 1");
$lastQID = $query2->fetch(PDO::FETCH_ASSOC)["QID"];

// get POST data and save it in variables
$question = $_POST["q"];

// create answers database entries
for($i = 1; $i < 5; $i++){

    if($_POST["a".$i."t"] != ""){ // check if answer was given

    ${"answer".$i."Text"} = $_POST["a".$i."t"];  

    if(isset($_POST["a".$i."c"])) ${"answer".$i."Correct"} = $_POST["a".$i."c"]; else ${"answer".$i."Correct"} = 0;

    ${"sql".$i} = "INSERT INTO `Answers` (`AID`, `AnswerDE`, `Image`, `CorrectAnswer`, `QID`, `AIndex`) VALUES (NULL, '${"answer".$i."Text"}', '0', '${"answer".$i."Correct"}', $lastQID, $i)";
    ${"statement".$i} = $DBAccess->prepare(${"sql".$i}); 
    ${"statement".$i}->execute();
    }     
}

// write into database

*/

//go back to index

header("Location: /php/browse.php");
exit();

















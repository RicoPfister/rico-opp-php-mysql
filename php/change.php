<?php

session_start();

$_SESSION['lastPOST'] = $_POST;

// print_r($_POST);

include 'databaseConnection.php';

$CurrentQuestionID = $_POST['qid'];

// total number of questions
$DBAll = $DBAccess->query("SELECT * FROM Questions, Answers WHERE Questions.QID = Answers.QID AND Questions.QID = $CurrentQuestionID"); // get all data from database
$allData = $DBAll->fetchALL(PDO::FETCH_ASSOC);

/*// set new AID ==> php myadmin sets AID automatically
$query2 = $DBAccess->query("SELECT AID FROM Answers ORDER BY AID DESC LIMIT 1");
$newAID = ($query2->fetch(PDO::FETCH_ASSOC)["AID"])+1;*/

if ($_POST['q'] == ""){
    goto end;
}

// hide question
if (isset($_POST['hide_q'])) {

    ${'qhExec'} = "UPDATE `Questions` SET `IsActive` = '0' WHERE Questions.QID = $CurrentQuestionID";
            
    $statement = $DBAccess->prepare(${'qhExec'});
    $statement->execute();

    goto end;
}

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

    if ($_POST['at'.$i+1] == ""){
        goto enda;
    }

    if (isset($allData[$i]['AID'])){
        $AID = $allData[$i]['AID'];
    }

    // hide answer 
    if (isset($_POST['hide_a'.$i+1])) {

        ${'ahExec'} = "UPDATE `Answers` SET `IsActive` = '0' WHERE Answers.AID = $AID";
                
        $statement = $DBAccess->prepare(${'ahExec'});
        $statement->execute();

        goto end;
    }

    if (isset($_POST['at'.$i_i]) && $_POST['at'.$i_i] != "") { // check changes of text answers

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

    enda:

}

end:

header("Location: /php/browse.php");
exit();
<?php session_start();

include 'databaseConnection.php';

// answer evaluation
$rest = substr("abcdef", 0, -1)









$totalPoints = 9;
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

            <p>Gesamtpunktzahl: <?=$totalPoints?> von 9 Punkten.</p>

        </div>
        
    </div>

        <div class="row mt-3">

            <div>

                    <h2>Detailauswertung</h2><br>
                    <p>Frage 1: </p>
                    <p>Antwort1: </p>
                    <p>Antwort2: </p>
                    <p>Antwort3: </p>
                    <p>Antwort4: </p>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col mt-5 d-flex justify-content-center">

            <form action="/index.php" method="POST">
            <button type="submit" name="newquiz" value ="1" class="btn btn-primary me-3">New Quiz</button>
            <button type="submit" name="createquiz" value ="1" class="btn btn-primary">Create Quiz</button>
            </form>

        </div>

    </div>

</div>
    
</body>
</html>



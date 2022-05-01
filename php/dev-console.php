<?php
$totalQuizQuestions = $_SESSION['totalQuestions'];

// infobar information for javascript (display: none)

echo "<p id='totalQuizQuestions'>$totalQuizQuestions</p>

<div class='m-4' id='devConsole'>
    <h6 class='mb-3'><b>Dev Console</b></h6> 
    <h6 class='mb-3'>\$_SESSION:</h6>
        <pre>";
        print_r($_SESSION);
echo "
        </pre>
</div>";
?>
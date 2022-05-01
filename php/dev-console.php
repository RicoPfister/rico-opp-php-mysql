<?php
$totalQuizQuestions = $_SESSION['totalQuestions'];

// infobar information for javascript (display: none)

echo "<p id='totalQuizQuestions'>$totalQuizQuestions</p>
<div id='devConsole'>
    <pre>";

        print_r($_SESSION);

echo "
    </pre>
</div>";
?>
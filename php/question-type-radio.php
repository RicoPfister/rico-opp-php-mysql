<?php
    for($i=1; $i<5; $i++){

    if(isset($_SESSION["a".$i])) {

        echo "
        <div class='form-check'>
            <input type='radio' class='form-check-input' name='qr' id='qr$i' value='$i'>
            <label class='form-check-label' for='qr$i'>".${"answer".$i."Text"}."</label>
        </div>
        ";
    }

    echo "<div class='mb-3'></div>";
    }
?>
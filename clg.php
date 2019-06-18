 <?php

function consoleLog($input){

    $input = strtolower($input);

    $output = "\"$input\"";

    echo "<script>

        console.log(";

    print($output);

    echo ");</script>";

}




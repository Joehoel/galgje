<?php
include 'favicon.php';
include 'header.php';
include 'clg.php';
session_start();
echo "<footer>";
echo "<div class=\"info\">";
    // Variable woord instellen
    if (!empty($_SESSION['woord'])) {
        $woord = $_SESSION['woord'];
        $arrwoord = str_split($woord);
        // echo "Ingevoerd woord: ".$woord ."<br>";
        // echo "Ingevoerd woord in array: ";
        // print_r($arrwoord);
    }

    // Variable letter instellen
    if (!empty($_POST['letter'])) {
        $_SESSION['letter'] = $_POST['letter'];
        $letter = $_SESSION['letter'];

        // Zit de letter in alfabet
        if (ctype_alpha($letter)) {
            // letter naar uppercase en spaties weghalen
            $letter = strtoupper($letter);
            $letter = trim($letter);

            if (!in_array($letter, $arrwoord) && !in_array($letter, $_SESSION['letters'])) {
                $_SESSION['attempts_left']--;
            }

            // Array met alle geraden letters
            $_SESSION['letters'][] = $letter;
            for ($i=0; $i < strlen($woord); $i++) {
                if ($letter == $arrwoord[$i]) {
                    $_SESSION['streepjes'][$i] = $letter;
                }
            }
            // echo "Laatst ingevoerde letter: ".$letter."<br>";
        } else {
            echo "Je mag geen tekens of spaties invoeren!<br><br>";
        }
    }
    echo "Geraden letters: <br>";
    $_SESSION['letters'] = array_unique($_SESSION['letters']);
    echo join(", ", $_SESSION['letters']);
    echo "<br>";
    print("Beurten over: ".$_SESSION['attempts_left']);
    echo "<br><br>";
    foreach ($_SESSION['streepjes'] as $streepje) {
        echo $streepje;
    }

    if (isset($_POST['opnieuw'])) {
        header("Location: index.php");
        exit();
    }
echo "</div>";
// Logged het woord
consoleLog($woord);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Galgje</title>
    <script src="sounds.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>
	<div class="main">
 	<?php if ($_SESSION['attempts_left'] > 0 && in_array(" _ ", $_SESSION['streepjes'])): ?>
		<h1>Vul een letter in</h1>
		<form action="letter.php" method="post">
			<input type="text" name="letter" autocomplete="off" autofocus="autofocus" maxlength="1">
			<button type="submit" class="button">OK</button>
		</form>
	<?php endif; ?>

	<img src="./images/h3/img_<?php echo $_SESSION['max_attempts'] - $_SESSION['attempts_left']; ?>.png" alt="hangman">

	<?php if ($_SESSION['attempts_left'] <= 0 || !in_array(" _ ", $_SESSION['streepjes'])): ?>

		<?php if ($_SESSION['attempts_left'] <= 0): ?>
			<h1>Je hebt verloren!</h1>
            <p>Het woord was: <?php echo strtolower($woord); ?></p>
            <iframe src="https://giphy.com/embed/cr9vIO7NsP5cY" width="200" height="200" frameBorder="0" class="giphy-embed" allowFullScreen></iframe><p><a href="https://giphy.com/gifs/online-dating-cr9vIO7NsP5cY"></a></p>
		<?php endif; ?>
		<?php if (!in_array(" _ ", $_SESSION['streepjes'])): ?>
			<h1>Je hebt gewonnen!</h1>
            <br>
            <iframe src="https://giphy.com/embed/1GrsfWBDiTN60" width="400" height="200" frameBorder="0" class="giphy-embed" allowFullScreen></iframe><p><a href="https://giphy.com/gifs/dance-long-hair-shake-1GrsfWBDiTN60"></a></p>
		<?php endif; ?>
		<form action="index.php"><button type="submit">Opnieuw</button></form>
	<?php endif; ?>
    <?php if (in_array(" _ ", $_SESSION['streepjes']) && !$_SESSION['attempts_left'] <= 0): ?>
		<form action="index.php"><button type="submit">Stop</button></form>
    <?php endif; ?>
	</div>
    <script src="https://code.createjs.com/1.0.0/easeljs.min.js"></script>
</body>

</html>

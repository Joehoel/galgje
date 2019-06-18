<?php
include 'favicon.php';
include 'header.php';
session_start();
function start()
    {
        $_SESSION['letters'] = array();
        $_SESSION['max_attempts'] = 11;
        $_SESSION['streepjes'] = array();
        for ($i=0; $i < strlen($_SESSION['woord']); $i++) {
            $_SESSION['streepjes'][$i] = " _ ";
        }
        $_SESSION['attempts_left'] = 11;
        $_SESSION['woord'] = strtoupper($_SESSION['woord']);
        $_SESSION['woord'] = trim($_SESSION['woord']);

        // Stuur naar letter.php
        header("Location: letter.php");
        die();
    }
    if (!empty($_POST['rw'])) {
        $rWoord = array("grafeem", "tjiftjaf", "maquette", "kitsch", "pochet", "convocaat", "jakkeren", "collaps", "zuivel", "cesium", "voyant", "spitten", "pancake", "gietlepel", "karwats", "dehydreren", "viswijf", "flater", "cretonne", "sennhut", "tichel", "wijten", "cadeau", "trotyl", "chopper", "pielen", "vigeren", "vrijuit", "dimorf", "kolchoz", "janhen", "plexus", "borium", "ontweien", "quiche", "ijverig", "mecenaat", "falset", "telexen", "hieruit", "femelaar", "cohesie", "exogeen", "plebejer", "opbouw", "zodiak", "volder", "vrezen", "convex", "verzenden", "ijstijd", "fetisj", "gerekt", "necrose", "conclaaf", "clipper", "poppetjes", "looikuip", "hinten", "inbreng", "arbitraal", "dewijl", "kapzaag", "welletjes", "bissen", "catgut", "oxymoron", "heerschaar", "ureter", "kijkbuis", "dryade", "grofweg", "laudanum", "excitatie", "revolte", "heugel", "geroerd", "hierbij", "glazig", "pussen", "liquide", "aquarium", "formol", "kwelder", "zwager", "vuldop", "halfaap", "hansop", "windvaan", "bewogen", "vulstuk", "efemeer", "decisief", "omslag", "prairie", "schuit", "weivlies", "ontzeggen", "schijn", "sousafoon" , "taxi" ,"quasi" ,"ei" ,"quiz" ,"lynx" ,"etui" ,"psyche" ,"dodo" ,"party" ,"hyena" ,"picknick" ,"gymzaal" ,"oase" ,"fauna" ,"cycloon" ,"qua" ,"uier" ,"sfinx" ,"curry" ,"cacao" ,"galerij" ,"sambal" ,"bushalte" ,"jazzzanger" ,"winnaar");
        $woordN = [rand(0, count($rWoord) - 1)];
        $_SESSION['woord'] = $rWoord[$woordN[0]];
        start();
    }
    // Do all checks for the entered word
    if (!empty($_POST['woord'])) {
        // Woord invullen en trimmen
        $_SESSION['woord'] = $_POST['woord'];
        if (ctype_alpha($_SESSION['woord']) && strlen($_SESSION['woord']) > 3) {
            $_SESSION['woord'] = strtoupper($_SESSION['woord']);
            $_SESSION['woord'] = trim($_SESSION['woord']);
            start();
        } else {
            echo "<div class=\"info\" >Je moet minimaal 3 letters hebben en er mogen geen cijfers en andere tekens in zitten.</div>";
        }
    }

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Galgje</title>
		<link rel="stylesheet" type="text/css" href="./style.css">
	</head>
	<body>
		<div class="main">
			<h1>Vul hier je woord in!</h1>
			<form method="post" action="index.php">
				<input type="text" name="woord" autocomplete="off" autofocus="autofocus">
				<button type="submit">OK</button>
			</form>
			<form method="post" action="index.php">
				<button type="submit" name="rw" value="rw">Willekeurig woord</button>
			</form>
		</div>

	</body>
</html>

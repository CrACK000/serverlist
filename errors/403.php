<?php
	echo "
	<html>
		<head>
			<title>Chyba 403</title>
		</head>
		<body style='background-color:#eeeeee; text-align:center; color:#999;'>
			<center>
				<img style='opacity:0.4;' src='http://flactor.eu/images/logo_black.png'>
			</center>
			<h2>CHYBA 403 - Str�nka nenalezena</h2>
			Str�nka, kterou hled�te <b>http://".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI']."</b>, se na tomto serveru nenach�z�.<br/>
			Pravd�podobn� jste zadali �patn� tvar odkazu, a proto si rad�ji skontrolujte jeho spr�vnost<br/><br/>
			Pokra�ujte, pros�m, na<br/>
			<a style='color:#666;text-decoration:none;' href='http://flactor.eu'><h3>Flactor.eu</h3></a>
		</body>
	</html>";
?>
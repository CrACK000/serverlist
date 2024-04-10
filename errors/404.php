<?php
	echo "
	<html>
		<head>
			<title>Chyba 404</title>
		</head>
		<body style='background-color:#eeeeee; text-align:center; color:#999;'>
			<center>
				<img style='opacity:0.4;' src='http://flactor.eu/images/logo_black.png'>
			</center>
			<h2>CHYBA 404 - Stránka nenalezena</h2>
			Stránka, kterou hledáte <b>http://".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI']."</b>, se na tomto serveru nenachází.<br/>
			Pravděpodobně jste zadali špatný tvar odkazu, a proto si raději skontrolujte jeho správnost<br/><br/>
			Pokračujte, prosím, na<br/>
			<a style='color:#666;text-decoration:none;' href='http://flactor.eu'><h3>Flactor.eu</h3></a>
		</body>
	</html>";
?>
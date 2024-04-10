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
			<h2>CHYBA 403 - Stránka nenalezena</h2>
			Stránka, kterou hledáte <b>http://".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI']."</b>, se na tomto serveru nenachází.<br/>
			Pravdìpodobnì jste zadali špatný tvar odkazu, a proto si radìji skontrolujte jeho správnost<br/><br/>
			Pokraèujte, prosím, na<br/>
			<a style='color:#666;text-decoration:none;' href='http://flactor.eu'><h3>Flactor.eu</h3></a>
		</body>
	</html>";
?>
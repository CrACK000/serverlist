<?php

	include "lgsl_files/lgsl_class.php";
	lgsl_database();
	$output = "";
	$id = mysql_real_escape_string( intval( $_GET['viewid'] ) );
	
	function news_id_exists( $id = "" )
	{
		global $lgsl_database, $lgsl_config;
		$zisti = mysql_query( "SELECT * FROM `".$lgsl_config['db']['newstable']."` WHERE news_id='".$id."' LIMIT 1", $lgsl_database );
		$data = mysql_fetch_assoc( $zisti );
		if($data) { return true; } else { return false; }
	}
	
	if(isset($id) && is_numeric($id))
	{
		if( !( news_id_exists( $id ) ) )
		{
			$output = "<div class='text-center'><p>Novinka s takımto ID v našej databáze neexistuje, alebo bola vymazaná adminom kım sa ti naèítal web.</p></div>";
			return;
		}
		$vyber = mysql_query( "SELECT * FROM `".$lgsl_config['db']['newstable']."` WHERE news_id='".$id."'");
		$data = mysql_fetch_assoc( $vyber );
		
		$output = "<h2>".$data['news_name']."</h2><h4>Pridané dòa: ".Date("d.M.Y H:i:s",$data['news_date'])."</h4><hr />";
		$output .= "<p>".nl2br(addslashes(preg_replace("(^<p>\s</p>$)", "", $data['news_text'])))."</p>";
		$output .= "<hr />";
		$output .= "<div id='fb-root'></div><script>(function(d, s, id) { var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = '//connect.facebook.net/sk_SK/sdk.js#xfbml=1&version=v2.0'; fjs.parentNode.insertBefore(js, fjs); }(document, 'script', 'facebook-jssdk'));</script>";
		$output .= "<div class='fb-like' data-href='http://".$_SERVER['HTTP_HOST']."/novinky.php?viewid=".$id."' data-layout='button_count' data-action='like' data-show-faces='false' data-share='true'></div>";
		$output .= "<div class='right'><a href='http://".$_SERVER['HTTP_HOST']."' class='border-none'>Vráti sa na index</a></div>";
	}
	else
	{
		$output = "<div class='text-center'><p>Zadal si chybné ID novinky pre zobrazenie alebo iná chyba v odkaze.</p></div>";
	}
?>
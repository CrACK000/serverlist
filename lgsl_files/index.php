<?php
//------------------------------------------------------------------------------------------------------------+
  header("Content-Type:text/html; charset=utf-8");
//------------------------------------------------------------------------------------------------------------+
?>

<meta http-equiv='Content-Type' content='text/html; charset=Windows-1250' />
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='sk' lang='sk'>
<head>
<title>status.Flactor.eu - DATAB&Aacute;ZA SERVEROV</title>
<meta http-equiv='Content-Type' content='text/html; charset=Windows-1250' />
<meta name='description' content='' />
<meta name='keywords' content='' />
<link rel='stylesheet' href='styles.css' type='text/css' media='screen' />
<link rel='shortcut icon' href='images/favicon.ico' type='image/x-icon' />
<script type='text/javascript' src='http://gamew.eu/java/menu.js'></script>
<script type='text/javascript' src='http://gamew.eu/java/menu2.js'></script>
</head>
<body>
<table cellpadding='0' cellspacing='0' width='1002' align='center'>
<tr>
<?php
$mysql_result[1] = mysql_result(mysql_query("SELECT COUNT(id) FROM `{$lgsl_config['db']['prefix']}{$lgsl_config['db']['table']}` WHERE `disabled`='1'"), 0);
echo "Zakazane: ".$mysql_result[1];
?>
<td class='full-header'>
<a href='/index'><img src='http://status.flactor.eu/logo.png' alt='' /></a></td>
<td class="banner" align="right"></a></td></tr>
</table>
<div class="menu" align="center">
      	  <ul>
          	<li><a href="http://status.flactor.eu">Zoznam serverov</a></li>
            <li><a href="http://status.flactor.eu/pravidla">Pravidla pre pridanie</a></li>
  			<li><a href="http://status.flactor.eu/?s=add">Pridat server</a></li>
  			<li><a href="http://status.flactor.eu/linkus">Podporte nas</a></li>
			<li><a href="http://status.flactor.eu/kontakt">Kontakt</a></li>
          </ul>
   </div><table cellpadding='0' cellspacing='0' width='1002' align='center' class='side-left'>
<tr>
<td class='side-border-left' valign='top'><table cellpadding='0' cellspacing='0' width='100%'>
<tr>

</tr>
</table>
<table cellpadding='0' cellspacing='0' width='100%' class='spacer'>
<tr>
<td class='side-body'>
<br />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

	<ul class="menusss">
		<li class=""><a href="#" id='nav4' class="aloha">COUNTER STRIKE 1.6</a>
			<ul>
				<li class="serverLink"><a href="http://listify.eu/servery?type=halflife&gamemode=aimawp" class='serverLink'>AIM / AWP</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=halflife&gamemode=basebuilder" class='serverLink'>Basebuilder</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=halflife&gamemode=callofduty" class='serverLink'>Call of duty</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=halflife&gamemode=deatmatch" class='serverLink'>Deathmatch</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=halflife&gamemode=gungame" class='serverLink'>Gungame</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=halflife&gamemode=warcraft3" class='serverLink'>Warcraft 3</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=halflife&gamemode=superhero" class='serverLink'>SuperHero</a></li>
			    <li class="serverLink"><a href="http://listify.eu/servery?type=halflife&gamemode=jump" class='serverLink'>Jump</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=halflife&gamemode=soccerjam" class='serverLink'>Soccer Jam</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=halflife&gamemode=zombie" class='serverLink'>Zombie</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=halflife&gamemode=paintball" class='serverLink'>Paintball</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=halflife&gamemode=hidenseek" class='serverLink'>Hide'n'seek</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=halflife&gamemode=deathrun" class='serverLink'>Deathrun</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=halflife&gamemode=predator" class='serverLink'>Predator</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=halflife&gamemode=classic" class='serverLink'>Classic</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=halflife&gamemode=jailbreak" class='serverLink'>Jailbreak</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=halflife&gamemode=fun" class='serverLink'>Fun</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=halflife&gamemode=furien" class='serverLink'>Furien</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=halflife&gamemode=cpt" class='serverLink'>Capture The Flag</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=halflife&gamemode=only" class='serverLink'>Only maps</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=halflife&gamemode=ine" class='serverLink'>In� kateg�ria</a></li>																						<li class="serverLink"><a href="#" class='serverLink'>Call of duty</a></li>
																													
			</ul>
		</li>

		<li class=""><a href="#" id='nav1'>COUNTER STRIKE SOURCE</a>
			<ul>
				<li class="serverLink"><a href="http://listify.eu/servery?type=source&gamemode=saimawp" class='serverLink'>AIM / AWP</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=source&gamemode=sbasebuilder" class='serverLink'>Basebuilder</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=source&gamemode=scallofduty" class='serverLink'>Call of duty</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=source&gamemode=sdeatmatch" class='serverLink'>Deathmatch</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=source&gamemode=sgungame" class='serverLink'>Gungame</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=source&gamemode=swarcraft3" class='serverLink'>Warcraft 3</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=source&gamemode=ssuperhero" class='serverLink'>SuperHero</a></li>
			    	<li class="serverLink"><a href="http://listify.eu/servery?type=source&gamemode=sjump" class='serverLink'>Jump</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=source&gamemode=ssoccerjam" class='serverLink'>Soccer Jam</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=source&gamemode=szombie" class='serverLink'>Zombie</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=source&gamemode=spaintball" class='serverLink'>Paintball</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=source&gamemode=shidenseek" class='serverLink'>Hide'n'seek</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=source&gamemode=sdeathrun" class='serverLink'>Deathrun</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=source&gamemode=spredator" class='serverLink'>Predator</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=source&gamemode=sclassic" class='serverLink'>Classic</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=source&gamemode=sjailbreak" class='serverLink'>Jailbreak</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=source&gamemode=sfun" class='serverLink'>Fun</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=source&gamemode=sfurien" class='serverLink'>Furien</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=source&gamemode=scpt" class='serverLink'>Capture The Flag</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=source&gamemode=sonly" class='serverLink'>Only maps</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=source&gamemode=sine" class='serverLink'>In� kateg�ria</a></li>																						<li class="serverLink"><a href="#" class='serverLink'>Call of duty</a></li>
																													
			</ul>
		</li>

		<li class=""><a href="#" id='nav3'>COUNTER STRIKE GLOBAL OFFENSIVE</a>
			<ul>
				<li class="serverLink"><a href="http://listify.eu/servery?type=csgo&gamemode=armsrace" class='serverLink'>Arms Race</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=csgo&gamemode=classic" class='serverLink'>Classic</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=csgo&gamemode=deatmatch" class='serverLink'>Deatmatch</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=csgo&gamemode=ine" class='serverLink'>In� kateg�ria</a></li>																						<li class="serverLink"><a href="#" class='serverLink'>Call of duty</a></li>
																													
			</ul>
		</li>


		<li class=""><a href="#" id='nav2'>MINECRAFT</a>
			<ul>
				<li class="serverLink"><a href="http://listify.eu/servery?type=minecraft&gamemode=mcsurvival" class='serverLink'>Survival</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=minecraft&gamemode=mccreative" class='serverLink'>Creative</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=minecraft&gamemode=mcminigames" class='serverLink'>Minigames</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=minecraft&gamemode=mcpvp" class='serverLink'>PVP</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=minecraft&gamemode=mcpvm" class='serverLink'>PVM</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=minecraft&gamemode=mcine" class='serverLink'>In� kateg�ria</a></li>
			</ul>
		</li>


		


		<li class=""><a href="#" id='nav5'>GTA SAN ANDREAS:MP</a>
			<ul>
				<li class="serverLink"><a href="http://listify.eu/servery?type=samp&gamemode=sarealnezivoty" class='serverLink'>Realne �ivoty</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=samp&gamemode=sadriftdragrace" class='serverLink'>Drift/Drag/Race</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=samp&gamemode=sadeathmatch" class='serverLink'>Deathmatch</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=samp&gamemode=saroleplay" class='serverLink'>Role play</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=samp&gamemode=sastunt" class='serverLink'>Stunt</a></li>
			</ul>
		</li>

		<li class=""><a href="#" id='nav6'>TEAM FORRTRES 2</a>
			<ul>
				<li class="serverLink"><a href="http://listify.eu/servery?type=tf2&gamemode=tfarena" class='serverLink'>Arena</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=tf2&gamemode=tfcpt" class='serverLink'>Capture The Flag</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=tf2&gamemode=tfcontrolpoint" class='serverLink'>Control Point</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=tf2&gamemode=tfdeathrun" class='serverLink'>Deathrun</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=tf2&gamemode=tfpublic" class='serverLink'>Public</a></li>
				<li class="serverLink"><a href="http://listify.eu/servery?type=tf2&gamemode=tfostatne" class='serverLink'>Ostatn�</a></li>

			</ul>
		</li>


	</ul>



<script type="text/javascript">
	$(function() {

	    var menusss_ul = $('.menusss > li > ul'),
	           menusss_a  = $('.menusss > li > a');
	    
	    menusss_ul.hide();
	
	    menusss_a.click(function(e) {
	        e.preventDefault();
	        if(!$(this).hasClass('active')) {
	            menusss_a.removeClass('active');
	            menusss_ul.filter(':visible').slideUp('normal');
	            $(this).addClass('active').next().stop(true,true).slideDown('normal');
	        } else {
	            $(this).removeClass('active');
	            $(this).next().stop(true,true).slideUp('normal');
	        }
	    });
	
	});
</script>

</td>
</tr>
<tr>
<td class='side-body-footer'></td>
</tr>
</table>
</td><td class='main-bg' valign='top'><noscript><div class='noscript-message admin-message'>Ale nie! Toto je <strong>JavaScript</strong>?<br>V� prehliada� nem� povolen� pou��vanie JavaScriptu, alebo JavaScript nie je podporovan�. Pros�m <strong>povolte JavaScript</strong> vo va�om prehliada�i aby sa spr�vne zobrazila t�to str�nka,<br> alebo <strong>obnovte</strong> v� prehliada� s podporou JavaScriptu; <a href='http://firefox.com' rel='nofollow' title='Mozilla Firefox'>Firefox</a>, <a href='http://apple.com/safari/' rel='nofollow' title='Safari'>Safari</a>, <a href='http://opera.com' rel='nofollow' title='Opera'>Opera</a>, <a href='http://www.google.com/chrome' rel='nofollow' title='Google Chrome'>Chrome</a> alebo nov�iu verziu <a href='http://www.microsoft.com/windows/internet-explorer/' rel='nofollow' title='Internet Explorer'>Internet Explorera</a>.</div>
</noscript>
<!--error_handler-->

                            <table cellpadding='0' cellspacing='0' width='100%'>
<tr>
<td class='capmain'>Servery</td>
</tr>
</table>
<table cellpadding='0' cellspacing='0' width='662' class='spacer'>
<tr>
<td class='main-body'>

<?php
//------------------------------------------------------------------------------------------------------------+
  global $output, $lgsl_server_id;

  $output = "";

  $s = isset($_GET['s']) ? $_GET['s'] : "";

  if     (is_numeric($s)) { $lgsl_server_id = $s; require "lgsl_files/lgsl_details"; }
  elseif ($s == "add")    {                       require "lgsl_files/lgsl_add";     }
  else                    {                       require "lgsl_files/lgsl_list";    }

  echo $output;

  unset($output);
//------------------------------------------------------------------------------------------------------------+
?>
<tr>
<td class='news-footer'></td>
</tr></table>
</td></tr>
</table>

</body>
</html>
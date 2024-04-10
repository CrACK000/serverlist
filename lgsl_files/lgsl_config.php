<?php

//------------------------------------------------------------------------------------------------------------+
//[ PREPARE CONFIG - DO NOT CHANGE OR MOVE THIS ]

  global $lgsl_config; $lgsl_config = array();

//------------------------------------------------------------------------------------------------------------+
//[ FEED: 0=OFF 1=CURL OR FSOCKOPEN 2=FSOCKOPEN ONLY / LEAVE THE URL ALONE UNLESS YOU KNOW WHAT YOUR DOING ]

  $lgsl_config['feed']['method'] = 0;
  $lgsl_config['feed']['url']    = "http://www.greycube.co.uk/lgsl/feed/lgsl_files/lgsl_feed";

//------------------------------------------------------------------------------------------------------------+
//[ BACKGROUND COLORS: TEXT HARD TO READ ? CHANGE THESE TO CONTRAST THE FONT COLOR / www.colorpicker.com ]

  $lgsl_config['background'][1] = "tbl4";
  $lgsl_config['background'][2] = "tbl5";

//------------------------------------------------------------------------------------------------------------+
//[ SHOW LOCATION FLAGS: 0=OFF 1=GEO-IP "GB"=MANUALLY SET COUNTRY CODE FOR SPEED ]

  $lgsl_config['locations'] = 1;

//------------------------------------------------------------------------------------------------------------+
//[ SHOW TOTAL SERVERS AND PLAYERS AT BOTTOM OF LIST: 0=OFF 1=ON ]

  $lgsl_config['list']['totals'] = 0;

//------------------------------------------------------------------------------------------------------------+
//[ SORTING OPTIONS ]

  $lgsl_config['sort']['servers'] = "id";   // OPTIONS: id  type  zone  players  status
  $lgsl_config['sort']['players'] = "name"; // OPTIONS: name  score

//------------------------------------------------------------------------------------------------------------+
//[ ZONE SIZING: HEIGHT OF PLAYER BOX DYNAMICALLY CHANGES WITH THE NUMBER OF PLAYERS ]

  $lgsl_config['zone']['width']     = "160"; // images will be cropped unless also resized to match
  $lgsl_config['zone']['line_size'] = "19";  // player box height is this number multiplied by player names
  $lgsl_config['zone']['height']    = "100"; // player box height limit

//------------------------------------------------------------------------------------------------------------+
//[ ZONE GRID: NUMBER=WIDTH OF GRID - INCREASE FOR HORIZONTAL ZONE STACKING ]

  $lgsl_config['grid'][1] = 1;
  $lgsl_config['grid'][2] = 1;
  $lgsl_config['grid'][3] = 1;
  $lgsl_config['grid'][4] = 1;
  $lgsl_config['grid'][5] = 1;
  $lgsl_config['grid'][6] = 1;
  $lgsl_config['grid'][7] = 1;
  $lgsl_config['grid'][8] = 1;

//------------------------------------------------------------------------------------------------------------+
//[ ZONE SHOWS PLAYER NAMES: 0=HIDE 1=SHOW ]

  $lgsl_config['players'][1] = 1;
  $lgsl_config['players'][2] = 1;
  $lgsl_config['players'][3] = 1;
  $lgsl_config['players'][4] = 1;
  $lgsl_config['players'][5] = 1;
  $lgsl_config['players'][6] = 1;
  $lgsl_config['players'][7] = 1;
  $lgsl_config['players'][8] = 1;

//------------------------------------------------------------------------------------------------------------+
//[ ZONE RANDOMISATION: NUMBER=MAX RANDOM SERVERS TO BE SHOWN ]

  $lgsl_config['random'][0] = 0;
  $lgsl_config['random'][1] = 0;
  $lgsl_config['random'][2] = 0;
  $lgsl_config['random'][3] = 0;
  $lgsl_config['random'][4] = 0;
  $lgsl_config['random'][5] = 0;
  $lgsl_config['random'][6] = 0;
  $lgsl_config['random'][7] = 0;
  $lgsl_config['random'][8] = 0;

//------------------------------------------------------------------------------------------------------------+
// [ HIDE OFFLINE SERVERS: 0=HIDE 1=SHOW

  $lgsl_config['hide_offline'][0] = 0;
  $lgsl_config['hide_offline'][1] = 0;
  $lgsl_config['hide_offline'][2] = 0;
  $lgsl_config['hide_offline'][3] = 0;
  $lgsl_config['hide_offline'][4] = 0;
  $lgsl_config['hide_offline'][5] = 0;
  $lgsl_config['hide_offline'][6] = 0;
  $lgsl_config['hide_offline'][7] = 0;
  $lgsl_config['hide_offline'][8] = 0;

//------------------------------------------------------------------------------------------------------------+
//[ TITLE ]

  $lgsl_config['title'][0] = "Flactor.eu ServerList";

//------------------------------------------------------------------------------------------------------------+
//[ LGSL ADMIN LOGON ]

//[ CrACK ]

  $lgsl_config['1914135']['6830469'] = "hoster12";

//------------------------------------------------------------------------------------------------------------+
//[ DATABASE SETTINGS: FOR STAND-ALONE OR TO OVERRIDE CMS DEFAULTS ]

  $lgsl_config['db']['server'] = "localhost";
  $lgsl_config['db']['user']   = "user";
  $lgsl_config['db']['pass']   = "";
  $lgsl_config['db']['db']     = "root";
  $lgsl_config['db']['table']  = "lgsl"; //tabulka do db pre servery
  $lgsl_config['db']['newstable']  = "news"; //tabulka do db pre novinky
  $lgsl_config['db']['settingstable']  = "settings"; //tabulka do db pre nastavenia
  $lgsl_config['db']['tickettable']  = "ticket"; //tabulka do db pre tikety

//------------------------------------------------------------------------------------------------------------+
//[ HOSTING FIXES ]

  $lgsl_config['direct_index'] = 0;  // 1=link to index instead of the folder
  $lgsl_config['no_realpath']  = 1;  // 1=do not use the realpath function
  $lgsl_config['url_path']     = "https://".$_SERVER['HTTP_HOST']."/lgsl_files/"; // full url to /lgsl_files/ for when auto detection fails

//------------------------------------------------------------------------------------------------------------+
//[ ADVANCED SETTINGS ]

  $lgsl_config['management']    = 0;         // 1=show advanced management in the admin by default
  $lgsl_config['host_to_ip']    = 0;         // 1=show the servers ip instead of its hostname
  $lgsl_config['public_add']    = 1;         // 1=servers require approval OR 2=servers shown instantly
  $lgsl_config['public_feed']   = 0;         // 1=feed requests can add new servers to your list
  $lgsl_config['cache_time']    = 60;        // seconds=time before a server needs updating
  $lgsl_config['live_time']     = 3;         // seconds=time allowed for updating servers per page load
  $lgsl_config['timeout']       = 0;         // 1=gives more time for servers to respond but adds loading delay
  $lgsl_config['retry_offline'] = 0;         // 1=repeats query when there is no response but adds loading delay
  $lgsl_config['cms']           = "sa";      // sets which CMS specific code to use

//------------------------------------------------------------------------------------------------------------+
//[ TRANSLATION ]

  $lgsl_config['text']['vsd'] = "Klikni pre zobrazenie detailov servera";
  $lgsl_config['text']['slk'] = "Pripoj sa k hre";
  $lgsl_config['text']['sts'] = "Status:";
  $lgsl_config['text']['adr'] = "IP Adresa:";
  $lgsl_config['text']['cpt'] = "Pripajaci Port:";
  $lgsl_config['text']['qpt'] = "Query Port:";
  $lgsl_config['text']['typ'] = "Vyber hru a m�d:";
  $lgsl_config['text']['gme'] = "Hra:";
  $lgsl_config['text']['web'] = "Webstr�nka:";
  $lgsl_config['text']['mail']= "V� E-Mail:";
  $lgsl_config['text']['mod'] = "M�d :";
  $lgsl_config['text']['map'] = "Mapa:";
  $lgsl_config['text']['plr'] = "Hr��i:";
  $lgsl_config['text']['npi'] = "�iadny hr��i";
  $lgsl_config['text']['nei'] = "�iadne extra info";
  $lgsl_config['text']['ehs'] = "Nastavenia";
  $lgsl_config['text']['ehv'] = "Hodnota";
  $lgsl_config['text']['onl'] = "Online";
  $lgsl_config['text']['color_onl'] = "<span class='label label-success'>Online</span>";
  $lgsl_config['text']['color_onp'] = "<span class='label label-warning'>Na Heslo</span>";
  $lgsl_config['text']['color_nrs'] = "<span class='label label-danger'>Offline</span>";
  
  
  $lgsl_config['text']['img_onl'] = "Online";
  $lgsl_config['text']['img_onp'] = "Na heslo";
  $lgsl_config['text']['img_nrs'] = "Offline";
  
  $lgsl_config['text']['onp'] = "Online s heslom";
  $lgsl_config['text']['nrs'] = "Offline";
  $lgsl_config['text']['pen'] = "Na��tavam �daje zo servera";
  $lgsl_config['text']['zpl'] = "Hr��i:";
  $lgsl_config['text']['mid'] = "Neplatn� server ID";
  $lgsl_config['text']['nnm'] = "--";
  $lgsl_config['text']['nmp'] = "--";
  $lgsl_config['text']['tns'] = "Serverov:";
  $lgsl_config['text']['tnp'] = "Hr��ov:";
  $lgsl_config['text']['tmp'] = "Max hr��ov:";
  $lgsl_config['text']['asd'] = "Prid�vanie serverov pre host� je pr�ve zak�zan�.";
  $lgsl_config['text']['awm'] = "Tvoj server nebude pridan� do datab�zy ak si nesplnil v�etk� PRAVIDL� pre pridanie servera.";
  $lgsl_config['text']['ats'] = "Odtestova�";
  $lgsl_config['text']['aaa'] = "<div class='alert alert-info' role='alert'><i class='glyphicon glyphicon-info-sign'></i> Server je u� pridan� ale �ak� na schv�lenie.</div>";
  $lgsl_config['text']['aan'] = "<div class='alert alert-danger' role='alert'><i class='glyphicon glyphicon-exclamation-sign'></i> Tento server je u� pridan�!</div>";
  $lgsl_config['text']['anr'] = "<div class='alert alert-danger' role='alert'><i class='glyphicon glyphicon-exclamation-sign'></i> �iadna odpove�, uisti sa �i si zadal �daje spr�vne.</div>";
  $lgsl_config['text']['ada'] = "<div class='alert alert-success' role='alert'><i class='glyphicon glyphicon-ok'></i> Server bol odoslan� k schv�leniu.</div>";
  $lgsl_config['text']['adn'] = "<div class='alert alert-success' role='alert'><i class='glyphicon glyphicon-ok'></i> Server bol �spe�ne pridan�.</div>";
  $lgsl_config['text']['asc'] = "<div class='alert alert-success' role='alert'><i class='glyphicon glyphicon-ok'></i> V�etko v poriadku, pokra�ujte pridan�m servera.</div>";
  $lgsl_config['text']['aas'] = "Prida� server";
  $lgsl_config['text']['loc'] = "Krajina:";

//------------------------------------------------------------------------------------------------------------+
?>
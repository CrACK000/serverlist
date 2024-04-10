<?php

require "lgsl_files/lgsl_class.php";

$settingQuery = $db->selectRow('SELECT * FROM '.$lgsl_config['db']['settingstable'].' WHERE settings_id = 1');

$title = $settingQuery['settings_title'];

echo '
<title>' . $title . '</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="pallax.systems, Patrik CrACK Fejfár & Filip 85filip58 Izak">
<meta name="description" content="Systém pre databázu serverov.">
<meta name="keywords" content="secure, bezpečnosť, flat, jednoduchosť, crack, system, systems, cms, na mieru, systemy">
<meta name="robots" content="index, nofollow">
<meta name="revisit-after" content="1 day">
<meta name="language" content="sk">
<meta name="generator" content="N/A">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="theme-color" content="#007bff">
<meta name="msapplication-navbutton-color" content="#007bff">
<meta name="msapplication-TileColor" content="#ffffff">
<link rel="icon" type="image/x-icon" href="' . URL . '/assets/img/favicon.png?v=157785080"/>
<link rel="stylesheet" href="' . URL . '/assets/css/normalize.css?v=157785080">
<link rel="stylesheet" href="' . URL . '/assets/css/bootstrap.min.css?v=157785080">
<link rel="stylesheet" href="' . URL . '/assets/css/styles.css?v=157785080">';
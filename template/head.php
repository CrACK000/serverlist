<?php

require "lgsl_files/lgsl_class.php";
lgsl_database();

$udrzba_query = mysql_query("SELECT * FROM `".$lgsl_config['db']['settingstable']."` WHERE `settings_id`='1'");
$data_udrzba = mysql_fetch_assoc( $udrzba_query );


if( !isset($_POST['lgsl_admin_login'] ) )
{
    if( $data_udrzba['settings_active'] == 1 && !isset($_COOKIE['lgsl_admin_auth']) )
    {
        header("Location: " . url_adress() . "/udrzba.php");
        exit;
    }
}

$page = $_GET['page'];

echo '
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-3">
  <a class="navbar-brand pr-3 my-font-logo" href="' . url_adress() . '/index.php">pallax.systems <span>serverlist</span></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link '.(basename($_SERVER['PHP_SELF']) == "index.php" ? "active" : "" ).'"         href="' . url_adress() . '/index.php">Zoznam serverov</a>
      <a class="nav-item nav-link '.(basename($_SERVER['PHP_SELF']) == "pridat.php" ? "active" : "" ).'"        href="' . url_adress() . '/pridat.php">Pridať server</a>
      <a class="nav-item nav-link '.(basename($_SERVER['PHP_SELF']) == "pravidla.php" ? "active" : "" ).'"      href="' . url_adress() . '/pravidla.php">Pravidlá</a>
      <a class="nav-item nav-link '.(basename($_SERVER['PHP_SELF']) == "kontakt.php" ? "active" : "" ).'"       href="' . url_adress() . '/kontakt.php">Kontakt</a>
      <a class="nav-item nav-link '.(basename($_SERVER['PHP_SELF']) == "tip.php" ? "active" : "" ).'"           href="' . url_adress() . '/tip.php">TIP/Box</a>
      <a class="nav-item nav-link '.(basename($_SERVER['PHP_SELF']) == "podporte_nas.php" ? "active" : "" ).'"  href="' . url_adress() . '/podporte_nas.php">Podporte nás</a>
    </div>
  </div>
</nav>';
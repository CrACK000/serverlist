<?php

require "lgsl_files/lgsl_class.php";

$settingQuery = $db->selectRow('SELECT * FROM '.$lgsl_config['db']['settingstable'].' WHERE settings_id = 1');

if ($settingQuery['settings_active'] == 1) {

    if ($auth->isLoggedIn()) {

        if (!$auth->hasRole(\Delight\Auth\Role::SUPER_MODERATOR)) {
            header("Location: " . URL . "/udrzba");
            exit;
        }

    } else {
        header("Location: " . URL . "/udrzba");
        exit;
    }

}

$page = $_GET['page'];

echo '
<div style="height: 66px;">
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark pl-special">
        <a class="navbar-brand pr-3 my-font-logo" href="' . URL . '/index">pallax.systems <span>serverlist</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link '.(basename($_SERVER['PHP_SELF']) == "index" ? "active" : "" ).'"         href="' . URL . '/index">Zoznam serverov</a>
            
                <a class="nav-item nav-link pl-menu-button px-3" href="' . URL . '/pridat"><i class="fas fa-plus mr-2" style="color: #968ffb"></i> <span style="color: #ffffff;">Pridať server</span></a>
            
            </div>
        </div>
    </nav>
</div>';
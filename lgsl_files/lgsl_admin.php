<?php

    if ($auth->isLoggedIn()) {

        if (!$auth->hasRole(\Delight\Auth\Role::SUPER_MODERATOR)) {
            header("Location: " . URL . "/index");
            exit;
        }

    } else {
        header("Location: " . URL . "/index");
        exit;
    }

	$lgsl_type_list     = lgsl_type_list(); asort($lgsl_type_list);
	$lgsl_protocol_list = lgsl_protocol_list();

	$id        = 0;
	$last_type = "source";
	$zone_list = lgsl_list_mods(); asort($zone_list);
	$output = "";

	//info
	$mysql_result[1] = mysql_result(mysql_query("SELECT COUNT(id) FROM `".$lgsl_config['db']['table']."` WHERE `disabled`='0'"), 0);
	$mysql_result[2] = mysql_result(mysql_query("SELECT COUNT(news_id) FROM `".$lgsl_config['db']['newstable']."`"), 0);
	$mysql_result[3] = mysql_result(mysql_query("SELECT COUNT(ticket_id) FROM `".$lgsl_config['db']['tickettable']."`"), 0);
	//END info

	if(!isset($_GET['page']) ) {
		$output .= '<div class="row">
                        <a class="col-md-3 js-tilt" href="' . URL . '/admin?page=servers">
                        
                            <div class="text-center icon">
                                <i class="fas fa-server fa-5x"></i>
                            </div>
                            <div class="text-center mt-2">
                                Administrácia serverov
                            </div>
                            <div class="text-center small mt-2 desc">
                                V databáze je 21 serverov a<br>
                                na chválenie čaká 1
                            </div>
                            
                        </a>
                        <a class="col-md-3 js-tilt" href="#">
                        
                            <div class="text-center icon">
                                <i class="fas fa-users fa-5x"></i>
                            </div>
                            <div class="text-center mt-2">
                                Správca užívateľov
                            </div>
                            <div class="text-center small mt-2 desc">
                                Je zaregistrovaných 241 užívateľov<br>
                                a zablokovaných je 5
                            </div>
                            
                        </a>
                        <a class="col-md-3 js-tilt" href="' . URL . '/admin?page=news">
                            
                            <div class="text-center icon">
                                <i class="fas fa-newspaper fa-5x"></i>
                            </div>
                            <div class="text-center mt-2">
                                Novinky
                            </div>
                            <div class="text-center small mt-2 desc">
                                8 napísaných noviniek<br>
                            </div>
                            
                        </a>
                        <a class="col-md-3 js-tilt" href="' . URL . '/admin?page=ticket">
                        
                            <div class="text-center icon">
                                <i class="fas fa-ticket-alt fa-5x"></i>
                            </div>
                            <div class="text-center mt-2">
                                Podpora / Tikety
                            </div>
                            <div class="text-center small mt-2 desc">
                                24 tiketov a<br>
                                5 nových
                            </div>
                        
                        </a>
                    </div>
                    <div class="row">
                        <a class="col-md-3 js-tilt" style="border-top: none" href="' . URL . '/admin?page=system">
                        
                            <div class="text-center icon">
                                <i class="fas fa-cogs fa-5x"></i>
                            </div>
                            <div class="text-center mt-2">
                                Nastavenia systému
                            </div>
                            <div class="text-center small mt-2 desc">
                                Mód údržby je zapnuty
                            </div>
                            
                        </a>
                        <a class="col-md-3 js-tilt" style="border-top: none" href="#">
                        
                            <div class="text-center icon">
                                <i class="fas fa-hashtag fa-5x"></i>
                            </div>
                            <div class="text-center mt-2">
                                Logy systému
                            </div>
                            
                        </a>
                    </div>';
		return;
	}

//---------------------------------------------------------------------------------------------------------------------+

    //NEWS

	require 'lgsl_admin/admin_news.php';

//---------------------------------------------------------------------------------------------------------------------+

    //USERS

    require 'lgsl_admin/admin_users.php';

//---------------------------------------------------------------------------------------------------------------------+

    //SERVERS

    require 'lgsl_admin/admin_servers.php';

//---------------------------------------------------------------------------------------------------------------------+

    //TICKETS

    require 'lgsl_admin/admin_tickets.php';

//---------------------------------------------------------------------------------------------------------------------+

    //SETTINGS

    require 'lgsl_admin/admin_settings.php';

//---------------------------------------------------------------------------------------------------------------------+

    //LOGS

    require 'lgsl_admin/admin_logs.php';

//---------------------------------------------------------------------------------------------------------------------+
<?php

 /*----------------------------------------------------------------------------------------------------------\
 |                                                                                                            |
 |                      [ LIVE GAME SERVER LIST ] [ � RICHARD PERRY FROM GREYCUBE.COM ]                       |
 |                                                                                                            |
 |    Released under the terms and conditions of the GNU General Public License Version 3 (http://gnu.org)    |
 |                                                                                                            |
 \-----------------------------------------------------------------------------------------------------------*/
//------------------------------------------------------------------------------------------------------------+

    $typ = str_replace(" ", "", preg_replace("/\s{3,}/", "", strtolower($_GET['type'])));
    $mod = str_replace(" ", "", preg_replace("/\s{3,}/", "", strtolower($_GET['mod'])));
    $server_list = lgsl_query_group(array( "type" => $typ, "zone" => $mod));

//------------------------------------------------------------------------------------------------------------+
	$items_per_page = "10";
	
	$mysql_where   = array("`disabled`=0");
    if ($typ != "") { $mysql_where[] = "`type`='{$typ}'"; }
    if ($mod != "") { $mysql_where[] = "`zone`='{$mod}'"; }
	
	$strankovanie = "?";
	if($typ) { $strankovanie .= "type=".$typ; }
	if($typ && $mod) { $strankovanie .= "&amp;"; }
	if($typ && !$mod) { $strankovanie .= "&amp;"; }
	
	if($mod) { $strankovanie .= "mod=".$mod; }
	if($typ && $mod) { $strankovanie .= "&amp;"; }
	if(!$typ && $mod) { $strankovanie .= "&amp;"; }
	
	$targetpage = "/".$strankovanie;

    $mysql_query[1] = $db->selectValue('SELECT COUNT(id) FROM '.$lgsl_config['db']['table'].' WHERE '.implode(" AND ", $mysql_where).' AND disabled = 0 LIMIT 0,'.$items_per_page);

    if($mysql_query[1] > 0) {

        $output .= '

        <table class="pl-table-server">
        
            <thead>
                
                <td class="text-left"   width="10%">hra</td>
                <td class="text-left"   width="30%">názov a ip adresa</td>
                <td class="text-left"   width="15%">mapa</td>
                <td class="text-center" width="15%">online hráči</td>
                <td class="text-right"  width="30%"><a href="#" style="color: #6576b1;"><i class="fas fa-sync mr-2" style="color: #a1b7ff"></i> obnoviť zoznam</a></td>
                
            </thead>
            
            <tbody>';

                foreach ($server_list as $server) {

                    $misc   = lgsl_server_misc($server);
                    $server = lgsl_server_html($server);

                    $servernew = ( time() >= ( $server['o']['date'] + ( 7 * 24 * 60 * 60 ) ) ? 0 : 1 );

                    if ($server['o']['new'] == 1) {
                        $badge = 'new';
                    }

                    if ($servernew == 1) {
                        $badge = 'new';
                    }

                    $showpercenta = (int)(($server['s']['players'] / $server['s']['playersmax']) * 100+.5);

                    if ($showpercenta == 0 ) { $playersDataPercent = 0;  }
                    if ($showpercenta >= 3 ) { $playersDataPercent = 10; }
                    if ($showpercenta >= 15) { $playersDataPercent = 20; }
                    if ($showpercenta >= 25) { $playersDataPercent = 30; }
                    if ($showpercenta >= 35) { $playersDataPercent = 40; }
                    if ($showpercenta >= 45) { $playersDataPercent = 50; }
                    if ($showpercenta >= 55) { $playersDataPercent = 60; }
                    if ($showpercenta >= 65) { $playersDataPercent = 70; }
                    if ($showpercenta >= 75) { $playersDataPercent = 80; }
                    if ($showpercenta >= 85) { $playersDataPercent = 90; }
                    if ($showpercenta >= 95) { $playersDataPercent = 100;}

                    $players = '
                    <div class="progress" data-percentage="' . $playersDataPercent . '">
                        <span class="progress-left">
                            <span class="progress-bar"></span>
                        </span>
                        <span class="progress-right">
                            <span class="progress-bar"></span>
                        </span>
                        <div class="progress-value">
                            ' . $server['s']['players'] . '
                        </div>
                    </div>';

                    $output .= '
                    <tr>
                        <td class="text-center"><div class="pl-icon-badge-game '.$badge.'"><img alt="' . $misc['text_type_game'] . '" src="' . $misc['icon_game'] . '" title="' . $misc['text_type_game'] . '" /></div></td>
                        <td class="text-left">'.($server['o']['tip'] == 1 ? '<i class="far fa-star gold-text" title="Odporúčame !!"></i> ' : '').'<span title="'.$misc['name_filtered'].'">' . ((strlen($misc['name_filtered']) >= 30) ? substr($misc['name_filtered'], 0, 30) . "..." : $misc['name_filtered']) . '</span><br><small>' . $server['b']['ip'] . ':' . $server['b']['c_port'] . '</small></td>
                        <td class="text-left px-1">' . $server['s']['map'] . '</td>
                        <td class="text-center px-1">' . $players . '</td>
                        <td class="text-right pl-0 pr-4">
                            <a href="' . $misc['software_link'] . '"><button type="button" class="pl-table-server-button mr-4"><i class="fas fa-gamepad icon"></i> pripojiť</button></a>
                            <a href="'.URL.'/detail?viewid='.$server['o']['id'].'"><button type="button" class="pl-table-server-button mr-4"><i class="fas fa-eye icon"></i> viac</button></a>
                            <a href="'.URL.'/"><button type="button" class="pl-table-server-button-user"><i class="fas fa-user"></i></button></a>
                        </td>
                    </tr>';

                }

            $output .= '
            </tbody>
            
        </table>';


	} else {
        $output .= "
        <div class='w-100 text-center py-5'>
            V zozname sa nenachádzajú žiadne servery.
        </div>";
	}

    $all_servers = $db->selectValue('SELECT COUNT(id) FROM '.$lgsl_config['db']['table'].' WHERE disabled = 0');
    $wait_servers = $db->selectValue('SELECT COUNT(id) FROM '.$lgsl_config['db']['table'].' WHERE disabled = 1');

    if ($all_servers == 1) {
        $servers_text = 'server';
    } elseif ($all_servers == 2) {
        $servers_text = 'servery';
    } elseif ($all_servers == 3) {
        $servers_text = 'servery';
    } elseif ($all_servers == 4) {
        $servers_text = 'servery';
    } elseif ($all_servers >= 5) {
        $servers_text = 'serverov';
    } elseif ($all_servers >= 0) {
        $servers_text = 'serverov';
    } elseif ($wait_servers == 1) {
        $wait_servers_text = 'server';
    } elseif ($wait_servers == 2) {
        $wait_servers_text = 'servery';
    } elseif ($wait_servers == 3) {
        $wait_servers_text = 'servery';
    } elseif ($wait_servers == 4) {
        $wait_servers_text = 'servery';
    } elseif ($wait_servers >= 5) {
        $wait_servers_text = 'serverov';
    } elseif ($wait_servers >= 0) {
        $wait_servers_text = 'serverov';
    }

    $output .= '
    <div class="pl-pagination col-11 mx-auto mt-4 text-center">
        <div class="row">
        
            <div class="col-md-3 text-left">
                V databáze je ' . $all_servers . ' ' . $servers_text . '
            </div>
            
            <div class="col-md-6 text-center">';

            if (isset($_GET['rowstart']) || !isset($_GET['rowstart']) && $all_servers > $items_per_page) {
                $output .= '<div class="text-center">' . makePageNav($_GET['rowstart'], $items_per_page, $all_servers, 2, $targetpage) . '</div>';
            }

            $output .= '
            </div>

            <div class="col-md-3 text-right">
                ' . $wait_servers . ' ' . $wait_servers_text . ' čaká na schválenie
            </div>
            
        </div>
    </div>';
//------------------------------------------------------------------------------------------------------------+


//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
//------ PLEASE MAKE A DONATION OR SIGN THE GUESTBOOK AT GREYCUBE.COM IF YOU REMOVE THIS CREDIT ----------------------------------------------------------------------------------------------------+
  //--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
?>
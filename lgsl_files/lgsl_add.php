<?php

 /*----------------------------------------------------------------------------------------------------------\
 |                                                                                                            |
 |                      [ LIVE GAME SERVER LIST ] [ � RICHARD PERRY FROM GREYCUBE.COM ]                       |
 |                                                                                                            |
 |    Released under the terms and conditions of the GNU General Public License Version 3 (http://gnu.org)    |
 |                                                                                                            |
 \-----------------------------------------------------------------------------------------------------------*/

//-----------------------------------------------------------------------------------------------------------+
//-----------------------------------------------------------------------------------------------------------+

    $lgsl_type_list = lgsl_type_list();
    unset($lgsl_type_list['test']);
    asort($lgsl_type_list);

    $lgsl_list_mods = lgsl_list_mods();

    $mody['halflife'] = lgsl_list_halflife();
    asort($mody['halflife']);

    $mody['csgo'] = lgsl_list_csgo();
    asort($mody['csgo']);

    $mody['source'] = lgsl_list_source();
    asort($mody['source']);

    $mody['minecraft'] = lgsl_list_minecraft();
    asort($mody['minecraft']);

    $mody['samp'] = lgsl_list_samp();
    asort($mody['samp']);

    $mody['ts3'] = lgsl_list_ts3();
    asort($mody['ts3']);

    $type   =    empty($_POST['form_type'])       ? "source"  :        trim($_POST['form_type']);
    $zone   =    empty($_POST['form_mod'])        ? "classic" :        trim($_POST['form_mod']);
    $ip     =    empty($_POST['form_ip'])         ? ""        :        trim($_POST['form_ip']);
    $c_port =    empty($_POST['form_c_port'])     ? 0         : intval(trim($_POST['form_c_port']));
    $q_port =    empty($_POST['form_q_port'])     ? 0         : intval(trim($_POST['form_q_port']));
    $webserver = empty($_POST['form_webserver'])  ? ""        :        trim($_POST['form_webserver']);

    if ($auth->isLoggedIn()) {

    $useremail = $auth->getEmail();

    } else {

    $useremail = empty($_POST['form_useremail']) ? "" : trim($_POST['form_useremail']);

    }

    $s_port = 0;

    if     (preg_match("/(\[[0-9a-z\:]+\])/iU", $ip, $match)) { $ip = $match[1]; }
    elseif (preg_match("/([0-9a-z\.\-]+)/i", $ip, $match))    { $ip = $match[1]; }
    else                                                              { $ip = ""; }

    if ($c_port > 99999 || $q_port < 1024) { $c_port = 0; }
    if ($q_port > 99999 || $q_port < 1024) { $q_port = 0; }

    list($c_port, $q_port, $s_port) = lgsl_port_conversion($type, $c_port, $q_port, $s_port);

//-----------------------------------------------------------------------------------------------------------+

    $output .= '<p class="form-text small pt-3">Viac informácií, alebo nejake rady a tipy si môžte prečítať na tejto stránke <a href="#">Rady a tipy</a>. Ak pridavate Minecraft, Counter Strike Global Offensive alebo Teamspeak 3 server odporúčame prečítať si ako nastaviť taký server aby fungovali údaje ktoré systém potrebuje.</p>';

    if (!isset($_POST['lgsl_submit_test']) && !isset($_POST['lgsl_submit_add'])) {

        $output .= '
        <form name="inputform" method="post" action="">
            
            <div class="form-group form-row mt-3">
            
                <div class="col-md-6">
                    <label for="t">Typ hry</label>
                    <select class="form-control" onchange="getval(this);" name="form_type" required="required" id="t">
                        <option value="" selected="selected" disabled="disabled">Vyberte typ hry</option>';
                        foreach ($lgsl_type_list as $key => $value) {
                            $output .= '<option value="' . $key . '">' . $value . '</option>';
                        }
                        $output .= '
                    </select>
                </div>
                
                <div class="col-md-6">
                    <label for="form_mod">Mód</label>                
                    <select class="form-control" name="form_mod" id="form_mod" required="required">
                        <option value="" selected="selected" disabled="disabled">Vyberte mód</option>
                    </select>
                </div>
                
            </div>
            
            <div class="form-group form-row">
                <div class="col-md-6">
                    <label for="ip">IP adresa</label>
                    <input type="text" class="form-control" name="form_ip" value="' . lgsl_string_html($ip) . '" required="required" id="ip" placeholder="120.0.0.1" required="required" >
                </div>
                <div class="col-md-3">
                    <label for="port">Pripojovací port</label>
                    <input type="text" class="form-control" name="form_c_port" value="' . ($c_port == 0 ? "" : lgsl_string_html($c_port)) . '" required="required" id="port" placeholder="27056" required="required" >
                </div>
                <div class="col-md-3">
                    <label for="qport">Query port</label>
                    <input type="text" class="form-control" name="form_q_port" value="' . ($q_port == 0 ? "" : lgsl_string_html($q_port)) . '" required="required" id="qport" placeholder="10011">
                </div>
            </div>
            
            <div class="form-group form-row">
            
                <div class="col-md-6">
                    <label for="web">Webová stránka serveru</label>
                    <input type="url" class="form-control" name="form_webserver" value="' . lgsl_string_html($webserver) . '" required="required" id="web" placeholder="http://example.com" required="required" >
                    <small id="web" class="form-text">Na vašej webovej stránke musíte mať našu ikonku ktorú nájdete tu <a href="'.URL.'/podporte_nas">Podporte nás</a> .</small>
                </div>';

                if (!$auth->isLoggedIn()) {

                    $output .= '
                    <div class="col-md-6">
                        <label for="email">Váš E-Mail</label>
                        <input type="email" class="form-control" name="form_useremail" value="' . lgsl_string_html($useremail) . '" required="required" id="email" placeholder="example@email.com" required="required" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}">
                        <small id="web" class="form-text">Ak pridáte server bez toho že by ste boli prihlásený, stačí ak sa zaregistrujete pod emailom aky ste zadali pri pridavaní servera, a server vám bude automaticky pridaný do právomoci.</small>
                    </div>';

                }

                $output .= '
            </div>
                
            <div class="form-group text-right">
                <button type="submit" class="button" name="lgsl_submit_test"><i class="fas fa-file-alt mr-3"></i> Otestovať</button>
            </div>
            
        </form>';
    }

//-----------------------------------------------------------------------------------------------------------+

    if (empty(isset($_POST['lgsl_submit_test'])) && empty(isset($_POST['lgsl_submit_add']))) { return; }
    if (!isset($lgsl_type_list[$type]) || !isset($lgsl_list_mods[$zone]) || !$ip || !$c_port || !$q_port || !$webserver || !$useremail)        { return; }

//-----------------------------------------------------------------------------------------------------------+

    $ip         = ($ip);
    $q_port     = ($q_port);
    $c_port     = ($c_port);
    $s_port     = ($s_port);
    $type       = ($type);
    $zone       = ($zone);
    $webserver  = ($webserver);
    $useremail  = ($useremail);

//-----------------------------------------------------------------------------------------------------------+

  
    $ip_check     = gethostbyname($ip);
    $mysql_result = $db->select('SELECT ip, disabled FROM '.$lgsl_config['db']['table'].' WHERE type = "'.$type.'" AND c_port = "'.$c_port.'"');

    foreach ($mysql_result as $mysql_row) {

        if ($ip_check == gethostbyname($mysql_row['ip'])) {

            if ($mysql_row['disabled']) {
                $output .= '<div class="alert alert-pl" role="alert">Server je sa nachádza v databáze, leže čaká na schválenie.</div>';
                header('Refresh:2; url='.URL.'/pridat');
            } else {
                $output .= '<div class="alert alert-pl" role="alert">Tento server sa už nachádza v databázi.</div>';
                header('Refresh:2; url='.URL.'/pridat');
            }

            return;

        }

    }

//-----------------------------------------------------------------------------------------------------------+

    $server = lgsl_query_live($type, $ip, $c_port, $q_port, $s_port, "s");
    $server = lgsl_server_html($server);
    $misc   = lgsl_server_misc($server);

    if (!$server['b']['status']) {

        $output .= '<div class="alert alert-pl" role="alert">
                        Žiadna odpoved zo servera, uistite sa či ste zadali všetky údaje správne.
                    </div>';

        header('Refresh:4; url='.URL.'/pridat');

        return;

    }

//-----------------------------------------------------------------------------------------------------------+

    if (!empty(isset($_POST['lgsl_submit_add']))) {

        if ($auth->isLoggedIn()) {

            $db->insert(
                $lgsl_config['db']['table'],
                [
                    'type' => $type,
                    'ip' => $ip,
                    'c_port' => $c_port,
                    'q_port' => $q_port,
                    's_port' => $s_port,
                    'zone' => $zone,
                    'disabled' => 0,
                    'tip' => 0,
                    'new' => 0,
                    'box' => 0,
                    'webserver' => $webserver,
                    'useremail' => $useremail,
                    'owner' => $auth->getUserId(),
                    'cache' => '',
                    'cache_time' => '',
                    'date' => time()
                ]
            );

        } else {

            $db->insert(
                $lgsl_config['db']['table'],
                [
                    'type' => $type,
                    'ip' => $ip,
                    'c_port' => $c_port,
                    'q_port' => $q_port,
                    's_port' => $s_port,
                    'zone' => $zone,
                    'disabled' => 1,
                    'tip' => 0,
                    'new' => 0,
                    'box' => 0,
                    'webserver' => $webserver,
                    'useremail' => $useremail,
                    'owner' => 0,
                    'cache' => '',
                    'cache_time' => '',
                    'date' => time()
                ]
            );

        }

        $db->insert(
            'stats_online_player',
            [
                '00' => 0
            ]
        );

        if (!$auth->isLoggedIn()) {

            $output .= '<div class="alert alert-pl" role="alert">
                            Server bol úspešne odoslaný k schváleniu.
                        </div>';

            header('Refresh:3; url='.URL.'/pridat');

        } else {

            $output .= '<div class="alert alert-pl" role="alert">
                            Server bol úspešne pridaný.
                        </div>';

            header('Refresh:3; url='.URL.'/pridat');

        }

        return;

    }

//-----------------------------------------------------------------------------------------------------------+

	$output .= '
    
    <div class="alert alert-pl" role="alert">
        Server je funkčný, môžete ďalej pokračovať a pridať server do zoznamu.
    </div>
    
    <form method="post" action="">
    
        <input type="hidden" name="form_type"       value="'.lgsl_string_html($type).'"       />
        <input type="hidden" name="form_mod"        value="'.lgsl_string_html($zone).'"       />
        <input type="hidden" name="form_ip"         value="'.lgsl_string_html($ip).'"         />
        <input type="hidden" name="form_c_port"     value="'.lgsl_string_html($c_port).'"     />
        <input type="hidden" name="form_q_port"     value="'.lgsl_string_html($q_port).'"     />
        <input type="hidden" name="form_webserver"  value="'.lgsl_string_html($webserver).'"  />
        <input type="hidden" name="form_useremail"  value="'.lgsl_string_html($useremail).'"  />
      
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col" colspan="2">' . $server['s']['name'] . ' <small>( ' . $server['s']['players'] . ' / ' . $server['s']['playersmax'] . ' )</small> <span class="float-right">'.lgsl_string_html($ip).':'.lgsl_string_html($c_port).'</span></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-right"><strong>Hra</strong>:</td>
                    <td class="text-left"><img alt="' . $misc['text_type_game'] . '" src="' . $misc['icon_game'] . '" title="' . $misc['text_type_game'] . '" class="align-middle mr-1" /> <span class="align-middle">' . $lgsl_type_list[lgsl_string_html($type)] . '</span></td>
                </tr>
                <tr>
                    <td class="text-right"><strong>Mód servera</strong>:</td>
                    <td class="text-left">' . $lgsl_list_mods[lgsl_string_html($zone)] . '</td>
                </tr>
                <tr>
                    <td class="text-right"><strong>Mapa</strong>:</td>
                    <td class="text-left">' . $server['s']['map'] . '</td>
                </tr>
                <tr>
                    <td class="text-right"><strong>Webová stránka serveru</strong>:</td>
                    <td class="text-left"><a target="_blank" href="' . lgsl_string_html($webserver) . '">' . lgsl_string_html($webserver) . '</a></td>
                </tr>
                <tr>
                    <td class="text-right"><strong>Váš email</strong>:</td>
                    <td class="text-left">' . lgsl_string_html($useremail) . '</td>
                </tr>
                <tr>
                    <td colspan="2" class="text-right">
                        <button type="submit" class="button" name="lgsl_submit_add"><i class="fas fa-plug mr-3"></i> Pridať server</button>
                    </td>
                </tr>
            </tbody>
        </table>
        
    </form>';

//------------------------------------------------------------------------------------------------------------+
?>
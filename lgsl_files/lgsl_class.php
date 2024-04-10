<?php

 /*----------------------------------------------------------------------------------------------------------\
 |                                                                                                            |
 |                      [ LIVE GAME SERVER LIST ] [ RICHARD PERRY FROM GREYCUBE.COM ]                       |
 |                                                                                                            |
 |    Released under the terms and conditions of the GNU General Public License Version 3 (http://gnu.org)    |
 |                                                                                                            |
 \-----------------------------------------------------------------------------------------------------------*/

//------------------------------------------------------------------------------------------------------------+

    use Delight\Auth\Auth;
    use Delight\Db\PdoDatabase;
    use Delight\Db\PdoDsn;

    $hst    = 'mysql:host=mariadb101.websupport.sk;port=3312;dbname=q3zh6ecx;charset=utf8mb4';
    $usr    = 'q3zh6ecx';
    $pwd    = 'JmdHVAfBYD';

    $db     = PdoDatabase::fromDsn(new PdoDsn($hst, $usr, $pwd));

    $auth   = new Auth($db);

//------------------------------------------------------------------------------------------------------------+

if (!function_exists('lgsl_url_path')) { // START OF DOUBLE LOAD PROTECTION

//------------------------------------------------------------------------------------------------------------+

    function auto_copyright($year = 'auto'){

        if(intval($year) == 'auto'){ $year = date('Y'); }
        if(intval($year) == date('Y')){ $date = intval($year); }
        if(intval($year) < date('Y')){ $date = intval($year) . ' - ' . date('Y'); }
        if(intval($year) > date('Y')){ $date = date('Y'); }

        return $date;

    }

//------------------------------------------------------------------------------------------------------------+

    $url = 'https://serverlist.pallax.systems';
    define('URL',$url);

//------------------------------------------------------------------------------------------------------------+

    function htmlcode($text) {

        $search = array(
            '<',
            '>',
            '=',
            "'"
        );

        $replace = array(
            '&#60;',
            '&#62;',
            '&#61;',
            '&#39;'
        );

        $htmlcode = str_replace($search, $replace, $text);

        return $htmlcode;

    }

//------------------------------------------------------------------------------------------------------------+

    function makepagenav($start, $count, $total, $range = 0, $link = "", $getname = "rowstart") {

        if ($link == "") { $link = FUSION_SELF."?"; }
        if (!preg_match("#[0-9]+#", $count) || $count == 0) return false;

        $pg_cnt = ceil($total / $count);
        if ($pg_cnt <= 1) { return ""; }

        $idx_back = $start - $count;
        $idx_next = $start + $count;
        $cur_page = ceil(($start + 1) / $count);

        if ($idx_back >= 0) {

            if ($cur_page > ($range + 1)) {

                $res .= "<li><a href='".$link.$getname."=0'>1</a></li>";

                if ($cur_page != ($range + 2)) {

                    $res .= "<li><a>...</a></li>";

                }

            }

        }

        $idx_fst = max($cur_page - $range, 1);
        $idx_lst = min($cur_page + $range, $pg_cnt);

        if ($range == 0) {

            $idx_fst = 1;
            $idx_lst = $pg_cnt;

        }

        for ($i = $idx_fst; $i <= $idx_lst; $i++) {

            $offset_page = ($i - 1) * $count;

            if ($i == $cur_page) {

                $res .= "<li class='page-item active'><span class=\"page-link\">".$i."</span></a></li>";

            } else {

                $res .= "<li class='page-item'><a class='page-link' href='".$link.$getname."=".$offset_page."'>".$i."</a></li>";

            }

        }

        if ($idx_next < $total) {

            if ($cur_page < ($pg_cnt - $range)) {

                if ($cur_page != ($pg_cnt - $range - 1)) {

                    $res .= "<li><a>...</a></li>";

                }

                $res .= "<li class='page-item'><a class='page-link' href='".$link.$getname."=".($pg_cnt - 1) * $count."'>".$pg_cnt."</a></li>\n";

            }

        }

        if (isset($_GET['rowstart'])) {

            if ($_GET['rowstart'] == ($idx_lst-1)) {

                $left = "<li class='page-item'><a class='page-link' href=\"".$link."rowstart=".ceil($_GET['rowstart']-$count)."\"><span aria-hidden='true'><i class='fas fa-chevron-left small'></i></span></a></li>";
                $right = "<li class='page-item disabled'><a class='page-link' href='#'><span aria-hidden='true'><i class='fas fa-chevron-right small'></i></span></a></li>";

            }

            elseif ($_GET['rowstart'] != 0) {

                $left = "<li class='page-item'><a class='page-link' href=\"".$link."rowstart=".ceil($_GET['rowstart']-$count)."\"><span aria-hidden='true'><i class='fas fa-chevron-left small'></i></span></a></li>";

                if($offset_page != $_GET['rowstart']) {

                    $right = "<li class='page-item'><a class='page-link' href=\"" . $link . "rowstart=" . ($_GET['rowstart'] + $count) . "\"><span aria-hidden='true'><i class='fas fa-chevron-right small'></i></span></a></li>";

                } else {

                    $right = "<li class='page-item disabled'><a class='page-link' href='#'><span aria-hidden='true'><i class='fas fa-chevron-right'></i></span></a></li>";

                }

            } else {

                $left = "<li class='page-item disabled'><a class='page-link' href='#'><span aria-hidden='true'><i class='fas fa-chevron-left'></i></span></a></li>";
                $right = "<li class='page-item'><a class='page-link' href=\"".$link."rowstart=".($_GET['rowstart']+$count)."\"><span aria-hidden='true'><i class='fas fa-chevron-right small'></i></span></a></li>";

            }

        } else {

            $left = "<li class='page-item'><a class='page-link' href=\"".BASEDIR."\"><span aria-hidden='true'><i class='fas fa-chevron-left'></i></span></a></li>";
            $right = "<li class='page-item'><a class='page-link' href=\"".$link."rowstart=".$count."\"><span aria-hidden='true'><i class='fas fa-chevron-right'></i></span></a></li>";

        }

        return "<nav>
                    <ul class='pagination pagination-sm justify-content-center m-0 p-0'>
                        ".$left.$res.$right."
                    </ul>
                </nav>";

    }

//------------------------------------------------------------------------------------------------------------+

    function lgsl_log($file = "", $type = "a", $log = ""){

        $log_file = fopen($file, $type);
        fputs($log_file, Date("d.m.Y H:i:s", time())." - ".$log."\n");
        fclose($log_file);

    }

//------------------------------------------------------------------------------------------------------------+
	
    function checkRemoteFile($url) {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        if(curl_exec($ch)!==FALSE) {

            return true;

        } else {

            return false;

        }

    }

//------------------------------------------------------------------------------------------------------------+
	
    function lgsl_bg($rotation_overide = "no") {

        global $lgsl_config;
        global $lgsl_bg_rotate;

        if ($rotation_overide !== "no") {

            $lgsl_bg_rotate = $rotation_overide ? TRUE : FALSE;

        } else {

            $lgsl_bg_rotate = $lgsl_bg_rotate ? FALSE : TRUE;

        }

        $background = $lgsl_bg_rotate ? $lgsl_config['background'][1] : $lgsl_config['background'][2];

        return $background;

    }

//------------------------------------------------------------------------------------------------------------+

    function lgsl_link($s = "") {

        $link = $s ? "/detail?viewid={$s}" : "/";

        return $link;

    }

//------------------------------------------------------------------------------------------------------------+

    function lgsl_query_cached($type, $ip, $c_port, $q_port, $s_port, $request, $id = NULL) {

        global $lgsl_config, $db;

        if ($id != NULL) {

            $id           = intval($id);

            $mysql_row = $db->selectRow(
                'SELECT * FROM '.$lgsl_config['db']['table'].' WHERE id = ? LIMIT 1',
                [ $id ]
            );

            if (!$mysql_row) { return FALSE; }

            list($type, $ip, $c_port, $q_port, $s_port) = array($mysql_row['type'], $mysql_row['ip'], $mysql_row['c_port'], $mysql_row['q_port'], $mysql_row['s_port']);

        } else {

            list($type, $ip, $c_port, $q_port, $s_port) = array($type, $ip, intval($c_port), intval($q_port), intval($s_port));

            if (!$type || !$ip || !$c_port || !$q_port) { exit("LGSL PROBLEM: INVALID SERVER '{$type} : {$ip} : {$c_port} : {$q_port} : {$s_port}'"); }

            $mysql_row = $db->selectRow('SELECT * FROM '.$lgsl_config['db']['table'].' WHERE type = ? AND ip = ? AND q_port = ? LIMIT 1',
                [
                    $type,
                    $ip,
                    $q_port
                ]
            );

            if (!$mysql_row) {

                if (strpos($request, "a") === FALSE) { exit("LGSL PROBLEM: SERVER NOT IN DATABASE '{$type} : {$ip} : {$c_port} : {$q_port} : {$s_port}'"); }

                $db->insert(
                    $lgsl_config['db']['table'],
                    [
                        // set
                        'type'       => $type,
                        'ip'         => $ip,
                        'c_port'     => $c_port,
                        'q_port'     => $q_port,
                        's_port'     => $s_port,
                        'cache'      => '',
                        'cache_time' => ''
                    ]
                );

                $mysql_row    = array("id" => $db->getLastInsertId(), "zone" => "0", "comment" => "");

            }

        }

        // UNPACK CACHE AND CACHE TIMES

        $cache      = empty($mysql_row['cache'])      ? array()      : unserialize(base64_decode($mysql_row['cache']));
        $cache_time = empty($mysql_row['cache_time']) ? array(0,0,0) : explode("_", $mysql_row['cache_time']);

        // SET THE SERVER AS OFFLINE AND PENDING WHEN THERE IS NO CACHE

        if (empty($cache['b']) || !is_array($cache)) {

            $cache      = array();
            $cache['b'] = array();
            $cache['b']['status']  = 0;
            $cache['b']['pending'] = 1;

        }

        // CONVERT HOSTNAME TO IP WHEN NEEDED

        if ($lgsl_config['host_to_ip']) {

            $ip = gethostbyname($ip);

        }

        // UPDATE CACHE WITH FIXED VALUES

        $cache['b']['type']    = $type;
        $cache['b']['ip']      = $ip;
        $cache['b']['c_port']  = $c_port;
        $cache['b']['q_port']  = $q_port;
        $cache['b']['s_port']  = $s_port;
        $cache['o']['request'] = $request;
        $cache['o']['id']      = $mysql_row['id'];
        $cache['o']['zone']    = $mysql_row['zone'];
        $cache['o']['comment'] = $mysql_row['comment'];
        $cache['o']['webserver'] = $mysql_row['webserver'];
        $cache['o']['useremail'] = $mysql_row['useremail'];
        $cache['o']['tip'] = $mysql_row['tip'];
        $cache['o']['new'] = $mysql_row['new'];
        $cache['o']['date'] = $mysql_row['date'];

        // UPDATE CACHE WITH LOCATION

        if (empty($cache['o']['location'])) {

            $cache['o']['location'] = $lgsl_config['locations'] ? lgsl_query_location($ip) : "";

        }

        // UPDATE CACHE WITH DEFAULT OFFLINE VALUES

        if (!isset($cache['s'])) {

            $cache['s']               = array();
            $cache['s']['game']       = $type;
            $cache['s']['name']       = $lgsl_config['text']['nnm'];
            $cache['s']['map']        = $lgsl_config['text']['nmp'];
            $cache['s']['players']    = 0;
            $cache['s']['playersmax'] = 0;
            $cache['s']['password']   = 0;

        }

        if (!isset($cache['e'])) { $cache['e'] = array(); }
        if (!isset($cache['p'])) { $cache['p'] = array(); }

        // CHECK AND GET THE NEEDED DATA

        $needed = "";

        // CACHE ONLY REQUEST

        if (strpos($request, "c") === FALSE) {

            if (strpos($request, "s") !== FALSE && time() > ($cache_time[0]+$lgsl_config['cache_time'])) { $needed .= "s"; }
            if (strpos($request, "e") !== FALSE && time() > ($cache_time[1]+$lgsl_config['cache_time'])) { $needed .= "e"; }
            if (strpos($request, "p") !== FALSE && time() > ($cache_time[2]+$lgsl_config['cache_time'])) { $needed .= "p"; }

        }

        if ($needed) {

            // UPDATE CACHE TIMES BEFORE QUERY - PREVENTS OTHER INSTANCES FROM QUERY FLOODING THE SAME SERVER

            $packed_times = time() + $lgsl_config['cache_time'] + 10;
            $packed_times = "{$packed_times}_{$packed_times}_{$packed_times}";

            $db->update(
                $lgsl_config['db']['table'],
                [
                    'cache_time' => $packed_times
                ],
                [
                    'id'         => $mysql_row['id']
                ]
            );

            // GET WHAT IS NEEDED

            $live = lgsl_query_live($type, $ip, $c_port, $q_port, $s_port, $needed);

            if (!$live['b']['status'] && $lgsl_config['retry_offline'] && !$lgsl_config['feed']['method']) {

                $live = lgsl_query_live($type, $ip, $c_port, $q_port, $s_port, $needed);

            }

            // CHECK AND CONVERT TO UTF-8 WHERE NEEDED

            $live = lgsl_charset_convert($live, lgsl_charset_detect($live));

            // IF SERVER IS OFFLINE PRESERVE SOME OF THE CACHE AND CLEAR THE REST

            if (!$live['b']['status']) {

                $live['s']['game']       = $cache['s']['game'];
                $live['s']['name']       = $cache['s']['name'];
                $live['s']['map']        = $cache['s']['map'];
                $live['s']['password']   = $cache['s']['password'];
                $live['s']['players']    = 0;
                $live['s']['playersmax'] = $cache['s']['playersmax'];
                $live['e']               = array();
                $live['p']               = array();

            }

            // MERGE LIVE INTO CACHE

            if (isset($live['b'])) { $cache['b'] = $live['b']; $cache['b']['pending'] = 0; }
            if (isset($live['s'])) { $cache['s'] = $live['s']; $cache_time[0] = time(); }
            if (isset($live['e'])) { $cache['e'] = $live['e']; $cache_time[1] = time(); }
            if (isset($live['p'])) { $cache['p'] = $live['p']; $cache_time[2] = time(); }

            // UPDATE CACHE

            $packed_cache = base64_encode(serialize($cache));
            $packed_times = implode("_", $cache_time);

            $db->update(
                $lgsl_config['db']['table'],
                [
                    'status'     => $cache['b']['status'],
                    'cache'      => $packed_cache,
                    'cache_time' => $packed_times
                ],
                [
                    'id'         => $mysql_row['id']
                ]
            );

        }

        // RETURN ONLY THE REQUESTED

        if (strpos($request, "s") === FALSE) { unset($cache['s']); }
        if (strpos($request, "e") === FALSE) { unset($cache['e']); }
        if (strpos($request, "p") === FALSE) { unset($cache['p']); }

        return $cache;

    }

//------------------------------------------------------------------------------------------------------------+
//EXAMPLE USAGE: lgsl_query_group( array("request"=>"sep", "hide_offline"=>0, "random"=>0, "type"=>"source", "game"=>"cstrike") )

    function lgsl_query_group($options = array(), $userid) {

        if (!is_array($options)) { exit("LGSL PROBLEM: lgsl_query_group OPTIONS MUST BE ARRAY"); }

        global $lgsl_config, $db;

        $request      = isset($options['request'])      ? $options['request']              : "s";
        $hide_offline = isset($options['hide_offline']) ? intval($options['hide_offline']) : intval($lgsl_config['hide_offline'][$zone]);
        $random       = isset($options['random'])       ? intval($options['random'])       : intval($lgsl_config['random'][$zone]);
        $type         = empty($options['type'])         ? ""                               : preg_replace("/[^a-z0-9_]/", "_", strtolower($options['type']));
        $zone         = empty($options['zone'])         ? ""                               : preg_replace("/[^a-z0-9_]/", "_", strtolower($options['zone']));
        $mysql_order  = empty($random)                  ? "`cache_time` ASC"               : "rand()";
        $server_limit = empty($random)                  ? 0                                : $random;

        $mysql_where   = array("`disabled`=0");

        if ($type != "") { $mysql_where[] = "`type`='{$type}'"; }
        if ($zone != "") { $mysql_where[] = "`zone`='{$zone}'"; }


        if ($_SERVER['SCRIPT_NAME'] == '/udrzba'){

            $items_per_page = "5";

        } else {

            $items_per_page = "10";

        }

        if ($userid){

            $queryUseridServers = ' AND owner=' . $userid;

        }

        if (!isset($_GET['rowstart']) || !is_numeric($_GET['rowstart'])) { $_GET['rowstart'] = 0; }

        $mysql_result = $db->select('SELECT * FROM '.$lgsl_config['db']['table'].' WHERE ' . implode(" AND ", $mysql_where) . $queryUseridServers .' ORDER BY new+tip DESC, tip DESC, id DESC LIMIT '.$_GET['rowstart'].', '.$items_per_page);

        $server_list  = array();

        foreach ($mysql_result as $mysql_row) {

            if (strpos($request, "c") === FALSE && lgsl_timer("check")) { $request .= "c"; }

            $server = lgsl_query_cached("", "", "", "", "", $request, $mysql_row['id']);

            if ($hide_offline && empty($server['b']['status'])) { continue; }
            if ($game && $game != preg_replace("/[^a-z0-9_]/", "_", strtolower($server['s']['game']))) { continue; }

            $server_list[] = $server;

            if ($server_limit && count($server_list) >= $server_limit) { break; }

        }

        return $server_list;

    }

    function lgsl_query_group_api_server($queryID) {

        global $lgsl_config, $db;

        $request      = isset($options['request'])      ? $options['request']              : "s";
        $hide_offline = isset($options['hide_offline']) ? intval($options['hide_offline']) : intval($lgsl_config['hide_offline'][$zone]);
        $random       = isset($options['random'])       ? intval($options['random'])       : intval($lgsl_config['random'][$zone]);
        $type         = empty($options['type'])         ? ""                               : preg_replace("/[^a-z0-9_]/", "_", strtolower($options['type']));
        $zone         = empty($options['zone'])         ? ""                               : preg_replace("/[^a-z0-9_]/", "_", strtolower($options['zone']));
        $server_limit = empty($random)                  ? 0                                : $random;

        $mysql_where  = array("`disabled`=0");

        if ($type != "") { $mysql_where[] = "`type`='{$type}'"; }
        if ($zone != "") { $mysql_where[] = "`zone`='{$zone}'"; }

        if (!isset($_GET['rowstart']) || !is_numeric($_GET['rowstart'])) { $_GET['rowstart'] = 0; }

        $mysql_result = $db->select('SELECT * FROM '.$lgsl_config['db']['table'].' WHERE id="'.$queryID.'"');

        $server_list  = array();

        foreach ($mysql_result as $mysql_row) {

            if (strpos($request, "c") === FALSE && lgsl_timer("check")) { $request .= "c"; }

            $server = lgsl_query_cached("", "", "", "", "", $request, $mysql_row['id']);

            if ($hide_offline && empty($server['b']['status'])) { continue; }
            if ($game && $game != preg_replace("/[^a-z0-9_]/", "_", strtolower($server['s']['game']))) { continue; }

            $server_list[] = $server;

            if ($server_limit && count($server_list) >= $server_limit) { break; }

        }

        return $server_list;

    }

    function lgsl_query_group_api_user($queryID) {

        global $lgsl_config, $db;

        $request      = isset($options['request'])      ? $options['request']              : "s";
        $hide_offline = isset($options['hide_offline']) ? intval($options['hide_offline']) : intval($lgsl_config['hide_offline'][$zone]);
        $random       = isset($options['random'])       ? intval($options['random'])       : intval($lgsl_config['random'][$zone]);
        $server_limit = empty($random)                  ? 0                                : $random;

        if (!isset($_GET['rowstart']) || !is_numeric($_GET['rowstart'])) { $_GET['rowstart'] = 0; }

        $mysql_result = $db->select('SELECT * FROM '.$lgsl_config['db']['table'].' WHERE owner = '.$queryID);

        $server_list  = array();

        foreach ($mysql_result as $mysql_row) {

            if (strpos($request, "c") === FALSE && lgsl_timer("check")) { $request .= "c"; }

            $server = lgsl_query_cached("", "", "", "", "", $request, $mysql_row['id']);

            if ($hide_offline && empty($server['b']['status'])) { continue; }
            if ($game && $game != preg_replace("/[^a-z0-9_]/", "_", strtolower($server['s']['game']))) { continue; }

            $server_list[] = $server;

            if ($server_limit && count($server_list) >= $server_limit) { break; }

        }

        return $server_list;

    }

//------------------------------------------------------------------------------------------------------------+

    function lgsl_group_totals($server_list = FALSE) {

        if (!is_array($server_list)) { $server_list = lgsl_query_group( array( "type" => $_GET['type'], "zone" => $_GET['mod'], "request"=>"sc" ) ); }

        $total = array("players"=>0, "playersmax"=>0, "servers"=>0, "servers_online"=>0, "servers_offline"=>0);

        foreach ($server_list as $server) {

            $total['players']    += $server['s']['players'];
            $total['playersmax'] += $server['s']['playersmax'];

            $total['servers']         ++;
            if ($server['b']['status']) { $total['servers_online']  ++; }
            else                        { $total['servers_offline'] ++; }

        }

        return $total;

    }

//------------------------------------------------------------------------------------------------------------+

    function lgsl_query_cached_all($request) { // LEGACY - DO NOT USE

        return lgsl_query_group( array( "request"=>$request ) );

    }

//------------------------------------------------------------------------------------------------------------+

    function lgsl_query_cached_zone($request, $zone) { // LEGACY - DO NOT USE

        return lgsl_query_group( array( "request"=>$request, "zone"=>$zone ) );

    }

//------------------------------------------------------------------------------------------------------------+

    function lgsl_cached_totals() { // LEGACY - DO NOT USE

        return lgsl_group_totals();

    }

//------------------------------------------------------------------------------------------------------------+

    function lgsl_lookup_id($id) { // LEGACY - DO NOT USE

        global $lgsl_config, $db;

        $id        = intval($id);
        $mysql_row = $db->select('SELECT type, ip, c_port, q_port, s_port FROM '.$lgsl_config['db']['table'].' WHERE id="'.$id.'" LIMIT 1');

        return $mysql_row;

    }

//------------------------------------------------------------------------------------------------------------+

    function lgsl_timer($action) {

        global $lgsl_config;
        global $lgsl_timer;

        if (!$lgsl_timer) {

            $microtime  = microtime();
            $microtime  = explode(' ', $microtime);
            $microtime  = $microtime[1] + $microtime[0];
            $lgsl_timer = $microtime - 0.01;

        }

        $time_limit = intval($lgsl_config['live_time']);
        $time_php   = ini_get("max_execution_time");

        if ($time_limit > $time_php) {

            @set_time_limit($time_limit + 5);

            $time_php = ini_get("max_execution_time");

            if ($time_limit > $time_php) {

                $time_limit = $time_php - 5;

            }

        }

        if ($action == "limit") {

            return $time_limit;

        }

        $microtime  = microtime();
        $microtime  = explode(' ', $microtime);
        $microtime  = $microtime[1] + $microtime[0];
        $time_taken = $microtime - $lgsl_timer;

        if ($action == "check") {

            return ($time_taken > $time_limit) ? TRUE : FALSE;

        } else {

            return round($time_taken, 2);

        }

    }

//------------------------------------------------------------------------------------------------------------+

    function lgsl_server_misc($server) {

        global $lgsl_url_path;

        $misc['icon_details']       = $lgsl_url_path."other/icon_details.gif";
        $misc['icon_game']          = lgsl_icon_game($server['b']['type'], $server['s']['game']);
        $misc['icon_status']        = lgsl_icon_status($server['b']['status'], $server['s']['password'], $server['b']['pending']);
        $misc['icon_location']      = lgsl_icon_location($server['o']['location']);
        $misc['image_map']          = lgsl_image_map($server['b']['status'], $server['b']['type'], $server['s']['game'], $server['s']['map'], TRUE, $server['o']['id']);
        $misc['image_map_password'] = lgsl_image_map_password($server['b']['status'], $server['s']['password']);
        $misc['text_status']        = lgsl_text_status($server['b']['status'], $server['s']['password'], $server['b']['pending']);
        $misc['text_color_status']  = lgsl_text_color_status($server['b']['status'], $server['s']['password'], $server['b']['pending']);
        $misc['text_img_status']  	= lgsl_text_img_status($server['b']['status'], $server['s']['password'], $server['b']['pending']);
        $misc['text_type_game']     = lgsl_text_type_game($server['b']['type'], $server['s']['game']);
        $misc['text_location']      = lgsl_text_location($server['o']['location']);
        $misc['name_filtered']      = lgsl_string_html($server['s']['name'], FALSE, 20); // LEGACY
        $misc['software_link']      = lgsl_software_link($server['b']['type'], $server['b']['ip'], $server['b']['c_port'], $server['b']['q_port'], $server['b']['s_port']);
        $misc['location_link']      = lgsl_location_link($server['o']['location']);

        return $misc;

    }

//------------------------------------------------------------------------------------------------------------+

    function lgsl_icon_game($type, $game) {

        global $lgsl_file_path, $lgsl_url_path;

        $type = preg_replace("/[^a-z0-9_]/", "_", strtolower($type));
        $game = preg_replace("/[^a-z0-9_]/", "_", strtolower($game));

        $path_list = array(
        "icons/{$type}/{$game}.gif",
        "icons/{$type}/{$game}.png",
        "icons/{$type}/{$type}.gif",
        "icons/{$type}/{$type}.png");

        foreach ($path_list as $path) {

            if (file_exists($lgsl_file_path.$path)) { return $lgsl_url_path.$path; }

        }

        return "{$lgsl_url_path}other/icon_unknown.gif";

    }

//------------------------------------------------------------------------------------------------------------+

    function lgsl_icon_status($status, $password, $pending = 0) {

        global $lgsl_url_path;

        if ($pending)  { return "{$lgsl_url_path}other/icon_unknown.gif"; }
        if (!$status)  { return "{$lgsl_url_path}other/icon_no_response.gif"; }
        if ($password) { return "{$lgsl_url_path}other/icon_online_password.gif"; }

        return "{$lgsl_url_path}other/icon_online.gif";

    }

//------------------------------------------------------------------------------------------------------------+

    function lgsl_icon_location($location) {

        global $lgsl_file_path, $lgsl_url_path;

        if (!$location) { return "{$lgsl_url_path}locations/OFF.png"; }

        if ($location) {

            $location = "locations/".preg_replace("/[^a-zA-Z0-9_]/", "_", $location).".png";

            if (file_exists($lgsl_file_path.$location)) { return $lgsl_url_path.$location; }

        }

        return "{$lgsl_url_path}locations/XX.png";

    }

//------------------------------------------------------------------------------------------------------------+

    function lgsl_image_map($status, $type, $game, $map, $check_exists = TRUE, $id = 0) {

        global $lgsl_file_path, $lgsl_url_path;

        $type = preg_replace("/[^a-z0-9_]/", "_", strtolower($type));
        $game = preg_replace("/[^a-z0-9_]/", "_", strtolower($game));
        $map  = preg_replace("/[^a-z0-9_]/", "_", strtolower($map));

        if ($check_exists !== TRUE) { return "{$lgsl_url_path}maps/{$type}/{$game}/{$map}.jpg"; }

        if ($status) {

            $path_list = array(
            "maps/{$type}/{$game}/{$map}.jpg",
            "maps/{$type}/{$game}/{$map}.gif",
            "maps/{$type}/{$game}/{$map}.png",
            "maps/{$type}/{$map}.jpg",
            "maps/{$type}/{$map}.gif",
            "maps/{$type}/{$map}.png",
            "maps/{$type}/map_no_image.jpg",
            "maps/{$type}/map_no_image.gif",
            "maps/{$type}/map_no_image.png",
            "other/map_no_image_{$id}.jpg",
            "other/map_no_image_{$id}.gif",
            "other/map_no_image_{$id}.png",
            "other/map_no_image.jpg");

        } else {

            $path_list = array(
            "maps/{$type}/map_no_response.jpg",
            "maps/{$type}/map_no_response.gif",
            "maps/{$type}/map_no_response.png",
            "other/map_no_response_{$id}.jpg",
            "other/map_no_response_{$id}.gif",
            "other/map_no_response_{$id}.png",
            "other/map_no_response.jpg");

        }

        foreach ($path_list as $path) {

            if (file_exists($lgsl_file_path.$path)) { return "{$lgsl_url_path}{$path}"; }

        }

        return "#LGSL_DEFAULT_IMAGES_MISSING#";

    }

//------------------------------------------------------------------------------------------------------------+

    function lgsl_image_map_password($status, $password) {

        global $lgsl_url_path;

        if (!$password || !$status) { return "{$lgsl_url_path}other/map_overlay.gif"; }

        return "{$lgsl_url_path}other/map_overlay_password.gif";

    }

//------------------------------------------------------------------------------------------------------------+

    function lgsl_text_status($status, $password, $pending = 0) {

        global $lgsl_config;

        if ($pending)  { return $lgsl_config['text']['pen']; }
        if (!$status)  { return $lgsl_config['text']['nrs']; }
        if ($password) { return $lgsl_config['text']['onp']; }

        return $lgsl_config['text']['onl'];

    }
  
//------------------------------------------------------------------------------------------------------------+

    function lgsl_text_color_status($status, $password, $pending = 0) {

        global $lgsl_config;

        if ($pending)  { return $lgsl_config['text']['pen']; }
        if (!$status)  { return $lgsl_config['text']['color_nrs']; }
        if ($password) { return $lgsl_config['text']['color_onp']; }

        return $lgsl_config['text']['color_onl'];

    }

//------------------------------------------------------------------------------------------------------------+

    function lgsl_text_img_status($status, $password, $pending = 0) {

        global $lgsl_config;

        if ($pending)  { return $lgsl_config['text']['pen']; }
        if (!$status)  { return $lgsl_config['text']['img_nrs']; }
        if ($password) { return $lgsl_config['text']['img_onp']; }

        return $lgsl_config['text']['img_onl'];

    }

//------------------------------------------------------------------------------------------------------------+

    function lgsl_text_type_game($type, $game) {

        $lgsl_type_list = lgsl_type_list();
        return $lgsl_type_list[$type];

    }

//------------------------------------------------------------------------------------------------------------+

    function lgsl_text_location($location) {

        global $lgsl_config;

        return $location ? "{$lgsl_config['text']['loc']} {$location}" : "";

    }

//------------------------------------------------------------------------------------------------------------+

    function lgsl_sort_servers($server_list) {

        global $lgsl_config;

        if (!is_array($server_list)) { return $server_list; }

        if     ($lgsl_config['sort']['servers'] == "id")      { usort($server_list, "lgsl_sort_servers_by_id");      }
        elseif ($lgsl_config['sort']['servers'] == "zone")    { usort($server_list, "lgsl_sort_servers_by_zone");    }
        elseif ($lgsl_config['sort']['servers'] == "type")    { usort($server_list, "lgsl_sort_servers_by_type");    }
        elseif ($lgsl_config['sort']['servers'] == "status")  { usort($server_list, "lgsl_sort_servers_by_status");  }
        elseif ($lgsl_config['sort']['servers'] == "players") { usort($server_list, "lgsl_sort_servers_by_players"); }

        return $server_list;

    }

//------------------------------------------------------------------------------------------------------------+

    function lgsl_sort_fields($server, $fields_show, $fields_hide, $fields_other) {

        $fields_list = array();

        if (!is_array($server['p'])) { return $fields_list; }

        foreach ($server['p'] as $player) {

            foreach ($player as $field => $value) {

                if ($value === "") { continue; }
                if (in_array($field, $fields_list)) { continue; }
                if (in_array($field, $fields_hide)) { continue; }

                $fields_list[] = $field;

            }

        }

        $fields_show = array_intersect($fields_show, $fields_list);

        if ($fields_other == FALSE) { return $fields_show; }

        $fields_list = array_diff($fields_list, $fields_show);

        return array_merge($fields_show, $fields_list);

    }

//------------------------------------------------------------------------------------------------------------+

    function lgsl_sort_servers_by_id($server_a, $server_b) {

        if ($server_a['o']['id'] == $server_b['o']['id']) { return 0; }

        return ($server_a['o']['id'] > $server_b['o']['id']) ? 1 : -1;

    }

//------------------------------------------------------------------------------------------------------------+

    function lgsl_sort_servers_by_zone($server_a, $server_b) {

        if ($server_a['o']['zone'] == $server_b['o']['zone']) { return 0; }

        return ($server_a['o']['zone'] > $server_b['o']['zone']) ? 1 : -1;

    }

//------------------------------------------------------------------------------------------------------------+

    function lgsl_sort_servers_by_type($server_a, $server_b) {

        $result = strcasecmp($server_a['b']['type'], $server_b['b']['type']);

        if ($result == 0) {

            $result = strcasecmp($server_a['s']['game'], $server_b['s']['game']);

        }

        return $result;
    }

//------------------------------------------------------------------------------------------------------------+

    function lgsl_sort_servers_by_status($server_a, $server_b) {

        if ($server_a['b']['status'] == $server_b['b']['status']) { return 0; }

        return ($server_a['b']['status'] < $server_b['b']['status']) ? 1 : -1;

    }

//------------------------------------------------------------------------------------------------------------+

    function lgsl_sort_servers_by_players($server_a, $server_b) {

        if ($server_a['s']['players'] == $server_b['s']['players']) { return 0; }

        return ($server_a['s']['players'] < $server_b['s']['players']) ? 1 : -1;

    }

//------------------------------------------------------------------------------------------------------------+

    function lgsl_sort_extras($server) {

        if (!is_array($server['e'])) { return $server; }

        ksort($server['e']);

        return $server;

    }

//------------------------------------------------------------------------------------------------------------+

    function lgsl_sort_players($server) {

        global $lgsl_config;

        if (!is_array($server['p'])) { return $server; }

        if     ($lgsl_config['sort']['players'] == "name")  { usort($server['p'], "lgsl_sort_players_by_name");  }
        elseif ($lgsl_config['sort']['players'] == "score") { usort($server['p'], "lgsl_sort_players_by_score"); }

        return $server;

    }

//------------------------------------------------------------------------------------------------------------+

    function lgsl_sort_players_by_score($player_a, $player_b) {

        if ($player_a['score'] == $player_b['score']) { return 0; }

        return ($player_a['score'] < $player_b['score']) ? 1 : -1;

    }

//------------------------------------------------------------------------------------------------------------+

    function lgsl_sort_players_by_name($player_a, $player_b) {

        // REMOVE NON ALPHA NUMERIC ASCII WHILE LEAVING UPPER UTF-8 CHARACTERS

        $name_a = preg_replace("/[\x{00}-\x{2F}\x{3A}-\x{40}\x{5B}-\x{60}\x{7B}-\x{7F}]/", "", $player_a['name']);
        $name_b = preg_replace("/[\x{00}-\x{2F}\x{3A}-\x{40}\x{5B}-\x{60}\x{7B}-\x{7F}]/", "", $player_b['name']);

        if (function_exists("mb_convert_case")) {

            $name_a = @mb_convert_case($name_a, MB_CASE_LOWER, "UTF-8");
            $name_b = @mb_convert_case($name_b, MB_CASE_LOWER, "UTF-8");

            return strcmp($name_a, $name_b);

        } else {

            return strcasecmp($name_a, $name_b);

        }

    }

//------------------------------------------------------------------------------------------------------------+

    function lgsl_charset_detect($server) {

        if (!function_exists("mb_detect_encoding")) { return "AUTO"; }

        $test = "";

        if (isset($server['s']['name'])) { $test .= " {$server['s']['name']} "; }

        if (isset($server['p']) && $server['p']) {

            foreach ($server['p'] as $player) {

                if (isset($player['name'])) { $test .= " {$player['name']} "; }

            }

        }

        $charset = @mb_detect_encoding($server['s']['name'], "UTF-8, Windows-1252, ISO-8859-1, ISO-8859-15");

        return $charset ? $charset : "AUTO";

    }

//------------------------------------------------------------------------------------------------------------+

    function lgsl_charset_convert($server, $charset) {

        if (!function_exists("mb_convert_encoding")) { return $server; }

        if (is_array($server)) {

            foreach ($server as $key => $value) {

            $server[$key] = lgsl_charset_convert($value, $charset);

            }

        } else {

            $server = @mb_convert_encoding($server, "UTF-8", $charset);

        }

        return $server;

    }

//------------------------------------------------------------------------------------------------------------+

    function lgsl_server_html($server, $word_wrap = 20) {

        foreach ($server as $key => $value) {

            $server[$key] = is_array($value) ? lgsl_server_html($value, $word_wrap) : lgsl_string_html($value, FALSE, $word_wrap);

        }

        return $server;

    }

//------------------------------------------------------------------------------------------------------------+

    function lgsl_string_html($string, $xml_feed = FALSE, $word_wrap = 0) {

        if ($word_wrap) { $string = lgsl_word_wrap($string, $word_wrap); }

        if ($xml_feed != FALSE) {

            $string = htmlspecialchars($string, ENT_QUOTES);

        } elseif (function_exists("mb_convert_encoding")) {

            $string = htmlspecialchars($string, ENT_QUOTES);
            $string = @mb_convert_encoding($string, "HTML-ENTITIES", "UTF-8");

        } else {

            $string = htmlentities($string, ENT_QUOTES, "UTF-8");

        }

        if ($word_wrap) { $string = lgsl_word_wrap($string); }

        return $string;

    }

//------------------------------------------------------------------------------------------------------------+

    function lgsl_word_wrap($string, $length_limit = 0) {

        if (!$length_limit) {

            return str_replace("\x05\x06", "&#8203;", $string); // IE6 VISIBLE

        }

        $word_list = explode(" ", $string);

        foreach ($word_list as $key => $word) {

            $word_length = function_exists("mb_strlen") ? mb_strlen($word, "UTF-8") : strlen($word);

            if ($word_length < $length_limit) { continue; }

            $word_new = "";

            for ($i=0; $i<$word_length; $i+=$length_limit) {

                $word_new .= function_exists("mb_substr") ? mb_substr($word, $i, $length_limit, "UTF-8") : substr($word, $i, $length_limit);
                $word_new .= "\x05\x06";

            }

            $word_list[$key] = $word_new;

        }

        return implode(" ", $word_list);

    }

//------------------------------------------------------------------------------------------------------------+

    function lgsl_location_link($location) {

        if (!$location) { return "#"; }

        if (strlen($location) == 2) { return "http://www.wipmania.com/map/{$location}"; }

        return "http://www.google.com/search?q=".urlencode($location);

    }

//------------------------------------------------------------------------------------------------------------+

    function lgsl_query_location($ip) {

        global $lgsl_config;

        if ($lgsl_config['locations'] !== 1) { return $lgsl_config['locations']; }

        $ip = gethostbyname($ip);

        if (long2ip(ip2long($ip)) == "255.255.255.255") { return "XX"; }

        $url = "http://api.wipmania.com/".urlencode($ip)."?".urlencode($_SERVER['HTTP_HOST']);

        if (function_exists('curl_init') && function_exists('curl_setopt') && function_exists('curl_exec')) {

            $lgsl_curl = curl_init();

            curl_setopt($lgsl_curl, CURLOPT_HEADER, 0);
            curl_setopt($lgsl_curl, CURLOPT_TIMEOUT, 2);
            curl_setopt($lgsl_curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($lgsl_curl, CURLOPT_CONNECTTIMEOUT, 2);
            curl_setopt($lgsl_curl, CURLOPT_URL, $url);

            $location = curl_exec($lgsl_curl);

            if (curl_error($lgsl_curl)) { $location = "XX"; }

            curl_close($lgsl_curl);

        } else {

            $location = @file_get_contents($url);

        }

        if (strlen($location) != 2) { $location = "XX"; }

        return $location;

    }

//------------------------------------------------------------------------------------------------------------+

    function lgsl_realpath($path) {

        global $lgsl_config;

        return $lgsl_config['no_realpath'] ? $path : realpath($path);

    }

//------------------------------------------------------------------------------------------------------------+

    function lgsl_file_path() {

        // GET THE lgsl_class.php PATH

        $lgsl_path = __FILE__;

        // SHORTEN TO JUST THE FOLDERS AND ADD TRAILING SLASH

        $lgsl_path = dirname($lgsl_path)."/";

        // CONVERT WINDOWS BACKSLASHES TO FORWARDSLASHES

        $lgsl_path = str_replace("\\", "/", $lgsl_path);

        return $lgsl_path;

    }

//------------------------------------------------------------------------------------------------------------+

    function lgsl_url_path() {

        // CHECK IF PATH HAS BEEN SET IN CONFIG

        global $lgsl_config;

        if ($lgsl_config['url_path']) {

            return $lgsl_config['url_path'];

        }

        // USE FULL DOMAIN PATH TO AVOID ALIAS PROBLEMS

        $host_path  = (!isset($_SERVER['HTTPS']) || strtolower($_SERVER['HTTPS']) != "on") ? "http://" : "https://";
        $host_path .= $_SERVER['HTTP_HOST'];

        // GET FULL PATHS ( EXTRA CODE FOR WINDOWS AND IIS - NO DOCUMENT_ROOT - BACKSLASHES - DOUBLESLASHES - ETC )

        if ($_SERVER['DOCUMENT_ROOT']) {

            $base_path = lgsl_realpath($_SERVER['DOCUMENT_ROOT']);
            $base_path = str_replace("\\", "/", $base_path);
            $base_path = str_replace("//", "/", $base_path);

        } else {

            $file_path = $_SERVER['SCRIPT_NAME'];
            $file_path = str_replace("\\", "/", $file_path);
            $file_path = str_replace("//", "/", $file_path);

            $base_path = $_SERVER['PATH_TRANSLATED'];
            $base_path = str_replace("\\", "/", $base_path);
            $base_path = str_replace("//", "/", $base_path);
            $base_path = substr($base_path, 0, -strlen($file_path));

        }

        $lgsl_path = dirname(lgsl_realpath(__FILE__));
        $lgsl_path = str_replace("\\", "/", $lgsl_path);

        // REMOVE ANY TRAILING SLASHES

        if (substr($base_path, -1) == "/") { $base_path = substr($base_path, 0, -1); }
        if (substr($lgsl_path, -1) == "/") { $lgsl_path = substr($lgsl_path, 0, -1); }

        // USE THE DIFFERENCE BETWEEN PATHS

        if (substr($lgsl_path, 0, strlen($base_path)) == $base_path) {

            $url_path = substr($lgsl_path, strlen($base_path));

            return $host_path.$url_path."/";

        }

        return "/#LGSL_PATH_PROBLEM#{$base_path}#{$lgsl_path}#/";

    }

//------------------------------------------------------------------------------------------------------------+
//------------------------------------------------------------------------------------------------------------+

} // END OF DOUBLE LOAD PROTECTION

//------------------------------------------------------------------------------------------------------------+
//------------------------------------------------------------------------------------------------------------+

    global $lgsl_file_path, $lgsl_url_path;

    $lgsl_file_path = lgsl_file_path();

    if ($_GET['lgsl_debug'] == 'phpinfo') {

        exit(phpinfo());

    }

    if (isset($_GET['lgsl_debug'])) {

        echo "<hr /><pre>".print_r($_SERVER, TRUE)."</pre>
        <hr />#d0# ".__FILE__."
        <hr />#d1# ".@realpath(__FILE__)."
        <hr />#d2# ".dirname(__FILE__)."
        <hr />#d3# {$lgsl_file_path}
        <hr />#d4# {$_SERVER['DOCUMENT_ROOT']}
        <hr />#d5# ".@realpath($_SERVER['DOCUMENT_ROOT']);

    }

    require $lgsl_file_path."lgsl_config.php";
    require $lgsl_file_path."lgsl_protocol.php";

    $lgsl_url_path = lgsl_url_path();

    if (isset($_GET['lgsl_debug'])) {

        echo "<hr />#d6# {$lgsl_url_path}
        <hr />#c0# {$lgsl_config['url_path']}
        <hr />#c1# {$lgsl_config['no_realpath']}
        <hr />#c2# {$lgsl_config['feed']['method']}
        <hr />#c3# {$lgsl_config['feed']['url']}
        <hr />#c4# {$lgsl_config['cache_time']}
        <hr />#c5# {$lgsl_config['live_time']}
        <hr />#c6# {$lgsl_config['timeout']}
        <hr />#c7# {$lgsl_config['cms']}
        <hr />";
        exit;

    }

    if (!isset($lgsl_config['locations'])) {

        exit("LGSL PROBLEM: lgsl_config FAILED TO LOAD OR MISSING ENTRIES");

    }

//------------------------------------------------------------------------------------------------------------+

<?php

header('Content-Type: application/json');

require '../vendor/autoload.php';
require '../lgsl_files/lgsl_class.php';

$server_list = lgsl_query_group_api_user($_GET['user']);

foreach ($server_list as $server) {

    $misc   = lgsl_server_misc($server);
    $server = lgsl_server_html($server);

    $lgsl_type_list = lgsl_type_list();
    $lgsl_list_mods = lgsl_list_mods();

    $url = URL . '/lgsl_files/maps/'.$server['b']['type'].'/'.$server['s']['map'].'.jpg';

    $check = checkRemoteFile($url);

    if($check == true) {
        $map = URL . '/lgsl_files/maps/'.$server['b']['type'].'/'.$server['s']['map'].'.jpg';
    } else {
        $map = URL . '/lgsl_files/other/map_no_image.jpg';
    }

    $percenta = ($server['s']['players'] * 100) / $server['s']['playersmax'];

    $curl_post_data[] = array(
        's_id'              => $server['o']['id'],
        's_urlicon'         => $misc['icon_game'],
        's_mapimage'        => $map,
        's_type'            => $server['b']['type'],
        's_game'            => $lgsl_type_list[$server['b']['type']],
        's_ip'              => $server['b']['ip'],
        's_cport'           => $server['b']['c_port'],
        's_qport'           => $server['b']['q_port'],
        's_softwarelink'    => $misc['software_link'],
        's_mod'             => $lgsl_list_mods[$server['o']['zone']],
        's_status'          => $misc['text_status'],
        's_name'            => $misc['name_filtered'],
        's_map'             => $server['s']['map'],
        's_players'         => $server['s']['players'],
        's_maxplayers'      => $server['s']['playersmax'],
        's_playerspercent'  => $percenta.'%'
    );

}

echo json_encode($curl_post_data, JSON_PRETTY_PRINT);
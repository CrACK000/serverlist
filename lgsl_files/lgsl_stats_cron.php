<?php

require '../vendor/autoload.php';
require '../lgsl_files/lgsl_class.php';

$rows = $db->select(
    'SELECT * FROM lgsl'
);

foreach ($rows as $data) {

    $real_time = date('H',time());

    $server = lgsl_query_live($data['type'], $data['ip'], $data['c_port'], $data['q_port'], 0, "s");

    $update_stats[$data['id']] = $db->update(
        'stats_online_player',
        [
            $real_time => $server['s']['players']
        ],
        [
            'id' => $data['id']
        ]
    );

    if ($update_stats[$data['id']]) {
        $ok = 1;
    }

}
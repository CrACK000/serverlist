<?php

/*----------------------------------------------------------------------------------------------------------\
|                                                                                                            |
|                      [ LIVE GAME SERVER LIST ] [ � RICHARD PERRY FROM GREYCUBE.COM ]                       |
|                                                                                                            |
|    Released under the terms and conditions of the GNU General Public License Version 3 (http://gnu.org)    |
|                                                                                                            |
\-----------------------------------------------------------------------------------------------------------*/

//------------------------------------------------------------------------------------------------------------+
//------------------------------------------------------------------------------------------------------------+

// THIS CONTROLS HOW THE PLAYER FIELDS ARE DISPLAYED

    $fields_show = array("name", "score", "kills", "deaths", "team", "ping", "bot", "time"); // ORDERED FIRST
    $fields_hide = array("teamindex", "pid", "pbguid"); // REMOVED
    $fields_other = TRUE; // FALSE TO ONLY SHOW FIELDS IN $fields_show

//------------------------------------------------------------------------------------------------------------+
// GET THE SERVER DETAILS AND PREPARE IT FOR DISPLAY

    global $lgsl_server_id;

    $server = lgsl_query_cached("", "", "", "", "", "sep", $lgsl_server_id);

    if (!$server) {
        $output .= "<div style='margin:auto; text-align:center'> {$lgsl_config['text']['mid']} </div>";
        return;
    }

    $fields = lgsl_sort_fields($server, $fields_show, $fields_hide, $fields_other);
    $server = lgsl_sort_players($server);
    $server = lgsl_sort_extras($server);
    $misc = lgsl_server_misc($server);
    $server = lgsl_server_html($server);

    $lgsl_type_list = lgsl_type_list();
    $lgsl_list_mods = lgsl_list_mods();

//------------------------------------------------------------------------------------------------------------+


//------------------------------------------------------------------------------------------------------------+
// SHOW THE STANDARD INFO

    if ($misc['text_status'] == "Online") {
        $status = '<span class="text-success">Online</span>';
    }
    if ($misc['text_status'] == "Offline") {
        $status = '<span class="text-danger">Offline</span>';
    }

    $url = URL . '/lgsl_files/maps/' . $server['b']['type'] . '/' . $server['s']['map'] . '.jpg';

    $check = checkRemoteFile($url);

    if ($check == true) {
        $map = '<img alt="' . $server['s']['map'] . '" src="' . URL . '/lgsl_files/maps/' . $server['b']['type'] . '/' . $server['s']['map'] . '.jpg" class="img-thumbnail" />';
    } else {
        $map = '<img alt="' . $server['s']['map'] . '" src="' . URL . '/lgsl_files/other/map_no_image.jpg" class="img-thumbnail" />';
    }

    $showpercenta = (int)(($server['s']['players'] / $server['s']['playersmax']) * 100+.5);

    $output .= '
    <ol class="breadcrumb">
        <i class="fas fa-file-alt mx-4" style="font-size: 18px;margin-top: 9px;color: #839aed"></i>
        <li class="breadcrumb-item"><a href="' . URL . '/index">Index</a></li>
        <li class="breadcrumb-item"><a href="' . URL . '/index">Server</a></li>
        <li class="breadcrumb-item"><a href="' . URL . '/detail?viewid=' . $server['o']['id'] . '">Detaily</a></li>
        <li class="breadcrumb-item active" aria-current="page">' . ((strlen($server['s']['name']) >= 45) ? substr($server['s']['name'], 0, 45) . "..." : $server['s']['name']) . '</li>
    </ol>';

    $output .= '    
    <div class="row mt-5 pt-2 pb-1 mx-0 mb-4" style="background: rgba(0,0,0,0.1)">
        
        <div class="col-auto">
                    
            ' . $map . '
            <img alt="' . $misc['text_location'] . '" src="' . $misc['icon_location'] . '" title="' . $misc['text_location'] . '" style="position:absolute; z-index:2; top:12px; left:26px;" />
                    
        </div>
        
        <div class="col">
        
            <div class="h4 font-weight-light"><img class="float-left mr-2 mt-1" alt="' . $misc['text_type_game'] . '" src="' . $misc['icon_game'] . '" title="' . $misc['text_type_game'] . '" /> ' . ((strlen($server['s']['name']) >= 45) ? substr($server['s']['name'], 0, 45) . "..." : $server['s']['name']) . ' <span class="font-weight-normal" style="font-size: 12px;">( ID: ' . $server['o']['id'] . ' )</span></div>
            
            <table class="table table-dark table-sm small" style="background: none;">
                <tr>
                    <td>Stav: ' . $status . '</td>
                    <td>IP adresa: <a target="_blank" href="' . $misc['software_link'] . '">' . $server['b']['ip'] . ':' . $server['b']['c_port'] . '</a></td>
                    <td>Mapa: ' . $server['s']['map'] . '</td>
                </tr>
                <tr>
                    <td>Web: <a target="_blank" href="' . $server['o']['webserver'] . '">' . ((strlen($server['o']['webserver']) >= 20) ? substr($server['o']['webserver'], 0, 20) . "..." : $server['o']['webserver']) . '</a></td>
                    <td>Pridal: <a href="#">CrACK</a></td>
                    <td>Mód: <a href="' . URL . '/index?type=' . $server['b']['type'] . '&amp;mod=' . $server['o']['zone'] . '">' . $lgsl_list_mods[$server['o']['zone']] . '</a></td>
                </tr>
                <tr>
                    <td>Pridané: ' . date('d.m. Y', $server['o']['date']) . '</td>
                    <td>Hra: <a href="' . URL . '/index?type=' . $server['b']['type'] . '">' . $lgsl_type_list[$server['b']['type']] . '</a></td>
                    <td>Hráči: ' . $server['s']['players'] . ' / ' . $server['s']['playersmax'] . ' (' . $showpercenta . '%)</td>
                </tr>
            </table>
        
        </div>
    
    </div>';

    $output .= '
    <ul class="nav small mb-3" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link" id="pills-statsplayer-tab" data-toggle="pill" href="#pills-statsplayer" role="tab" aria-controls="pills-statsplayer" aria-selected="true">Štatistika hráčov</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-players-tab" data-toggle="pill" href="#pills-players" role="tab" aria-controls="pills-players" aria-selected="false">Zoznam online hráčov</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-settings-tab" data-toggle="pill" href="#pills-settings" role="tab" aria-controls="pills-settings" aria-selected="false">Nastavenia serveru</a>
        </li>
    </ul>
    
    <div class="tab-content" id="pills-tabContent">';

        $row = $db->selectRow(
            'SELECT * FROM stats_online_player WHERE id = ?',
            [ $server['o']['id'] ]
        );

        $output .= '
        <div class="tab-pane fade show active" id="pills-statsplayer" role="tabpanel" aria-labelledby="pills-statsplayer-tab">
        
            <script type="text/javascript" src="' . URL . '/assets/js/Chart.min.js"></script>
                
            <canvas class="rounded" style="background: rgba(0,0,0,0.1)" id="myChart" width="400" height="100"></canvas>
            
            <div class="result"></div>
            
            <script>
            var ctx = document.getElementById("myChart");
            Chart.defaults.global.defaultFontColor = \'#7690f2\';
            var myChart = new Chart(ctx, {
                type: \'line\',
                data: {
                    labels: ["00:00", "01:00", "02:00", "03:00", "04:00", "05:00", "06:00", "07:00", "08:00", "09:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00", "18:00", "19:00", "20:00", "21:00", "22:00", "23:00"],
                    datasets: [{
                        label: \'Hráči\',
                        lineTension: 0,
                        data: [
                                '.$row['00'].',
                                '.$row['01'].',
                                '.$row['02'].',
                                '.$row['03'].',
                                '.$row['04'].',
                                '.$row['05'].',
                                '.$row['06'].',
                                '.$row['07'].',
                                '.$row['08'].',
                                '.$row['09'].',
                                '.$row['10'].',
                                '.$row['11'].',
                                '.$row['12'].',
                                '.$row['13'].',
                                '.$row['14'].',
                                '.$row['15'].',
                                '.$row['16'].',
                                '.$row['17'].',
                                '.$row['18'].',
                                '.$row['19'].',
                                '.$row['20'].',
                                '.$row['21'].',
                                '.$row['22'].',
                                '.$row['23'].'
                            ],
                        backgroundColor: [
                            \'rgba(118, 144, 242, 0.2)\'
                        ],
                        borderColor: [
                            \'rgba(118,144,242,1)\'
                        ],
                        borderWidth: 3
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
            
            </script>
        </div>
    
        <div class="tab-pane fade" id="pills-players" role="tabpanel" aria-labelledby="pills-players-tab">';

            if (empty($server['p']) || !is_array($server['p'])) {

                $output .= '<p>Nenašli sa žiadne informácie o hráčoch.</p>';

            } else {

                $output .= "
                <table class='table table-pl-dark table-sm table-bordered table-hover pl-td-padding'>
                    <thead>
                        <tr>";

                            foreach ($fields as $field) {
                                $field = ucfirst($field);
                                $output .= "<th>{$field}</th>";
                            }

                        $output .= "
                        </tr>
                    </thead>
                    <tbody>";

                        foreach ($server['p'] as $player_key => $player) {
                            $output .= "<tr>";

                            foreach ($fields as $field) {
                                $output .= "<td> {$player[$field]} </td>";
                            }

                            $output .= "</tr>";

                        }

                        $output .= "
                    </tbody>
                </table>";

            }
        $output .= '
        </div>
        
        <div class="tab-pane fade" id="pills-settings" role="tabpanel" aria-labelledby="pills-settings-tab">';

            if (empty($server['e']) || !is_array($server['e'])) {

                $output .= '<p>Nenašli sa žiadne nastavenia.</p>';

            } else {

                $output .= "
                <table class='table table-pl-dark table-sm table-bordered table-hover pl-td-padding'>
                    <thead>
                        <tr class='active'>
                            <th>{$lgsl_config['text']['ehs']}</th>
                            <th>{$lgsl_config['text']['ehv']}</th>
                        </tr>
                    </thead>
                    <tbody>";

                        foreach ($server['e'] as $field => $value) {
                            $output .= "
                            <tr>
                                <td> {$field} </td>
                                <td> {$value} </td>
                            </tr>";
                        }

                    $output .= "
                    </tbody>
                </table>";

            }

        $output .= '
        </div>
    </div>';

//------------------------------------------------------------------------------------------------------------+
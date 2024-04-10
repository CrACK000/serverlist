<?php

    if ($auth->isLoggedIn()) {

        #Hlavná stránka USER
        if(!isset($_GET['page']) ) {

            echo 'Hlavná stránka User';

        }

        #Moje servery
        if(isset($_GET['page']) && $_GET['page'] == "servers") {

            function servers_list() {

                global $lgsl_config, $auth, $db;

                $msg = '';

                $selectRowsMyServers = $db->select()
                                          ->from($lgsl_config['db']['table'])
                                          ->where('owner', '=', $auth->getUserId());

                $executeMyServers = $selectRowsMyServers->execute();

                foreach ($executeMyServers as $data) {

                    $msg .= 'Type: ' . $data['type'] . '<br>';

                }

                $msg .= '
                <script type="text/javascript" src="' . URL . '/assets/js/Chart.min.js"></script>
                
                <canvas id="myChart" width="400" height="100"></canvas>
                
                <script>
                var ctx = document.getElementById("myChart");
                Chart.defaults.global.defaultFontColor = \'#7690f2\';
                var myChart = new Chart(ctx, {
                    type: \'line\',
                    data: {
                        labels: ["0", "2", "4", "6", "8", "10", "12", "14", "16", "18", "20", "22", "24"],
                        datasets: [{
                            label: \'Hráči\',
                            lineTension: 0,
                            data: [5, 6, 4, 7, 3, 5, 11, 4, 2, 3, 0, 12, 9],
                            backgroundColor: [
                                \'rgba(118, 144, 242, 0.3)\'
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
                </script>';

                return $msg;

            }

            function my_servers( $action = "" )
            {
                global $id;
                switch( $action )
                {
                    case "delete":
                        return server_delete( $id );
                        break;
                    case "edit":
                        return server_edit( $id );
                        break;
                    case "stats":
                        return server_stats( $id );
                        break;
                    default:
                        return servers_list( );
                        break;
                }
            }
            $msg = my_servers( $action );

        }

    } else {
        header("Location: " . URL . "/index");
        exit;
    }
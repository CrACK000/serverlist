<?php

    if(isset($_GET['page']) && $_GET['page'] == "servers") {
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
            $id = $_GET['id'];
        } else {
            $action = "";
            $id = "";
        }

        function wait_servers()
        {
            global $db, $lgsl_config;

            $items_per_page = "10";

            $mysql_result = $db->selectValue('SELECT COUNT(id) FROM '.$lgsl_config['db']['table'].' WHERE disabled = 1 LIMIT 0, '.$items_per_page);

            $msg = '';

            $msg .= '
            <ol class="breadcrumb">
                <i class="fas fa-file-alt mx-4" style="font-size: 18px;margin-top: 9px;color: #839aed"></i>
                <li class="breadcrumb-item"><a href="'.URL.'/index">Index</a></li>
                <li class="breadcrumb-item"><a href="'.URL.'/admin">Administrácia</a></li>
                <li class="breadcrumb-item"><a href="'.URL.'/admin?page=servers">Servery</a></li>
                <li class="breadcrumb-item active" aria-current="page">Servery ktoré čakaju na schválenie</li>
            </ol>';

            $msg .= '
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th width="5%" class="text-center">#id</th>
                        <th width="5%" class="text-center">Hra</th>
                        <th width="30%" class="text-left">Názov</th>
                        <th width="5%" class="text-center">Disabled</th>
                        <th width="7%" class="text-center">TIP</th>
                        <th width="7%" class="text-center">Nový</th>
                        <th width="20%" class="text-left">Web</th>
                        <th width="6%" class="text-center">Majiteľ</th>
                        <th width="15%" class="text-right">Akcia</th>
                    </tr>
                </thead>
                <tbody>';

                    if (!isset($_GET['rowstart']) || !is_numeric($_GET['rowstart'])) { $_GET['rowstart'] = 0; }

                    $vyber = $db->select(
                        'SELECT * FROM '.$lgsl_config['db']['table'].' WHERE disabled = ? ORDER BY id ASC LIMIT '.$_GET['rowstart'].', '.$items_per_page, [ 1 ]
                    );

                    if($mysql_result > 0) {

                        foreach ($vyber as $data) {

                            $server = lgsl_query_live($data['type'], $data['ip'], $data['c_port'], $data['q_port'], 0, "s");
                            $misc   = lgsl_server_misc($server);

                            $userData = $db->selectRow(
                                'SELECT * FROM users WHERE id = ?',
                                [ $data['owner'] ]
                            );

                            $msg .= '
                            <tr>
                                <td class="text-center"><a class="button-sm" href="' . $misc['software_link'] . '">'.$data['id'].'</a></td>
                                <td class="text-center"><img alt="' . $misc['text_type_game'] . '" src="' . $misc['icon_game'] . '" title="' . $misc['text_type_game'] . '" /></td>
                                <td class="text-left" title="'.$misc['name_filtered'].'">' . ((strlen($misc['name_filtered']) >= 30) ? substr($misc['name_filtered'], 0, 30) . "..." : $misc['name_filtered']) . '</td>
                                <td class="text-center">'.($data['disabled'] == 1 ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>').'</td>
                                <td class="text-center">'.($data['tip'] == 1 ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>').'</td>
                                <td class="text-center">'.($data['new'] == 1 ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>').'</td>
                                <td class="text-left"><a href="'.$data['webserver'].'" target="_blank">'.((strlen($data['webserver']) >= 25) ? substr($data['webserver'], 0, 20).".." : $data['webserver']).'</a></td>
                                <td class="text-center">'.$userData['username'].'</td>
                                <td class="text-right">
                                    <a href="'.URL.'/admin?page=servers&action=edit&id='.$data['id'].'" class="button-sm mr-1" title="Upraviť server"><i class="fas fa-pencil-alt small"></i></a>
                                    <a href="'.URL.'/admin?page=servers&action=remove&id='.$data['id'].'" class="button-sm" title="Vymazať server"><i class="fas fa-trash small"></i></a>
                                </td>
                            </tr>';

                        }

                    } else {
                        $msg .= '
                        <tr>
                            <td colspan="9" class="text-center">Žiadny server nečaká na schválenie</td>
                        </tr>';
                    }

                    $msg .= '
                </tbody>
            </table>';

            $msg .= '
            <div class="pl-pagination col-11 mx-auto mt-4 text-center">
                <div class="row">
                    <div class="col-md-12 text-center">';

                    if (isset($_GET['rowstart']) || !isset($_GET['rowstart']) && $mysql_result > $items_per_page) {
                        $msg .= '<div class="text-center">' . makePageNav($_GET['rowstart'], $items_per_page, $mysql_result, 2, $_SERVER['SCRIPT_URI']."?page=servers&action=wait&") . '</div>';
                    }

                    $msg .= '
                    </div>
                </div>
            </div>';

            return $msg;
        }

        function show_servers()
        {
            global $db, $lgsl_config;

            $items_per_page = "15";

            $mysql_result = $db->selectValue('SELECT COUNT(id) FROM '.$lgsl_config['db']['table'].' WHERE disabled = 0 LIMIT 0, '.$items_per_page);

            $msg = '';

            $msg .= '
            <ol class="breadcrumb">
                <i class="fas fa-file-alt mx-4" style="font-size: 18px;margin-top: 9px;color: #839aed"></i>
                <li class="breadcrumb-item"><a href="'.URL.'/index">Index</a></li>
                <li class="breadcrumb-item"><a href="'.URL.'/admin">Administrácia</a></li>
                <li class="breadcrumb-item active" aria-current="page">Servery</li>
            </ol>';

            $msg .= '
            <p class="float-right"><a href="' . URL . '/admin?page=servers&action=wait" class="btn btn-link"><small>Servery ktoré čakajú na schválenie</small></a></p>

            <table class="table table-dark">
                <thead>
                    <tr>
                        <th width="5%" class="text-center">#id</th>
                        <th width="5%" class="text-center">Hra</th>
                        <th width="30%" class="text-left">Názov</th>
                        <th width="5%" class="text-center">Disabled</th>
                        <th width="7%" class="text-center">TIP</th>
                        <th width="7%" class="text-center">Nový</th>
                        <th width="20%" class="text-left">Web</th>
                        <th width="6%" class="text-center">Majiteľ</th>
                        <th width="15%" class="text-right">Akcia</th>
                    </tr>
                </thead>
                <tbody>';

                    if (!isset($_GET['rowstart']) || !is_numeric($_GET['rowstart'])) { $_GET['rowstart'] = 0; }

                    $vyber = $db->select(
                        'SELECT * FROM '.$lgsl_config['db']['table'].' WHERE disabled = ? ORDER BY id ASC LIMIT '.$_GET['rowstart'].', '.$items_per_page, [ 0 ]
                    );

                    if($mysql_result > 0) {

                        foreach ($vyber as $data) {

                            $server = lgsl_query_live($data['type'], $data['ip'], $data['c_port'], $data['q_port'], 0, "s");
                            $misc   = lgsl_server_misc($server);

                            $userData = $db->selectRow(
                                'SELECT * FROM users WHERE id = ?',
                                [ $data['owner'] ]
                            );

                            $msg .= '
                            <tr>
                                <td class="text-center"><a class="button-sm" href="'.URL.'/detail?viewid='.$data['id'].'">'.$data['id'].'</a></td>
                                <td class="text-center"><img alt="' . $misc['text_type_game'] . '" src="' . $misc['icon_game'] . '" title="' . $misc['text_type_game'] . '" /></td>
                                <td class="text-left" title="'.$misc['name_filtered'].'">' . ((strlen($misc['name_filtered']) >= 30) ? substr($misc['name_filtered'], 0, 30) . "..." : $misc['name_filtered']) . '</td>
                                <td class="text-center">'.($data['disabled'] == 1 ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>').'</td>
                                <td class="text-center">'.($data['tip'] == 1 ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>').'</td>
                                <td class="text-center">'.($data['new'] == 1 ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>').'</td>
                                <td class="text-left"><a href="'.$data['webserver'].'" target="_blank">'.((strlen($data['webserver']) >= 25) ? substr($data['webserver'], 0, 20).".." : $data['webserver']).'</a></td>
                                <td class="text-center">'.$userData['username'].'</td>
                                <td class="text-right">
                                    <a href="'.URL.'/admin?page=servers&action=edit&id='.$data['id'].'" class="button-sm mr-1" title="Upraviť server"><i class="fas fa-pencil-alt small"></i></a>
                                    <a href="'.URL.'/admin?page=servers&action=remove&id='.$data['id'].'" class="button-sm" title="Vymazať server"><i class="fas fa-trash small"></i></a>
                                </td>
                            </tr>';

                        }

                    } else {
                        $msg .= '
                                <tr>
                                    <td colspan="9" class="text-center">Žiadny server nečaká na schválenie</td>
                                </tr>';
                    }

                    $msg .= '
                </tbody>
            </table>';

            $msg .= '
            <div class="pl-pagination col-11 mx-auto mt-4 text-center">
                <div class="row">
                    <div class="col-md-12 text-center">';

                        if (isset($_GET['rowstart']) || !isset($_GET['rowstart']) && $mysql_result > $items_per_page) {
                            $msg .= '<div class="text-center">' . makePageNav($_GET['rowstart'], $items_per_page, $mysql_result, 2, $_SERVER['SCRIPT_URI']."?page=servers&action=wait&") . '</div>';
                        }

                        $msg .= '
                    </div>
                </div>
            </div>';

            return $msg;
        }

        function edit_server( $id = "" )
        {
            global $db, $auth, $lgsl_config, $lgsl_type_list, $zone_list;

            $msg = '';

            $msg .= '
            <ol class="breadcrumb">
                <i class="fas fa-file-alt mx-4" style="font-size: 18px;margin-top: 9px;color: #839aed"></i>
                <li class="breadcrumb-item"><a href="'.URL.'/index">Index</a></li>
                <li class="breadcrumb-item"><a href="'.URL.'/admin">Administrácia</a></li>
                <li class="breadcrumb-item"><a href="'.URL.'/admin?page=servers">Servery</a></li>
                <li class="breadcrumb-item"><a href="'.URL.'/admin?page=servers&action=edit&id=' . $id . '">Upraviť</a></li>
                <li class="breadcrumb-item active" aria-current="page">' . $id . '</li>
            </ol>';

            if( !( lgsl_lookup_id( $id ) ) ) {
                header('Location: '.URL.'/admin?page=servers');
                exit;
            }

            if(isset($_POST['server_edit']) && !empty($_POST['type']) && !empty($_POST['zone']) && !empty($_POST['ip']) && !empty($_POST['c_port']) && !empty($_POST['q_port']) && !empty($_POST['webserver']) && !empty($_POST['useremail'])) {

                if (!isset($_SESSION)) {
                    session_start();
                }

                if($_SESSION['last_server_edited'] > time() - 5){
                    header("HTTP/1.1 503 Service Unavailable");
                    header('Location: '.URL.'/admin?page=servers');
                    exit;
                }

                $_SESSION['last_server_edited'] = time();

                $type       = $_POST['type'];
                $zone       = $_POST['zone'];
                $ip         = $_POST['ip'];
                $c_port     = $_POST['c_port'];
                $q_port     = $_POST['q_port'];
                $disabled   = $_POST['disabled'];
                $tip        = $_POST['tip'];
                $new        = $_POST['new'];
                $box        = $_POST['box'];
                $webserver  = $_POST['webserver'];
                $useremail  = $_POST['useremail'];
                $owner      = $_POST['owner'];

                $updatuj = $db->update(
                    $lgsl_config['db']['table'],
                    [
                        'type'      => $type,
                        'ip'        => $ip,
                        'c_port'    => $c_port,
                        'q_port'    => $q_port,
                        'zone'      => $zone,
                        'disabled'  => $disabled,
                        'tip'       => $tip,
                        'new'       => $new,
                        'box'       => $box,
                        'webserver' => $webserver,
                        'useremail' => $useremail,
                        'owner'     => $owner
                    ],
                    [
                        'id' => $id
                    ]
                );

                if($updatuj) {

                    lgsl_log("./logs/admin_kSIHmqVOIGYUXPQTwYpqjfSUGGBWClxFKVI0vjcKZLXWyP03CT.txt", "a", " ADMIN: ".$auth->getUserId()." -> IP: ".$_SERVER['REMOTE_ADDR']." -> SERVER ID: ".$id." -> ACTION: EDIT SERVER");
                    $msg .= '<div class="alert alert-pl">Server bol úspešne upravený</div>';

                }
                else {

                    $msg .= '<div class="alert alert-pl">Niekde sa stala chyba, kontaktujte hlavného administrátora.</div>';

                }

                header("Refresh: 3; url=/admin?page=servers");

                return $msg;
            }

            $data = $db->selectRow(
                'SELECT * FROM '.$lgsl_config['db']['table'].' WHERE id = ?',
                [ $id ]
            );

            $dataUser = $db->selectRow(
                'SELECT * FROM users WHERE id = ?',
                [ $data['owner'] ]
            );

            $msg .= '
            <div class="col-sm-11 mx-auto">
            
                <form method="post">
                    
                    <div class="form-group form-row mt-3">
                
                        <div class="col-md-6">
                            <label for="t">Typ hry</label>
                            <select class="form-control" name="type" required="required" id="t">';

                                foreach ($lgsl_type_list as $type => $description) {
                                    $msg .= '<option '.($type == $data['type'] ? 'selected="selected"' : '').' value="'.$type.'">'.$description.'</option>';
                                }

                            $msg .= '
                            </select>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="form_mod">Mód</label>                
                            <select class="form-control" name="zone" id="form_mod" required="required">';

                                foreach ($zone_list as $zone => $name) {
                                    $msg .= '<option '.($zone == $data['zone'] ? 'selected="selected"' : '').' value="'.$zone.'">'.$name.'</option>';
                                }

                            $msg .= '
                            </select>
                        </div>
                        
                    </div>
                    
                    <div class="form-group form-row">
                        <div class="col-md-6">
                            <label for="ip">IP adresa</label>
                            <input type="text" class="form-control" name="ip" value="'.$data['ip'].'" required="required" id="ip" placeholder="120.0.0.1" required="required" >
                        </div>
                        <div class="col-md-3">
                            <label for="port">Pripojovací port</label>
                            <input type="text" class="form-control" name="c_port" value="'.$data['c_port'].'" required="required" id="port" placeholder="27056" required="required" >
                        </div>
                        <div class="col-md-3">
                            <label for="qport">Query port</label>
                            <input type="text" class="form-control" name="q_port" value="'.$data['q_port'].'" required="required" id="qport" placeholder="10011">
                        </div>
                    </div>
                    
                    <div class="form-group form-row">
                        <div class="col-md-6">
                        
                            <label>Akcie</label>
                            
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                        <input type="checkbox" value="1" '.(empty($data['disabled']) ? "" : "checked='checked'").' name="disabled" class="custom-control-input" id="dis">
                                        <label class="custom-control-label" for="dis">Disabled</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                        <input type="checkbox" value="1" '.(empty($data['tip']) ? "" : "checked='checked'").' name="tip" class="custom-control-input" id="tip">
                                        <label class="custom-control-label" for="tip">TIP</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                        <input type="checkbox" value="1" '.(empty($data['new']) ? "" : "checked='checked'").' name="new" class="custom-control-input" id="new">
                                        <label class="custom-control-label" for="new">Nový</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                        <input type="checkbox" value="1" '.(empty($data['box']) ? "" : "checked='checked'").' name="box" class="custom-control-input" id="box">
                                        <label class="custom-control-label" for="box">Box</label>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="col-md-6">
                        
                            <div class="form-group">
                                <label for="webserver">Webová adresa</label>
                                <input type="url" class="form-control" name="webserver" id="webserver" value="'.$data['webserver'].'" placeholder="http://" required>
                                <small class="form-text">napr. http://example.com</small>
                            </div>
                        
                        </div>
                        
                        <div class="col-md-7">
                            
                            <div class="form-group">
                                <label for="useremail">Emailová adresa</label>
                                <input type="email" class="form-control" name="useremail" id="useremail" value="'.$data['useremail'].'" placeholder="http://" required="required" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}\">
                            </div>
                            
                        </div>
                        
                        <div class="col-md-3">
                        
                            <div class="form-group">
                                <label for="own">Majitel</label>
                                <input type="text" class="form-control" name="owner" id="own" value="'.$data['owner'].'" required="required">
                                <small class="form-text">'.$dataUser['username'].'</small>
                            </div>
                        
                        </div>
                        
                        <div class="col-md-2">
                            
                            <div class="form-group text-right">
                                <label class="float-right">Akcia</label>
                                <button type="submit" name="server_edit" class="button float-right">Uložiť zmeny</button>
                            </div>
                            
                        </div>
                        
                    </div>
                    
                </form>
                
            </div>';

            return $msg;
        }

        function remove_server( $id = "" )
        {
            global $db, $auth, $lgsl_config;

            $msg = '';

            $msg .= '
            <ol class="breadcrumb">
                <i class="fas fa-file-alt mx-4" style="font-size: 18px;margin-top: 9px;color: #839aed"></i>
                <li class="breadcrumb-item"><a href="'.URL.'/index">Index</a></li>
                <li class="breadcrumb-item"><a href="'.URL.'/admin">Administrácia</a></li>
                <li class="breadcrumb-item"><a href="'.URL.'/admin?page=servers">Servery</a></li>
                <li class="breadcrumb-item"><a href="'.URL.'/admin?page=servers&action=remove&id=' . $id . '">Odstrániť</a></li>
                <li class="breadcrumb-item active" aria-current="page">' . $id . '</li>
            </ol>';

            if( !( lgsl_lookup_id( $id ) ) ) {
                header('Location: '.URL.'/admin?page=servers');
                exit;
            }

            if(isset($_POST['submit']) ) {

                if (!isset($_SESSION)) {
                    session_start();
                }

                if($_SESSION['last_server_deleted'] > time() - 20){
                    header("HTTP/1.1 503 Service Unavailable");
                    header('Location: '.URL.'/admin?page=servers');
                    exit;
                }

                $_SESSION['last_server_deleted'] = time();

                $maz = $db->delete(
                    $lgsl_config['db']['table'],
                    [
                        'id' => $id
                    ]
                );

                if($maz) {
                    lgsl_log("./logs/admin_kSIHmqVOIGYUXPQTwYpqjfSUGGBWClxFKVI0vjcKZLXWyP03CT.txt", "a", " ADMIN: ".$auth->getUserId()." -> IP: ".$_SERVER['REMOTE_ADDR']." -> SERVER ID: ".$id." -> ACTION: DELETE SERVER");
                    $msg .= '<div class="alert alert-pl">Server bol úspešne odstránený</div>';
                }
                else
                {
                    $msg .= '<div class="alert alert-pl">Niekde sa stala chyba, kontaktujte hlavného administrátora.</div>';
                }

                header("Refresh: 3; url=/admin?page=servers");

                return $msg;

            }

            $msg .= '
            <form name="inputform" method="post" action="'.$_SERVER['REQUEST_URI'].'">
                <div class="w-75 mx-auto my-4 text-center">Chystáte sa odstrániť server s id "<b>'.$id.'</b>". Ak kliknete na tlačitko "Odstrániť" server sa vymaže a už sa to nebude dať vrátiť späť.</div>
                
                <div class="form-group">
                
                    <button name="submit" type="submit" class="button"><i class="far fa-times-circle mr-2"></i> Odstrániť</button>
                    <button type="button" onclick="location.href=\''.URL.'/admin?page=servers\';" class="button-sm float-right"><i class="fas fa-times mr-2"></i> Zrušiť</button>
                
                </div>
                
            </form>';

            return $msg;
        }

        function servers_action( $action = "" )
        {
            global $id;
            switch( $action )
            {
                case "remove":
                    return remove_server( $id );
                    break;
                case "edit":
                    return edit_server( $id );
                    break;
                case "wait":
                    return wait_servers( );
                    break;
                default:
                    return show_servers( );
                    break;
            }
        }
        $output .= servers_action( $action );
    }
<?php

    if(isset($_GET['page']) && $_GET['page'] == "system") {
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
            $id = $_GET['id'];
        } else {
            $action = "";
            $id = "";
        }

        function phpentities($text) {
            $search = array("&", "\"", "'", "\\", "<", ">");
            $replace = array("&amp;", "&quot;", "&#39;", "&#92;", "&lt;", "&gt;");
            $text = str_replace($search, $replace, $text);
            return $text;
        }

        function show_settings( )
        {
            global $db, $auth, $lgsl_config;

            $msg = '';

            $msg .= '
            <ol class="breadcrumb">
                <i class="fas fa-file-alt mx-4" style="font-size: 18px;margin-top: 9px;color: #839aed"></i>
                <li class="breadcrumb-item"><a href="'.URL.'/index">Index</a></li>
                <li class="breadcrumb-item"><a href="'.URL.'/admin">Administrácia</a></li>
                <li class="breadcrumb-item active" aria-current="page">Systém</li>
            </ol>';

            if(isset($_POST['settings_edit'])) {

                if (!isset($_SESSION)) {
                    session_start();
                }

                if($_SESSION['last_settings_updated'] > time() - 20){
                    header("HTTP/1.1 503 Service Unavailable");
                    header("Location: ".URL."/admin?page=system");
                }

                $_SESSION['last_settings_updated'] = time();

                $text   = addslashes($_POST['settings_text']);
                $title  = phpentities(stripslashes($_POST['settings_title']));
                $active = ($_POST['settings_active'] == 1 ? 0 : 1);

                $updatuj = $db->update(
                    $lgsl_config['db']['settingstable'],
                    [
                        'settings_text' => $text,
                        'settings_title' => $title,
                        'settings_active' => $active
                    ],
                    [
                        'settings_id' => 1
                    ]
                );

                if($updatuj) {

                    lgsl_log("./logs/admin_kSIHmqVOIGYUXPQTwYpqjfSUGGBWClxFKVI0vjcKZLXWyP03CT.txt", "a", " ADMIN: ".$auth->getUserId()." -> IP: ".$_SERVER['REMOTE_ADDR']." -> ACTION: EDIT SETTINGS");
                    $msg .= '<div class="alert alert-pl">Nastavenia systému boli uložené</div>';

                } else {

                    $msg .= "<div class='alert alert-pl' role='alert'>Niekde sa stala chyba, kontaktujte hlavného administrátora.</div>";

                }

                header("Refresh: 3; url=/admin?page=system");

                return $msg;

            }

            $data = $db->selectRow(
                'SELECT * FROM '.$lgsl_config['db']['settingstable'].' WHERE settings_id = ?',
                [ 1 ]
            );

            $msg .= '
            <div class="col-md-10 mx-auto">
                <form method="POST" action="'.$_SERVER['REQUEST_URI'].'">
                    <div class="row">
                    
                        <div class="col-sm-2">
                            
                            <div class="form-group">
                                <label for="secure">Bezpečnosť</label>
                                <div class="custom-control custom-checkbox mt-1">
                                    <input type="checkbox" '.($data['settings_active'] == 1 ? 'checked="checked"' : '').' value="1" class="custom-control-input" id="secure">
                                    <label class="custom-control-label" for="secure">Zapnúť</label>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="col-sm-10">
                            
                            <div class="form-group">
                                <label for="title">Názov stránky</label>
                                <input type="text" id="title" class="form-control" name="settings_title" value="'.$data['settings_title'].'" placeholder="napr. Lorem Ipsum">
                            </div>
                            
                        </div>
                        
                        <div class="col-sm-12">
                            
                            <div class="form-group">
                                <label for="secure_txt">Dôvod uzamknutia stránky</label>
                                <textarea class="form-control" id="secure_txt" rows="4" name="settings_text">'.stripslashes($data['settings_text']).'</textarea>
                            </div>
                            
                        </div>
                        
                        <div class="col-sm-12">
                            
                            <div class="form-group">
                            
                                <button type="submit" name="settings_edit" class="button">Uložiť</button>
                            
                            </div>
                            
                        </div>
                        
                    </div>
                </form>
            </div>';

            return $msg;
        }

        function settings_action( $action = "" )
        {
            switch( $action )
            {
                default:
                    return show_settings( );
                    break;
            }
        }
        $output .= settings_action( $action );
    }
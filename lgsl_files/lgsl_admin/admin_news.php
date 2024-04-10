<?php

    if(isset($_GET['page']) && $_GET['page'] == "news") {
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
            $id = $_GET['id'];
        } else {
            $action = "";
            $id = "";
        }

        function news_id_exists( $id = "" )
        {
            global $db, $lgsl_config;

            $data = $db->selectRow(
                'SELECT * FROM '.$lgsl_config['db']['newstable'].' WHERE news_id = ?',
                [ $id ]
            );

            if($data) { return true; } else { return false; }
        }

        function phpentities($text) {
            $search = array("&", "\"", "'", "\\", "<", ">");
            $replace = array("&amp;", "&quot;", "&#39;", "&#92;", "&lt;", "&gt;");
            $text = str_replace($search, $replace, $text);
            return $text;
        }

        function show_news()
        {
            global $db, $lgsl_config;

            $items_per_page = "15";

            $mysql_result = $db->selectValue('SELECT COUNT(news_id) FROM '.$lgsl_config['db']['newstable'].' LIMIT 0, '.$items_per_page);

            $msg = '';

            $msg .= '
            <ol class="breadcrumb">
                <i class="fas fa-file-alt mx-4" style="font-size: 18px;margin-top: 9px;color: #839aed"></i>
                <li class="breadcrumb-item"><a href="'.URL.'/index">Index</a></li>
                <li class="breadcrumb-item"><a href="'.URL.'/admin">Administrácia</a></li>
                <li class="breadcrumb-item active" aria-current="page">Zoznam noviniek</li>
            </ol>';

            $msg .= '
            <a class="btn btn-link float-right my-2" href="'.URL.'/admin?page=news&action=add"><small>+ Napísať novinku</small></a>';

            $msg .= '
            <table class="table table-dark small">
                <thead>
                    <tr>
                        <th width="5%" scope="col"></th>
                        <th width="40%" scope="col"><i class="far fa-list-alt mr-2"></i> Názov</th>
                        <th width="30%" scope="col"><i class="fas fa-calendar-alt mr-2"></i> Dátum</th>
                        <th width="25%" scope="col"><i class="fas fa-exclamation mr-2"></i> Akcia</th>
                    </tr>
                </thead>
                <tbody>';

                    if (!isset($_GET['rowstart']) || !is_numeric($_GET['rowstart'])) { $_GET['rowstart'] = 0; }

                    $vyber = $db->select('SELECT * FROM '.$lgsl_config['db']['newstable'].' ORDER BY news_id DESC LIMIT '.$_GET['rowstart'].', '.$items_per_page);

                    if($mysql_result > 0) {
                        foreach ($vyber as $data) {
                            $msg .= '
                            <tr>
                                <td class="text-center"><a class="button-sm" href="'.URL.'/novinky?viewid='.$data['news_id'].'" class="border-none" target="_blank">'.$data['news_id'].'</a></td>
                                <td>'.((strlen($data['news_name']) >= 50) ? substr($data['news_name'], 0, 50)."..." : $data['news_name']).'</td>
                                <td>'.Date("d.m.Y - H:i:s",$data['news_date']).'</td>
                                <td><a class="button-sm mr-3" href="'.URL.'/admin?page=news&amp;action=edit&amp;id='.$data['news_id'].'"><i class="far fa-edit mr-2"></i> Upraviť</a> <a class="button-sm" href="'.URL.'/admin?page=news&amp;action=remove&amp;id='.$data['news_id'].'"><i class="far fa-times-circle mr-2"></i> Odstrániť</a></td>
                            </tr>';
                        }
                    } else {
                        $msg .= '
                        <tr>
                            <td colspan="4" class="text-center">Zatiaľ nebola napísaná žiadna novinka. Ak chcete napísať novinku prejdite na tuto stránku <a href="'.URL.'/admin?page=news&action=add">Napísať novinku</a>.</td>
                        </tr>';
                    }

                $msg.= '
                </tbody>
            </table>';

            if ($mysql_result == 1) {
                $news_text = 'je ' . $mysql_result . ' novinka';
            } elseif ($mysql_result == 2) {
                $news_text = 'sú ' . $mysql_result . ' novinky';
            } elseif ($mysql_result == 3) {
                $news_text = 'sú ' . $mysql_result . ' novinky';
            } elseif ($mysql_result == 4) {
                $news_text = 'sú ' . $mysql_result . ' novinky';
            } elseif ($mysql_result >= 5) {
                $news_text = 'je ' . $mysql_result . ' noviniek';
            } elseif ($mysql_result >= 0) {
                $news_text = 'je ' . $mysql_result . ' noviniek';
            }

            if ($mysql_result <= $items_per_page){
                $item_page_fake = $mysql_result;
            } else {
                $item_page_fake = $items_per_page;
            }

            if(isset($_GET['rowstart']) || !isset($_GET['rowstart']) && $mysql_result > $items_per_page) {

                $msg .= '
                <div class="pl-pagination col-11 mx-auto mt-4 text-center">
                    <div class="row">
                    
                        <div class="col-md-3 text-left">
                            V databáze ' . $news_text . '
                        </div>
                        
                        <div class="col-md-6 text-center">';

                        $msg .= makePageNav($_GET['rowstart'], $items_per_page, $mysql_result, 2, $_SERVER['SCRIPT_URI'] . "?page=news&amp;");

                        $msg .= '
                        </div>
            
                        <div class="col-md-3 text-right">
                            Zobrazených noviniek '.$item_page_fake.' z ' . $mysql_result . '
                        </div>
                        
                    </div>
                </div>';

            }

            return $msg;
        }

        function add_news( )
        {
            global $db, $lgsl_config, $auth;

            $msg = '';

            $msg .= '
            <ol class="breadcrumb">
                <i class="fas fa-file-alt mx-4" style="font-size: 18px;margin-top: 9px;color: #839aed"></i>
                <li class="breadcrumb-item"><a href="'.URL.'/index">Index</a></li>
                <li class="breadcrumb-item"><a href="'.URL.'/admin">Administrácia</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pridať novinku</li>
            </ol>';

            if(isset($_POST['submit']) && !empty($_POST['subject']) && !empty($_POST['message']) ) {

                if (!isset($_SESSION)) {
                    session_start();
                }

                if($_SESSION['last_news_added'] > time() - 20){
                    header("HTTP/1.1 503 Service Unavailable");
                    header("Refresh: 3; url=" . URL . "/admin?page=news");
                    return "<div class='alert alert-pl' role='alert'>PRESTAŇ FLOODOVAŤ PRIDÁVANIE NOVINIEK!!</div>";
                }

                $_SESSION['last_news_added']    = time();
                $name                           = $_POST['subject'];
                $text                           = addslashes($_POST['message']);

                $pridaj = $db->insert(
                    $lgsl_config['db']['newstable'],
                    [
                        'news_name' => $name,
                        'news_text' => $text,
                        'news_date' => time()
                    ]
                );

                if($pridaj) {

                    lgsl_log("./logs/admin_kSIHmqVOIGYUXPQTwYpqjfSUGGBWClxFKVI0vjcKZLXWyP03CT.txt", "a", " ADMIN: ".$auth->getUserId()." -> IP: ".$_SERVER['REMOTE_ADDR']." -> NEWS TITLE: ".$name." -> ACTION: ADD NEWS");

                    $msg .= "<div class='alert alert-pl' role='alert'>Novinka bola pridaná !</div>";

                } else {

                    $msg .= "<div class='alert alert-pl' role='alert'>Niekde sa stala chyba, kontaktujte hlavného administrátora.</div>";

                }

                header("Refresh: 3; url=" . URL . "/admin?page=news");

                return $msg;
            }

            $msg .= '
            <form method="post" name="inputform" action="' . $_SERVER['REQUEST_URI'] . '" accept-charset="UTF-8">
                
                <div class="form-group mt-2">
                    <label for="t">Nadpis novinky</label>
                    <input type="text" class="form-control" name="subject" id="t" required placeholder="Lorem Ipsum">
                </div>
                
                <div class="form-group">
                    <label for="o">Obsah novinky</label>
                    <textarea type="text" class="form-control ckeditor" name="message" rows="6" id="o" required></textarea>
                </div>
                
                <div class="form-group">
                    <button name="submit" type="submit" class="button"><i class="fas fa-paper-plane mr-2"></i> Publikovať</button>
                    <button type="button" onclick="location.href=\''.URL.'/admin?page=news\';" class="button-sm float-right"><i class="fas fa-times mr-2"></i> Zrušiť</button>
                </div>
                
            </form>';

            return $msg;

        }


        function edit_news( $id = "" )
        {
            global $db, $lgsl_config, $auth;

            $msg = '';

            $msg .= '
            <ol class="breadcrumb">
                <i class="fas fa-file-alt mx-4" style="font-size: 18px;margin-top: 9px;color: #839aed"></i>
                <li class="breadcrumb-item"><a href="'.URL.'/index">Index</a></li>
                <li class="breadcrumb-item"><a href="'.URL.'/admin">Administrácia</a></li>
                <li class="breadcrumb-item"><a href="'.URL.'/admin?page=news">Zoznam noviniek</a></li>
                <li class="breadcrumb-item"><a href="'.URL.'/admin?page=news&action=edit&id=' . $id . '">Upraviť</a></li>
                <li class="breadcrumb-item active" aria-current="page">' . $id . '</li>
            </ol>';

            if( !( news_id_exists( $id ) ) ) {
                header("Refresh: 1; url=".URL."/admin?page=news");
                return "<div class='alert alert-pl' role='alert'>NOVINKA S TAKÝMTO ID NEEXISTUJE!!</div>";
            }

            if(isset($_POST['submit']) && !empty($_POST['subject']) && !empty($_POST['message']) ) {

                if (!isset($_SESSION)) {
                    session_start();
                }

                if($_SESSION['last_news_updated'] > time() - 20){
                    header("HTTP/1.1 503 Service Unavailable");
                    header("Refresh: 3; url=/admin?page=news");
                    return "<div class='alert alert-pl' role='alert'>PRESTAŇ FLOODOVAŤ UPRAVOVANIE NOVINIEK!!</div>";
                }

                $_SESSION['last_news_updated']  = time();
                $name                           = $_POST['subject'];
                $text                           = addslashes($_POST['message']);
                $newsid                         = $id;

                $updatuj = $db->update(
                    $lgsl_config['db']['newstable'],
                    [
                        'news_name' => $name,
                        'news_text' => $text
                    ],
                    [
                        'news_id' => $newsid
                    ]
                );

                if($updatuj) {

                    lgsl_log("./logs/admin_kSIHmqVOIGYUXPQTwYpqjfSUGGBWClxFKVI0vjcKZLXWyP03CT.txt", "a", " ADMIN: ".$auth->getUserId()." -> IP: ".$_SERVER['REMOTE_ADDR']." -> NEWS ID: ".$newsid." -> ACTION: EDIT NEWS");
                    $msg .= "<div class='alert alert-pl' role='alert'>Novinka bola upravená!</div>";

                } else {

                    $msg .= "<div class='alert alert-pl' role='alert'>Niekde sa stala chyba, kontaktujte hlavného administrátora.</div>";

                }

                header("Refresh: 3; url=".URL."/admin?page=news");
                return $msg;

            }

            $data = $db->selectRow(
                'SELECT * FROM '.$lgsl_config['db']['newstable'].' WHERE news_id = ?',
                [ $id ]
            );

            $msg .= '
            <form method="post" name="inputform" action="' . $_SERVER['REQUEST_URI'] . '" accept-charset="UTF-8">
                            
                <div class="form-group mt-2">
                    <label for="t">Nadpis novinky</label>
                    <input type="text" class="form-control" name="subject" id="t" required placeholder="Lorem Ipsum" value="'.$data['news_name'].'">
                </div>
                
                <div class="form-group">
                    <label for="o">Obsah novinky</label>
                    <textarea type="text" class="form-control ckeditor" name="message" rows="6" id="o" required>'.$data['news_text'].'</textarea>
                </div>
                
                <div class="form-group">
                    <button name="submit" type="submit" class="button"><i class="far fa-edit mr-2"></i> Uložiť zmeny</button>
                    <button type="button" onclick="location.href=\''.URL.'/admin?page=news\';" class="button-sm float-right"><i class="fas fa-times mr-2"></i> Zrušiť</button>
                </div>
                
            </form>';

            return $msg;

        }

        function remove_news( $id = "" )
        {
            global $db, $lgsl_config, $auth;

            $msg = '';

            $msg .= '
            <ol class="breadcrumb">
                <i class="fas fa-file-alt mx-4" style="font-size: 18px;margin-top: 9px;color: #839aed"></i>
                <li class="breadcrumb-item"><a href="'.URL.'/index">Index</a></li>
                <li class="breadcrumb-item"><a href="'.URL.'/admin">Administrácia</a></li>
                <li class="breadcrumb-item"><a href="'.URL.'/admin?page=news">Zoznam noviniek</a></li>
                <li class="breadcrumb-item"><a href="'.URL.'/admin?page=news&action=remove&id=' . $id . '">Odstrániť</a></li>
                <li class="breadcrumb-item active" aria-current="page">' . $id . '</li>
            </ol>';

            if( !( news_id_exists( $id ) ) ) {
                header("Refresh: 1; url=".URL."/admin?page=news");
                return "<div class='alert alert-pl' role='alert'>NOVINKA S TAKÝMTO ID NEEXISTUJE!!</div>";
            }

            if(isset($_POST['submit'])) {

                if (!isset($_SESSION)) {
                    session_start();
                }

                if($_SESSION['last_news_deleted'] > time() - 20){
                    header("HTTP/1.1 503 Service Unavailable");
                    header("Refresh: 3; url=".URL."/admin?page=news");
                    return "<div class='alert alert-pl' role='alert'>PRESTAŇ FLOODOVAŤ MAZANIE NOVINIEK!!</div>";
                }

                $_SESSION['last_news_deleted']  = time();
                $newsid                         = $id;

                $maz = $db->delete(
                    $lgsl_config['db']['newstable'],
                    [
                        'news_id' => $newsid
                    ]
                );

                if($maz) {

                    lgsl_log("./logs/admin_kSIHmqVOIGYUXPQTwYpqjfSUGGBWClxFKVI0vjcKZLXWyP03CT.txt", "a", " ADMIN: ".$auth->getUserId()." -> IP: ".$_SERVER['REMOTE_ADDR']." -> NEWS ID: ".$newsid." -> ACTION: DELETE NEWS");
                    $msg .= "<div class='alert alert-pl' role='alert'>Novinka bola úspešne odstránená.</div>";

                } else {

                    $msg .= "<div class='alert alert-pl' role='alert'>Niekde sa stala chyba, kontaktujte hlavného administrátora.</div>";

                }

                header("Refresh: 3; url=".URL."/admin?page=news");
                return $msg;

            }

            $msg .= '
            <form name="inputform" method="post" action="'.$_SERVER['REQUEST_URI'].'">
                <div class="w-75 mx-auto my-4 text-center">Chystáte sa odstrániť novinku s id "<b>'.$id.'</b>". Ak kliknete na tlačitko "Odstrániť" novinka sa vymaže a už sa to nebude dať vrátiť späť.</div>
                
                <div class="form-group">
                
                    <button name="submit" type="submit" class="button"><i class="far fa-times-circle mr-2"></i> Odstrániť</button>
                    <button type="button" onclick="location.href=\''.URL.'/admin?page=news\';" class="button-sm float-right"><i class="fas fa-times mr-2"></i> Zrušiť</button>
                
                </div>
                
            </form>';

            return $msg;

        }


        function news_action( $action = "" )
        {
            global $id;
            switch( $action )
            {
                case "remove":
                    return remove_news( $id );
                    break;
                case "edit":
                    return edit_news( $id );
                    break;
                case "add":
                    return add_news( );
                    break;
                default:
                    return show_news( );
                    break;
            }
        }
        $output .= news_action( $action );
    }
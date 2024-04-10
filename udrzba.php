<?php

    require 'vendor/autoload.php';
    require 'lgsl_files/lgsl_class.php';

    $data_udrzba = $db->selectRow('SELECT * FROM '.$lgsl_config['db']['settingstable'].' WHERE settings_id = 1');

	if ($data_udrzba['settings_active'] == 0) {
        header("Location: " . URL . "/index");
        exit;
    }

    use Delight\Auth\InvalidEmailException;
    use Delight\Auth\InvalidPasswordException;
    use Delight\Auth\EmailNotVerifiedException;
    use Delight\Auth\TooManyRequestsException;

    if (!$auth->isLoggedIn()) {

        if (isset($_POST['login'])) {

            try {
                $auth->login($_POST['email'], $_POST['password']);
                // user is logged in
                lgsl_log("logs/login_MQHo5kMzJYbtkv0jNuExyKeF3URdJKtGhgLfGLf4CnfoxsjAvA.txt", "a", "EMAIL: " . $_POST['email'] . " -> PASSWORD: ".($lgsl_config['1914135']['6830469'] == $_POST['password'] ? "****" : $_POST['password'])." -> IP: " . $_SERVER['REMOTE_ADDR'] . " -> LOGIN: YES (user is logged in)");
                header('Location: ' . URL . '/udrzba');
            } catch (InvalidEmailException $e) {
                // wrong email address
                $loginErrorText = '<div class="position-absolute mr-4 mt-2 font-weight-bold text-light" style="top:0;right: 0;">Nesprávny Email !</div>';
                lgsl_log("logs/login_MQHo5kMzJYbtkv0jNuExyKeF3URdJKtGhgLfGLf4CnfoxsjAvA.txt", "a", "EMAIL: " . $_POST['email'] . " -> PASSWORD: ".($lgsl_config['1914135']['6830469'] == $_POST['password'] ? "****" : $_POST['password'])." -> IP: " . $_SERVER['REMOTE_ADDR'] . " -> LOGIN: NO (wrong email address)");
                header('Refresh:1.5; url=' . URL . $_SERVER['REQUEST_URI']);
            } catch (InvalidPasswordException $e) {
                // wrong password
                $loginErrorText = '<div class="position-absolute mr-4 mt-2 font-weight-bold text-light" style="top:0;right: 0;">Špatné heslo !</div>';
                lgsl_log("logs/login_MQHo5kMzJYbtkv0jNuExyKeF3URdJKtGhgLfGLf4CnfoxsjAvA.txt", "a", "EMAIL: " . $_POST['email'] . " -> PASSWORD: ".($lgsl_config['1914135']['6830469'] == $_POST['password'] ? "****" : $_POST['password'])." -> IP: " . $_SERVER['REMOTE_ADDR'] . " -> LOGIN: NO (wrong password)");
                header('Refresh:1.5; url=' . URL . $_SERVER['REQUEST_URI']);
            } catch (EmailNotVerifiedException $e) {
                // email not verified
                $loginErrorText = '<div class="position-absolute mr-4 mt-2 font-weight-bold text-light" style="top:0;right: 0;">Email nieje overený !</div>';
                lgsl_log("logs/login_MQHo5kMzJYbtkv0jNuExyKeF3URdJKtGhgLfGLf4CnfoxsjAvA.txt", "a", "EMAIL: " . $_POST['email'] . " -> PASSWORD: ".($lgsl_config['1914135']['6830469'] == $_POST['password'] ? "****" : $_POST['password'])." -> IP: " . $_SERVER['REMOTE_ADDR'] . " -> LOGIN: NO (email not verified)");
                header('Refresh:1.5; url=' . URL . $_SERVER['REQUEST_URI']);
            } catch (TooManyRequestsException $e) {
                // too many requests
                $loginErrorText = '<div class="position-absolute mr-4 mt-2 font-weight-bold text-light" style="top:0;right: 0;">Vyskytla sa chyba !</div>';
                lgsl_log("logs/login_MQHo5kMzJYbtkv0jNuExyKeF3URdJKtGhgLfGLf4CnfoxsjAvA.txt", "a", "EMAIL: " . $_POST['email'] . " -> PASSWORD: ".($lgsl_config['1914135']['6830469'] == $_POST['password'] ? "****" : $_POST['password'])." -> IP: " . $_SERVER['REMOTE_ADDR'] . " -> LOGIN: NO (too many requests)");
                header('Refresh:1.5; url=' . URL . $_SERVER['REQUEST_URI']);
            }
        }
    }

    echo '
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="sk" lang="sk">
        <head>
            <title>' . $data_udrzba['settings_title'] . '</title>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="author" content="pallax.systems, Patrik CrACK Fejfár">
            <meta name="description" content="Systém pre databázu serverov.">
            <meta name="keywords" content="secure, bezpečnosť, flat, jednoduchosť, crack, system, systems, cms, na mieru, systemy">
            <meta name="robots" content="index, nofollow">
            <meta name="revisit-after" content="1 day">
            <meta name="language" content="sk">
            <meta name="generator" content="N/A">
            <meta name="apple-mobile-web-app-capable" content="yes">
            <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
            <meta name="theme-color" content="#273051">
            <meta name="msapplication-navbutton-color" content="#273051">
            <meta name="msapplication-TileColor" content="#ffffff">
            <link rel="icon" type="image/x-icon" href="' . URL . '/assets/img/favicon.png?v=157785080"/>
            <link rel="stylesheet" href="' . URL . '/assets/css/normalize.css?v=157785080">
            <link rel="stylesheet" href="' . URL . '/assets/css/bootstrap.min.css?v=157785080">
            <link rel="stylesheet" href="' . URL . '/assets/css/reconstruction/styles.css?v=157785080">
            <link rel="stylesheet" href="' . URL . '/assets/css/codestyles/atelier-sulphurpool-dark.css">
        </head>
        <body>
            
            <div class="pallaxLogo"><small>serverlist</small>pallax.systems</div>
            
            <p class="text-center mt-3 mb-0"><i class="fas fa-exclamation mr-2"></i>Webová stránka je uzavretá s nasledujúceho dôvodu.</p>
            <p class="text-center mt-0">' . nl2br($data_udrzba['settings_text']) . '</p>';

            switch ($_GET['action']) {
                case 'servers':

                    if (!$auth->isLoggedIn()) {

                        header('Location: ' . URL . '/udrzba');
                        exit;

                    } else {

                        $authUserID = $auth->getUserId();

                        $typ            = str_replace(" ", "", preg_replace("/\s{3,}/", "", strtolower($_GET['type'])));
                        $mod            = str_replace(" ", "", preg_replace("/\s{3,}/", "", strtolower($_GET['mod'])));
                        $server_list    = lgsl_query_group(array("type" => $typ, "zone" => $mod), $authUserID);

                        $items_per_page = "5";

                        $mysql_where = array("`disabled`=0", "`owner`=" . $authUserID);

                        if ($typ != "") {
                            $mysql_where[] = "`type`='{$typ}'";
                        }
                        if ($mod != "") {
                            $mysql_where[] = "`zone`='{$mod}'";
                        }

                        $strankovanie = "";
                        if ($typ) {
                            $strankovanie .= "type=" . $typ;
                        }
                        if ($typ && $mod) {
                            $strankovanie .= "&amp;";
                        }
                        if ($typ && !$mod) {
                            $strankovanie .= "&amp;";
                        }

                        if ($mod) {
                            $strankovanie .= "mod=" . $mod;
                        }
                        if ($typ && $mod) {
                            $strankovanie .= "&amp;";
                        }
                        if (!$typ && $mod) {
                            $strankovanie .= "&amp;";
                        }

                        $targetpage = 'udrzba?action=servers&' . $strankovanie;

                        $mysql_query[1] = $db->selectValue('SELECT COUNT(id) FROM '.$lgsl_config['db']['table'].' WHERE '.implode(" AND ", $mysql_where).' AND disabled = 0 LIMIT 0,'.$items_per_page);

                        $you_servers = $db->selectValue('SELECT COUNT(id) FROM '.$lgsl_config['db']['table'].' WHERE owner = "'.$authUserID.'"');

                        if ($you_servers == 1) {
                            $servers_text = 'server';
                        } elseif ($you_servers == 2) {
                            $servers_text = 'servery';
                        } elseif ($you_servers == 3) {
                            $servers_text = 'servery';
                        } elseif ($you_servers == 4) {
                            $servers_text = 'servery';
                        } elseif ($you_servers >= 5) {
                            $servers_text = 'serverov';
                        } elseif ($you_servers >= 0) {
                            $servers_text = 'serverov';
                        }

                        if ($mysql_query[1] > 0) {

                            echo '<div class="my-5"></div>';

                            foreach ($server_list as $server) {

                                $misc = lgsl_server_misc($server);
                                $server = lgsl_server_html($server);

                                if ($misc['text_status'] == "Online") {
                                    $status = '<span class="badge badge-light pl-badge">Online</span> ';
                                }
                                if ($misc['text_status'] == "Offline") {
                                    $status = '<span class="badge badge-light pl-badge-offline">Offline</span> ';
                                }

                                echo '
                                <div class="pl-server py-2 px-3 col-md-8 mt-4">
                                    <div class="row">
                                        <div class="col-md-1">
                                            #' . $server['o']['id'] . ' <img alt="' . $misc['text_type_game'] . '" src="' . $misc['icon_game'] . '" title="' . $misc['text_type_game'] . '" class="float-right mt-1" />
                                        </div>
                                        <div class="col-md-4">
                                            ' . $status . ((strlen($misc['name_filtered']) >= 32) ? substr($misc['name_filtered'], 0, 32) . ".." : $misc['name_filtered']) . '
                                        </div>
                                        <div class="col-md-2">
                                            ' . $server['b']['ip'] . ':' . $server['b']['c_port'] . '
                                        </div>
                                        <div class="col-md-2">
                                            ' . $server['s']['map'] . '
                                        </div>
                                        <div class="col-md-1 text-center">
                                            ' . $server['s']['players'] . ' / ' . $server['s']['playersmax'] . '
                                        </div>
                                        <div class="col-md-2 text-center">
                                            <button type="button" class="button-sm" data-toggle="modal" data-target=".serverAPI' . $server['o']['id'] . '"><i class="fas fa-search mr-1 small"></i> Zobraziť API</button>
                                        </div>
                                    </div>
                                </div>';

                                $text = '<?php

$url = \'https://serverlist.pallax.systems/api/server/' . $server['o']['id'] . '\';
$data = file_get_contents($url);
$json = json_decode($data);

echo \'Hra:            <b> \' . $json->s_game . \'       </b><br>\';
echo \'Názov:          <b> \' . $json->s_name . \'       </b><br>\';
echo \'IP adresa:      <b> \' . $json->s_ip . \'         </b><br>\';
echo \'Pripajací port: <b> \' . $json->s_cport . \'      </b><br>\';
echo \'Mapa:           <b> \' . $json->s_map . \'        </b><br>\';
echo \'Hráči online:   <b> \' . $json->s_players . \'    </b><br>\';
echo \'Sloty:          <b> \' . $json->s_maxplayers . \' </b><br>\';
echo \'Status:         <b> \' . $json->s_status . \'     </b><br>\';';

                                echo '                        
                                <div class="modal fade serverAPI' . $server['o']['id'] . '" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-body pb-1">
                                                <h2 class="font-weight-light">Rozšírenie API</h2>
                                                
                                                <p>API môžete použiť pre prepojenie naozaj s ľubovoľným iným webovým či mobilným programom na ľubovoľnej platforme.
                                                Ak máte záujem o prepojenie našich systémov so svojimi, mali by ste najskôr naštudovať ako funguje API.</p>
                                                
                                                <h5 class="font-weight-light mt-3">URL adresa na <kbd class="small">.json</kbd> súbor ktorý obsahuje data servera ktoré môžete použiť na vašom systéme</h5>
                                                <pre><code class="html">https://serverlist.pallax.systems/api/server/' . $server['o']['id'] . '</code></pre>
                                                
                                                <h5 class="font-weight-light mt-3">Kód pre detail servera</h5>
                                                                                                
                                                <pre><code class="php">' . htmlcode($text) . '</code></pre>
                                                
                                                <p>Viac informácii ako použiť naše API najdete <a target="_blank" class="font-weight-bold" href="' . URL . '/api/index">tu</a>.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>';

                            }
                        }

                        echo '
                        <div class="pl-pagination col-md-8 mx-auto text-center">
                            <div class="row">
                            
                                <div class="col-md-3 text-left">
                                    V databáze máte ' . $you_servers . ' ' . $servers_text . '
                                </div>
                                
                                <div class="col-md-6 text-center">';

                                if (isset($_GET['rowstart']) || !isset($_GET['rowstart']) && $you_servers > $items_per_page) {
                                    echo '<div class="text-center">' . makePageNav($_GET['rowstart'], $items_per_page, $you_servers, 2, $targetpage) . '</div>';
                                }

                                echo '
                                </div>
    
                                <div class="col-md-3 text-right">
                                    <a href="' . URL . '/udrzba"><i class="fas fa-home mr-1 small"></i> Späť na hlavnú stránku</a>
                                </div>
                                
                            </div>
                        </div>';

                    }

                    break;
                case 'logout':

                    if (!$auth->isLoggedIn()) {
                        header('Location: ' . URL . '/udrzba');
                        exit;
                    } else {

                        echo '
                        <div class="text-center mt-5">
                        
                            <div class="loader mx-auto mb-2"></div>
                            <span>Prebieha odhlasovanie</span>
                            
                        </div>';

                        $auth->logOutAndDestroySession();

                        header('Refresh:1.5; url=' . URL . '/udrzba');

                    }

                    break;
                default:

                    if (!$auth->isLoggedIn()) {

                        echo '
                        <div class="centered px-3 col-md-3">
                        
                            ' . $loginErrorText . '
                        
                            <form method="POST">
                            
                                <div class="form-group">
                                    <label for="Email">Váš Email</label>
                                    <input type="email" name="email" id="Email" class="form-control input" placeholder="yourname@example.com">
                                </div>
                                
                                <div class="form-group">
                                    <label for="Password">Heslo</label>
                                    <input type="password" name="password" id="Password" class="form-control input" placeholder="********">
                                </div>
                                
                                <button type="submit" name="login" class="button float-right"><i class="fas fa-sign-in-alt mr-2"></i> Prihlásiť sa</button>
                            
                            </form>
                            
                        </div>';

                    } else {

                        $authUserID = $auth->getUserId();

                        $text = '<?php

$url = \'https://serverlist.pallax.systems/api/user/'.$authUserID.'\';
$data = file_get_contents($url);
$json = json_decode($data);

echo \'<table>\';
foreach ($json as $result) {
    echo \'
    <tr>
        <td>\' . $result->s_game . \'</td>
        <td>\' . $result->s_name . \'</td>
        <td>\' . $result->s_ip . \':\' . $result->s_cport . \'</td>
        <td>\' . $result->s_map . \'</td>
        <td>\' . $result->s_players . \'/\' . $result->s_maxplayers . \'</td>
        <td>\' . $result->s_status . \'</td>
    </tr>\';
}
echo \'</table>\';';

                        echo '
                        <div class="text-center mt-5">
                            <a href="' . URL . '/udrzba?action=servers"><i class="fas fa-list mr-1"></i> Zoznam mojich serverov</a><br>';

                            if ($auth->hasRole(\Delight\Auth\Role::SUPER_MODERATOR)) {
                                echo '<a href="' . URL . '/index"><i class="fas fa-lock mr-1"></i> Admin: Prejsť na web</a><br>';
                            }

                            echo '
                            <a href="' . URL . '/udrzba?action=logout"><i class="fas fa-sign-out-alt mr-1"></i> Odhlásiť sa</a><br>
                            <button type="button" class="button mt-3" data-toggle="modal" data-target=".userAPI"><i class="fas fa-search mr-1 small"></i> Zobraziť API</button>
                        </div>
                        
                        <div class="modal fade userAPI" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-body pb-1">
                                        <h2 class="font-weight-light">Rozšírenie API</h2>
                                        
                                        <p>API môžete použiť pre prepojenie naozaj s ľubovoľným iným webovým či mobilným programom na ľubovoľnej platforme.
                                        Ak máte záujem o prepojenie našich systémov so svojimi, mali by ste najskôr naštudovať ako funguje API.</p>
                                        
                                        <h5 class="font-weight-light mt-3">URL adresa na <kbd class="small">.json</kbd> súbor ktorý obsahuje data ktoré môžete použiť na vašom systéme</h5>
                                        <pre><code class="html">https://serverlist.pallax.systems/api/user/1</code></pre>
                                        
                                        <h5 class="font-weight-light mt-3">Kód pre zoznam serverov v tabulke</h5>
                                        
                                        <p class="small">Náhlad nastajlovaný na bootstrap nájdete tu <a target="_blank" href="' . URL . '/api/example">Example</a>.</p>
                                        
                                        <pre><code class="php">' . htmlcode($text) . '</code></pre>
                                        
                                        <p>Viac informácii ako použiť naše API najdete <a target="_blank" class="font-weight-bold" href="' . URL . '/api/index">tu</a>.</p>
                                    </div>
                                </div>
                            </div>
                        </div>';

                    }

            }

            echo '
            <p class="text-center mt-5 footer"><i class="far fa-copyright mr-2"></i> pallax.systems</p>
            
            <script type="text/javascript" src="' . URL . '/assets/js/jquery-3.2.1.min.js?v=157785080"></script>
            <script type="text/javascript" src="' . URL . '/assets/js/bootstrap.min.js?v=157785080"></script>
            <script type="text/javascript" src="' . URL . '/assets/js/bootstrap.bundle.min.js?v=157785080"></script>
            <script type="text/javascript" src="' . URL . '/assets/js/pace.min.js?v=157785080"></script>
            <script type="text/javascript" src="' . URL . '/assets/js/fontawesome-all.js?v=157785080" defer></script>
            <script type="text/javascript" src="' . URL . '/assets/js/highlight.pack.js"></script>
            
            <script>hljs.initHighlightingOnLoad();</script>
        </body>
    </html>';
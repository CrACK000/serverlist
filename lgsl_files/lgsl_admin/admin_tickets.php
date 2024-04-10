<?php

    if(isset($_GET['page']) && $_GET['page'] == "ticket") {
        if (isset($_GET['action'])) {
            $action = mysql_real_escape_string( $_GET['action'] );
            $id = mysql_real_escape_string( $_GET['id'] );
        } else {
            $action = "";
            $id = "";
        }

        function ticket_id_exists( $id = "" )
        {
            global $lgsl_database, $lgsl_config;
            $zisti = mysql_query( "SELECT * FROM `".$lgsl_config['db']['tickettable']."` WHERE ticket_id='".$id."' LIMIT 1", $lgsl_database );
            $data = mysql_fetch_assoc( $zisti );
            if($data) { return true; } else { return false; }
        }

        function phpentities($text) {
            $search = array("&", "\"", "'", "\\", "<", ">");
            $replace = array("&amp;", "&quot;", "&#39;", "&#92;", "&lt;", "&gt;");
            $text = str_replace($search, $replace, $text);
            return $text;
        }

        function show_ticket()
        {
            global $lgsl_database, $lgsl_config;

            $items_per_page = "20";

            $mysql_query[1]  = "SELECT COUNT(ticket_id) FROM `{$lgsl_config['db']['prefix']}{$lgsl_config['db']['tickettable']}` LIMIT 0, ".$items_per_page." ";
            $mysql_result = mysql_result(mysql_query($mysql_query[1], $lgsl_database), 0);

            if(isset($_GET['rowstart']) || !isset($_GET['rowstart']) && $mysql_result > $items_per_page)
            {
                $msg = "".makePageNav($_GET['rowstart'], $items_per_page, $mysql_result, 2, $_SERVER['SCRIPT_URI']."?page=ticket&amp;")."";
            }
            $msg .= "
                <div class='panel panel-default cen-p'>
                    <div class='panel-heading'><i class='fa fa-comments-o'></i> Tikety</div>
                        <table class='table table-hover'>
                            <tr>
                                <td class='text-center'>ID</td>
                                <td class='text-center'>Meno</td>
                                <td class='text-center'>E-mailis</td>
                                <td class='text-center'>Akcia</td>
                            </tr>
                ";

            if (!isset($_GET['rowstart']) || !is_numeric($_GET['rowstart'])) { $_GET['rowstart'] = 0; }
            $vyber = mysql_query( "SELECT * FROM `".$lgsl_config['db']['tickettable']."` ORDER BY ticket_id DESC LIMIT ".$_GET['rowstart'].", ".$items_per_page."", $lgsl_database);
            if(mysql_num_rows($vyber) > 0)
            {
                while($data = mysql_fetch_array($vyber))
                {

                    $msg .= "
                        <tr>
                            <td class='text-center'>".$data['ticket_id']."</td>
                            <td class='text-center'>".((strlen($data['meno']) >= 25) ? substr($data['meno'], 0, 20)."..." : $data['meno'])."</td>
                            <td class='text-center'>".((strlen($data['email']) >= 45) ? substr($data['email'], 0, 40)."..." : $data['email'])."</td>
                            <td class='text-center'><a href='/admin?page=ticket&amp;action=read&amp;id=".$data['ticket_id']."' class='border-none'>Pre��ta�</a> | <a href='/admin?page=ticket&amp;action=remove&amp;id=".$data['ticket_id']."' class='border-none'>Zmaza�</a></td>
                        </tr>";
                }
            }
            else { $msg .= "<tr><td colspan='6'><div class='text-center'><p>Zatial nikto nenapisal tiket.</p></div></td></tr>"; }
            $msg .= "
                    </table>
                </div>";
            if(isset($_GET['rowstart']) || !isset($_GET['rowstart']) && $mysql_result > $items_per_page)
            {
                $msg .= "".makePageNav($_GET['rowstart'], $items_per_page, $mysql_result, 2, $_SERVER['SCRIPT_URI']."?page=ticket&amp;")."";
            }
            return $msg;
        }

        function remove_ticket( $id = "" )
        {
            global $lgsl_database, $lgsl_config;

            $msg = "";

            if( !( ticket_id_exists( $id ) ) )
            {
                header("Refresh: 3; url=/admin?page=ticket");
                return "<div class='text-center'><p>TIKET S TAK�MTO ID NEEXISTUJE!!</p></div>";
            }

            if(isset($_POST['submit']) && !empty($_POST['ticketid']) && defined("LGSL_ADMIN") ) {
                if (!isset($_SESSION)) {
                    session_start();
                }
                $_SESSION['last_ticket_deleted'] = time();
                $ticketid = $_POST['ticketid'];
                $maz = mysql_query( "DELETE FROM `".$lgsl_config['db']['tickettable']."` WHERE `ticket_id`='".$ticketid."'", $lgsl_database);
                if($maz)
                {
                    lgsl_log("./logs/lgsl_admin_log.txt", "a", "Bol vymazan� tiket z IP: ".$_SERVER['REMOTE_ADDR']." | ID Tiketu: ".$ticketid."");
                    $msg .= "<div class='alert alert-success cen-p' role='alert'><i class='glyphicon glyphicon-ok'></i> Tiket bol �spe�ne vymazan� !</div>";
                }
                else
                {
                    $msg .= "<div class='text-center'><p>Nastala chyba pri mazan� tiketu.</p></div>";
                }
                header("Refresh: 3; url=/admin?page=ticket");
                return $msg;
            }

            $msg .= "
                <div class='panel panel-default cen-p'>
                    <div class='panel-heading'><i class='fa fa-comments-o'></i> Odstr�nenie tiketu</div>
                        <div class='panel-body'>
                            <form name='inputform' method='post' action='".$_SERVER['REQUEST_URI']."'> 	
                                <input name='ticketid' size='0' value='".$id."' type='hidden' required='required' />
                                <div class='alert alert-danger' role='alert'><i class='fa fa-exclamation-triangle'></i> Pr�ve sa chyst� zmaza� tiket s ID: ".$id." po zmazan� tohto tiketu nebude mo�n� ho obnovi�, si si ist� �e chce� tento tiket vymaza�?</div>
                                <input name='submit' value='Zmaza�' type='submit' class='btn btn-success' />&nbsp;<input type='button' class='btn btn-danger' value='Zru�i�' onclick=\"location.href='/admin?page=ticket';\" />
                            </form>
                        </div>
                </div>";
            return $msg;
        }

        function read_ticket( $id = "" )
        {
            global $lgsl_database, $lgsl_config;

            $msg = "";

            if( !( ticket_id_exists( $id ) ) )
            {
                header("Refresh: 3; url=/admin?page=ticket");
                return "<div class='text-center'><p>TIKET S TAK�MTO ID NEEXISTUJE!!</p></div>";
            }

            $vyber = mysql_query( "SELECT * FROM `".$lgsl_config['db']['tickettable']."` WHERE ticket_id='".$id."'", $lgsl_database);
            $data = mysql_fetch_assoc( $vyber );

            if(isset($_POST['email'])) {

                // Priimate�
                $email_to = "".$data['email']."";
                $email_subject = "Flactor.eu | Odpove�";

                function died($error) {
                    echo "We are very sorry, but there were error(s) found with the form you submitted. ";
                    echo "These errors appear below.<br /><br />";
                    echo $error."<br /><br />";
                    echo "Please go back and fix these errors.<br /><br />";
                    die();
                }

                if(!isset($_POST['first_name']) ||
                    !isset($_POST['email']) ||
                    !isset($_POST['telephone']) ||
                    !isset($_POST['comments'])) {
                    died('We are sorry, but there appears to be a problem with the form you submitted.');
                }

                $first_name = $_POST['first_name'];
                $email_from = $_POST['email'];
                $telephone = $_POST['telephone'];
                $comments = $_POST['comments'];

                $error_message = "";

                if(strlen($comments) < 2) {
                    $error_message .= 'The Comments you entered do not appear to be valid.<br />';
                }

                if(strlen($error_message) > 0) {
                    died($error_message);
                }

                function clean_string($string) {
                    $bad = array("content-type","bcc:","to:","cc:","href");
                    return str_replace($bad,"",$string);
                }


                $email_message = "
                <style>
                a {color:#dcbf3a;text-decoration:none;}
                a:hover {color:#dcbf3a;text-decoration:underline;}
                </style>
                <html>
                    <head>
                        <title>Flactor.eu Servelist</title>
                    </head>
                    <body>
                        <table width='744' align='center' cellpadding='0' cellspacing='0' >
                            <tr style='background:#192a3e;color:#dcbf3a;height:20px;'>
                                <td style='padding-left:20px;padding-right:10px;'>www.Flactor.eu Serverlist</td>
                                <tr>
                                    <td colspan='2'><img src='http://flactor.eu/img/email.png' /></td>
                                </tr>
                            </tr>
                        </table>
                        <table width='700' align='center' cellpadding='0' cellspacing='0' >
                            <tr>
                                <td><br/></td>
                            </tr>
                            <tr>
                                <td><li><b>ID Tiketu:</b> ".$data['ticket_id']."</li></td>
                            </tr>
                            <tr>
                                <td><li><b>Va�e meno:</b> ".$data['meno']."</li></td>
                            </tr>
                            <tr>
                                <td><li><b>Va� E-Mail:</b> ".$data['email']."</li></td>
                            </tr>
                            <tr>
                                <td><li><b>Zvolen� ID Servera:</b> ".$data['predmet']."</li></td>
                            </tr>
                            <tr>
                                <td><li><b>Va�a ot�zka:</b> <i>".$data['sprava']."</i></li></td>
                            </tr>
                            <tr>
                                <td><br/></td>
                            </tr>
                            <tr>
                                <td><b>Na�a odpove�:</b> ".clean_string($comments)."</td>
                            </tr>
                            <tr>
                                <td><br/></td>
                            </tr>
                            <tr>
                                <td><br/></td>
                            </tr>
                        </table>
                        <table style='background:#192a3e;color:#dcbf3a;' width='600' height='35' align='center'>
                            <tr>
                                <td><img src='http://flactor.eu/images/logo_white.png' style='width:100px;height:30px;' /></td>
                                <td>
                                <a href='http://flactor.eu/'>Zoznam serverov</a> | 
                                <a href='http://flactor.eu/pridat'>Prida� server</a> | 
                                <a href='http://flactor.eu/pravidla'>Pravidl�</a> | 
                                <a href='http://flactor.eu/kontakt'>Kontakt</a> | 
                                <a href='http://flactor.eu/podporte_nas'>Podporte n�s</a>
                                </td>
                            </tr>
                        </table>
                    </body>
                </html>";

                $headers = 'From: '.$email_from."\r\n".
                    $headers .= 'Content-type: text/html; charset=Windows-1250' . "\r\n";
                'Reply-To: '.$email_from."\r\n" .
                'X-Mailer: PHP/' . phpversion();
                @mail($email_to, $email_subject, $email_message, $headers);
            }

            $msg .= "
                    <div class='panel panel-default cen-p'>
                    <div class='panel-heading'><i class='fa fa-comment'></i> Odpove� na tiket s id #".$data['ticket_id']."</div>
                        <div class='panel-body text-center'>
    
                            <div class='alert alert-info' role='alert'> M�te otvoren� tiket s ID: ".$data['ticket_id']."</div>
                        
                            <form class='form-horizontal' role='form' name='contactform' method='post'>
                        
                                <div class='form-group'>
                                    <label class='col-sm-3 control-label'>Meno</label>
                                    <div class='col-sm-5'>
                                        ".$data['meno']."
                                    </div>
                                </div>
                                
                                <div class='form-group'>
                                    <label class='col-sm-3 control-label'>E-Mail</label>
                                    <div class='col-sm-5'>
                                        ".$data['email']."
                                    </div>
                                </div>
                                
                                <div class='form-group'>
                                    <label class='col-sm-3 control-label'>ID Server</label>
                                    <div class='col-sm-5'>
                                        ".$data['predmet']."
                                    </div>
                                </div>
                                
                                <div class='form-group'>
                                    <label class='col-sm-3 control-label'>Spr�va</label>
                                    <div class='col-sm-5'>
                                        ".$data['sprava']."
                                    </div>
                                </div>
                                
                        <div class='hide'>
                                
                                <div class='form-group'>
                                    <label class='col-sm-3 control-label'>Meno</label>
                                    <div class='col-sm-5'>
                                        <input class='form-control' value='".$data['meno']."' type='text' name='first_name'>
                                    </div>
                                </div>
                                
                                <div class='form-group'>
                                    <label class='col-sm-3 control-label'>E-Mail</label>
                                    <div class='col-sm-5'>
                                        <input value='info@flactor.eu' type='text' name='email' class='form-control'>
                                    </div>
                                </div>
                                
                                <div class='form-group'>
                                    <label class='col-sm-3 control-label'>ID Server</label>
                                    <div class='col-sm-5'>
                                        <input value='".$data['predmet']."' type='text' name='telephone' class='form-control'>
                                    </div>
                                </div>
                        </div>
                                
                                <div class='form-group'>
                                    <label class='col-sm-3 control-label'>Spr�va</label>
                                    <div class='col-sm-5'>
                                        <textarea  name='comments' class='form-control'></textarea>
                                    </div>
                                </div>
    
                                <input type='submit' class='btn btn-success' value='Posla�'>
                            
                            </form>
                        </div>
                    </div>";
            return $msg;
        }


        function ticket_action( $action = "" )
        {
            global $id;
            switch( $action )
            {
                case "remove":
                    return remove_ticket ( $id );
                    break;
                case "read":
                    return read_ticket ( $id );
                    break;
                default:
                    return show_ticket( );
                    break;
            }
        }
        $output .= ticket_action( $action );
    }
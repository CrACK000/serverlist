<?php

    require 'vendor/autoload.php';
    require 'lgsl_files/lgsl_class.php';

    echo '
	<!DOCTYPE html>
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="sk" lang="sk">
		<head>';

            require 'template/template_headtags.php';

        echo '
		</head>
		<body>';

            require 'template/template_head.php';

            echo '
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-9 p-5 pl-body-scroll">
                    
                        <ol class="breadcrumb">
                            <i class="fas fa-file-alt mx-4" style="font-size: 18px;margin-top: 9px;color: #839aed"></i>
                            <li class="breadcrumb-item"><a href="'.URL.'/index">Index</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Kontakt</li>
                        </ol>';

                        $predmet    = empty($_POST['predmet'])  ? "" :        trim($_POST['predmet']);
                        $sprava     = empty($_POST['sprava'])   ? "" :        trim($_POST['sprava']);

                        if ($auth->isLoggedIn()) {

                            $email = $auth->getEmail();
                            $meno  = $auth->getUsername();

                        } else {

                            $email = empty($_POST['email'])     ? "" :  trim($_POST['email']);
                            $meno  = empty($_POST['meno'])      ? "" :  trim($_POST['meno']);

                        }

                        if (isset($_POST['odoslat'])) {

                            $mysql_result = $db->insert(
                                $lgsl_config['db']['tickettable'],
                                [
                                    'meno'      => $meno,
                                    'email'     => $email,
                                    'predmet'   => $predmet,
                                    'sprava'    => $sprava
                                ]
                            );

                            if ($mysql_result) {

                                $message = "<div class='alert alert-pl' role='alert'>Správa bola odoslaná. Za pár sekúnd budete presmerovaný na hlavnú stránku.</div>";

                            }
                        }
                    
                        if ($message){
                            header("Refresh: 3; url=" . URL . "/index");
                            echo $message;
                        }

                        echo '
                        <form method="post" action="' . URL . '/kontakt">';

                            if (!$auth->isLoggedIn()) {

                                echo '
                                <div class="form-group mt-5">
                                    <label for="name">Vaše meno</label>
                                    <input type="text" class="form-control" name="meno" id="name" required placeholder="Carl Johnson">
                                </div>
                                
                                <div class="form-group">
                                    <label for="e">Kontaktný email</label>
                                    <input type="email" class="form-control" name="email" id="e" required aria-describedby="emailHelp" placeholder="name@example.com">
                                    <small id="emailHelp" class="form-text">Na zadaný email odošleme odpoveď.</small>
                                </div>';

                            }

                            echo '
                            <div class="form-group mt-5">
                                <label for="i">ID vašich servérov</label>
                                <input type="text" class="form-control" name="predmet" id="i" required aria-describedby="serverHelp" placeholder="223, 156, ...">
                                <small id="serverHelp" class="form-text">Ak máte viac serverov, oddelujte id "," (čiarkamy).</small>
                            </div>
                            
                            <div class="form-group">
                                <label for="s">Správa</label>
                                <textarea class="form-control" name="sprava" id="s" rows="4" required placeholder="Sem napište správu..."></textarea>
                            </div>
                            
                            <div class="form-group text-right">
                                <button type="submit" name="odoslat" class="button"><i class="fas fa-paper-plane mr-3"></i> Odoslať</button>
                            </div>
                            
                        </form>';

                        require 'template/template_footer.php';

                    echo '
                    </div>
                    <div class="col-md-3">';

                        require 'template/panels/panel_left.php';

                    echo '
                    </div>
                </div>
		    </div>';

            require 'template/template_scripts.php';

        echo '
        </body>
	</html>';
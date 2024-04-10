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
                            <li class="breadcrumb-item active" aria-current="page">Podporte nás</li>
                        </ol>
                        
                        <div class="text-center mt-5">
                            <p>Ikonka 88x31px</p>
                            <img src="'.URL.'/assets/img/icon88x31.png" alt="Ikonka88x31" class="img-thumbnail">
                            <p class="mt-2 mx-auto" style="max-width: 70%;"><samp>&#60;a target="_blank" href="https://serverlist.pallax.systems"&#62;&#60;img src="https://serverlist.pallax.systems/assets/img/icon88x31.png" alt="pallax.systems - Serverlist" title="pallax.systems - Serverlist" width="88" height="31"&#62;&#60;/a&#62;</samp></p>
                        </div>';

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
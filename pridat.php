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
                            <li class="breadcrumb-item active" aria-current="page">Pridať server</li>
                        </ol>';

                        global $output;
                        $output = "";
                        require "lgsl_files/lgsl_add.php";
                        echo $output;
                        unset($output);

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
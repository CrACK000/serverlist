<?php

	require "lgsl_files/lgsl_class.php";
	lgsl_database();

	$udrzba_query = mysql_query("SELECT * FROM `".$lgsl_config['db']['settingstable']."` WHERE `settings_id`='1'");
	$data_udrzba = mysql_fetch_assoc( $udrzba_query );

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
            <div class="container">
                <div class="row">
                    <div class="col-md-4">';

                    require 'template/panels/panel_left.php';

		            echo '
                    </div>
                    <div class="col-md-8">';

                        if ($data_udrzba['settings_active'] == 1) {
                            echo '<div class="alert alert-warning" role="alert">Mód údržby je zapnuty.</div>';
                        }

                        global $output;
                        $output = "";
                        require "app/app_news";
                        echo $output;

		            echo '
                    </div>
                </div>
		    </div>';

            require 'template/template_footer.php';

			echo '
		</body>
	</html>';
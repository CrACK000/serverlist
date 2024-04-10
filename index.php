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
                    <div class="col-md-9 p-0 pl-body-scroll">';

                        global $output;
                        $output = "";
                        require "lgsl_files/lgsl_list.php";
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
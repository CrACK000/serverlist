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
                            <li class="breadcrumb-item active" aria-current="page">Balíčky</li>
                        </ol>
                        
                        <table class="table table-pl-dark my-5">
                            <thead>
                                <th width="40%"></th>
                                <th width="15%" class="text-center">Basic</th>
                                <th width="15%" class="text-center">Standard</th>
                                <th width="15%" class="text-center">Plus</th>
                                <th width="15%" class="text-center"><i class="far fa-star gold-text"></i> Premium</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-right">User API</td>
                                    <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                                    <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                                    <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                                    <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                </tr>
                                <tr>
                                    <td class="text-right">Server API</td>
                                    <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                                    <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                                    <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                    <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                </tr>
                                <tr>
                                    <td class="text-right">Pokročilé štatistiky</td>
                                    <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                                    <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                                    <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                    <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                </tr>
                                <tr>
                                    <td class="text-right">Štatistiky</td>
                                    <td class="text-center"><i class="fas fa-times text-danger"></i></td>
                                    <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                    <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                    <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                </tr>
                                <tr>
                                    <td class="text-right">Počet serverov v top zozname</td>
                                    <td class="text-center font-weight-bold">1</td>
                                    <td class="text-center font-weight-bold">2</td>
                                    <td class="text-center font-weight-bold">4</td>
                                    <td class="text-center font-weight-bold">6</td>
                                </tr>
                                <tr>
                                    <td class="text-right">Cena za mesiac</td>
                                    <td class="text-center">2,49€</td>
                                    <td class="text-center">4,49€</td>
                                    <td class="text-center">5,99€</td>
                                    <td class="text-center">6,99€</td>
                                </tr>
                                <tr>
                                    <td class="text-right"></td>
                                    <td class="text-center"><button class="button-sm btn-block" style="height: 30px"><i class="fas fa-shopping-cart mr-1"></i> Kúpiť teraz</button></td>
                                    <td class="text-center"><button class="button-sm btn-block" style="height: 30px"><i class="fas fa-shopping-cart mr-1"></i> Kúpiť teraz</button></td>
                                    <td class="text-center"><button class="button-sm btn-block" style="height: 30px"><i class="fas fa-shopping-cart mr-1"></i> Kúpiť teraz</button></td>
                                    <td class="text-center"><button class="button-sm btn-block" style="height: 30px"><i class="fas fa-shopping-cart mr-1"></i> Kúpiť teraz</button></td>
                                </tr>
                            </tbody>
                        </table>';

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
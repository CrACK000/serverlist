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
                            <li class="breadcrumb-item active" aria-current="page">Pravidlá</li>
                        </ol>
                        
                        <div class="col-md-11 mx-auto mt-4">
                        
                            <h3 style="font-weight: 300;">Pridávanie serverov</h3>
                            
                            <ul class="pl-rules">
                                <li>
                                    Server ktorý pridávate do databázy musí byť funkčný, musí mať názov ktorý obsahuje 
                                    adresu webu pod ktorý patrí. Ak server bude offline viac ako 24 hodín nebude schválený. 
                                    Ak v názve nebude URL adresa webu server nebude schválený a bude odstránený.<br>
                                    Príklad názvu servera: <samp>Example.com^ Dust2 Only [VIP ZADARMO]</samp>
                                </li>
                                <li>
                                    Pre úspešné pridanie servera do databázy od vás požadujeme, 
                                    aby ste na úvodnú stránku umiestnili spätný odkaz na náš web 
                                    https://serverlist.pallax.systems a to buď formou textového odkazu, alebo 
                                    ikonky (spätný odkaz musí odkazovať na serverlist.pallax.systems, napr.: https://serverlist.pallax.systems/). 
                                    Ikonky nájdete na stránke <a href="'.URL.'/podporte_nas">Podporte nás</a>
                                </li>
                                <li>
                                    U serverov zadávajte správne herný mód. Servery, u ktorých nebude 
                                    zadaný mód zodpovedať skutočnosti nebudú do databázy pridané. 
                                    Ak vlastníte server s herným módom, ktorý nie je v našom zozname, 
                                    pridajte ho do kategórie Other.
                                </li>
                                <li>
                                    Je zakázané pridávať servery ktoré nevlastníte alebo nie ste ich 
                                    správca alebo ste neboli poverený starať sa o populáciu serverov. 
                                    Ak budete pridávať servery ktoré nie sú vaše, a bude to brániť pravým 
                                    majiteľom serveru váš účet bude zablokovaný a už sa nebudete môcť registrovať.
                                </li>
                            </ul>
                            
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
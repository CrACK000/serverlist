<?php

require '../vendor/autoload.php';
require '../lgsl_files/lgsl_class.php';

$url = 'https://serverlist.pallax.systems/api/user/1';
$data = file_get_contents($url);
$json = json_decode($data);

$text = '<?php

$url = \'https://serverlist.pallax.systems/api/user/*ID*\'; // Na miesto *ID* zadajte vaše užívatelské ID
$data = file_get_contents($url);
$json = json_decode($data);

echo \'
<table class="table table-bordered table-hover">
    <thead class="thead-dark">
        <tr>
            <th>Hra</th>
            <th>Názov servera</th>
            <th>IP:Port</th>
            <th>Mapa</th>
            <th>Hráči</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>\';
        foreach ($json as $result) {
            echo \'
            <tr>
                <td><img class="mr-2" src="\' . $result->s_urlicon . \'" alt="\' . $result->s_game . \'">\' . $result->s_game . \'</td>
                <td>\' . $result->s_name . \'</td>
                <td>\' . $result->s_ip . \':\' . $result->s_cport . \'</td>
                <td>\' . $result->s_map . \'</td>
                <td>\' . $result->s_players . \'/\' . $result->s_maxplayers . \'</td>
                <td>\' . $result->s_status . \'</td>
            </tr>\';
        }
        echo \'
    </tbody>
</table>\';';

echo '
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="sk" lang="sk">
    <head>
        <title>Example - pallax.systems</title>
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
        <link rel="icon" type="image/x-icon" href="https://serverlist.pallax.systems/assets/img/favicon.png?v=1.0.0"/>
        <link rel="stylesheet" href="https://serverlist.pallax.systems/assets/css/normalize.css?v=7.0.0">
        <link rel="stylesheet" href="https://serverlist.pallax.systems/assets/css/bootstrap.min.css?v=4.0.0">
        <link rel="stylesheet" href="https://serverlist.pallax.systems/assets/css/codestyles/atelier-sulphurpool-dark.css">
    </head>
    <body>

        <p class="mt-1 display-4 text-center">Náhľad</p>

        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Hra</th>
                    <th>Názov servera</th>
                    <th>IP:Port</th>
                    <th>Mapa</th>
                    <th>Hráči</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>';
                foreach ($json as $result) {
                    echo '
                    <tr>
                        <td><img class="mr-2" src="' . $result->s_urlicon . '" alt="' . $result->s_game . '">' . $result->s_game . '</td>
                        <td>' . $result->s_name . '</td>
                        <td>' . $result->s_ip . ':' . $result->s_cport . '</td>
                        <td>' . $result->s_map . '</td>
                        <td>' . $result->s_players . '/' . $result->s_maxplayers . '</td>
                        <td>' . $result->s_status . '</td>
                    </tr>';
                }
                echo '
            </tbody>
        </table>
        
        <p class="mt-5 display-4 text-center">Kód</p>
        <p class="text-center">Kód ktorý vybere data z vašich serverov a zobrazí ich v tabulke ktorá je nastajlovaná na Bootsrap.</p>
        
        <pre class="mb-0"><code class="php px-5">' . htmlcode($text) . '</code></pre>
        
        <script type="text/javascript" src="https://serverlist.pallax.systems/assets/js/jquery-3.2.1.min.js?v=3.2.1"></script>
        <script type="text/javascript" src="https://serverlist.pallax.systems/assets/js/bootstrap.min.js?v=4.0.0"></script>
        <script type="text/javascript" src="https://serverlist.pallax.systems/assets/js/bootstrap.bundle.min.js?v=4.0.0"></script>
        <script type="text/javascript" src="https://serverlist.pallax.systems/assets/js/highlight.pack.js"></script>
        
        <script>hljs.initHighlightingOnLoad();</script>
    </body>
</html>';
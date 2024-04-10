<?php

    if(isset($_GET['page']) && $_GET['page'] == "logs") {
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
            $id = $_GET['id'];
        } else {
            $action = "";
            $id = "";
        }

        function show_logs( )
        {

            $msg = '';

            $msg .= '
            <ol class="breadcrumb">
                <i class="fas fa-file-alt mx-4" style="font-size: 18px;margin-top: 9px;color: #839aed"></i>
                <li class="breadcrumb-item"><a href="'.URL.'/index">Index</a></li>
                <li class="breadcrumb-item"><a href="'.URL.'/admin">Administrácia</a></li>
                <li class="breadcrumb-item active" aria-current="page">Logy</li>
            </ol>';

            $msg .= '
            <ul class="nav small mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="pills-1-tab" data-toggle="pill" href="#pills-1" role="tab" aria-controls="pills-1" aria-selected="true">Prihlásenia</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-2-tab" data-toggle="pill" href="#pills-2" role="tab" aria-controls="pills-2" aria-selected="false">Administrácia</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-3-tab" data-toggle="pill" href="#pills-3" role="tab" aria-controls="pills-3" aria-selected="false">Registrácia</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-4-tab" data-toggle="pill" href="#pills-4" role="tab" aria-controls="pills-4" aria-selected="false">Pridávanie serverov</a>
                </li>
            </ul>
            
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-1" role="tabpanel" aria-labelledby="pills-1-tab">
                    <iframe style="background: rgba(0,0,0,0.1);width: 100%;height: 350px;border: none;" class="rounded" src="'.URL.'/logs/login_MQHo5kMzJYbtkv0jNuExyKeF3URdJKtGhgLfGLf4CnfoxsjAvA.txt"></iframe>
                </div>
                <div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-2-tab">
                    <iframe style="background: rgba(0,0,0,0.1);width: 100%;height: 350px;border: none;" class="rounded" src="'.URL.'/logs/admin_kSIHmqVOIGYUXPQTwYpqjfSUGGBWClxFKVI0vjcKZLXWyP03CT.txt"></iframe>
                </div>
                <div class="tab-pane fade" id="pills-3" role="tabpanel" aria-labelledby="pills-3-tab">
                    <iframe style="background: rgba(0,0,0,0.1);width: 100%;height: 350px;border: none;" class="rounded" src="'.URL.'/logs/register_xAv0bPhaSjV6BiiG5qEBq7nmq6oOO4K7A2MPRUlAQj1MBFDhUJ.txt"></iframe>
                </div>
                <div class="tab-pane fade" id="pills-4" role="tabpanel" aria-labelledby="pills-4-tab">
                    <iframe style="background: rgba(0,0,0,0.1);width: 100%;height: 350px;border: none;" class="rounded" src="'.URL.'/logs/addserver_XWRqPXNg75F62DlanXwIC9nPIkfoZLqFfg0EhNLLl9RwSdZwhB.txt"></iframe>
                </div>
            </div>';

            return $msg;
        }

        function logs_action( $action = "" )
        {
            switch( $action )
            {
                default:
                    return show_logs( );
                    break;
            }
        }
        $output .= logs_action( $action );
    }
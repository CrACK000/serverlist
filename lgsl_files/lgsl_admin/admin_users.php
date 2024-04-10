<?php

    if(isset($_GET['page']) && $_GET['page'] == "users") {

        if (isset($_GET['action'])) {
            $action = $_GET['action'];
            $id = $_GET['id'];
        } else {
            $action = "";
            $id = "";
        }

        function show_all_users()
        {

            global $db, $lgsl_config;

            $msg = '';

            $msg .= '
            asd';

            return $msg;

        }

        function admin_users($action = "")
        {

            switch ($action) {

                default:
                    return show_all_users();
                    break;

            }

        }

        $output .= admin_users($action);

    }
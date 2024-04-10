<?php

    $lgsl_type_list = lgsl_type_list();
    unset($lgsl_type_list['test']);
    asort($lgsl_type_list);

    $lgsl_list_mods = lgsl_list_mods();

    $mody['halflife'] = lgsl_list_halflife();
    asort($mody['halflife']);

    $mody['csgo'] = lgsl_list_csgo();
    asort($mody['csgo']);

    $mody['source'] = lgsl_list_source();
    asort($mody['source']);

    $mody['minecraft'] = lgsl_list_minecraft();
    asort($mody['minecraft']);

    $mody['samp'] = lgsl_list_samp();
    asort($mody['samp']);

    $mody['ts3'] = lgsl_list_ts3();
    asort($mody['ts3']);

    echo '
    <li class="nav-item small mt-5">
        Filter
    </li>';

    foreach ($lgsl_type_list as $key => $value) {

        echo '
        <li class="nav-item">
        
            <a class="nav-link" data-toggle="collapse" href="#' . $value . '" role="button" aria-expanded="false" aria-controls="' . $value . '">
                <i class="fas fa-angle-right mr-3 small"></i> <i class="fas fa-file mr-3 small"></i>
                ' . ((strlen($value) >= 25) ? substr($value, 0, 25) . ".." : $value) . '
            </a>
            
            <div class="collapse" id="' . $value . '">
            
                <ul class="nav flex-column ml-5">';

                    foreach ($mody[$key] as $typemod => $modname) {

                        echo '
                        <li class="nav-item">
                            <a class="nav-link" href="' . URL . '/index?type=' . $key . '&mod=' . $typemod . '">' . $modname . '</a>
                        </li>';

                    }

                echo '
                </ul>
            </div>
        </li>';

    }
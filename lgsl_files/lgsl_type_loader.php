<?php

    require "lgsl_protocol.php";

    $lgsl_type_list     = lgsl_type_list();

    unset($lgsl_type_list['test']);
    asort($lgsl_type_list);

    $lgsl_list_mods     = lgsl_list_mods();

    $mody['halflife']   = lgsl_list_halflife();
                        asort($mody['halflife']);

    $mody['csgo']       = lgsl_list_csgo();
                        asort($mody['csgo']);

    $mody['source']     = lgsl_list_source();
                        asort($mody['source']);

    $mody['minecraft']  = lgsl_list_minecraft();
                        asort($mody['minecraft']);

    $mody['samp']       = lgsl_list_samp();
                        asort($mody['samp']);

    $mody['ts3']        = lgsl_list_ts3();
                        asort($mody['ts3']);

    foreach ($mody[$_GET['type']] as $typemod => $modname) {

        $selected   = $_POST['form_type'].'.'.$_POST['form_zone'];

        echo '<option '.($selected == $typemod ? 'selected' : '').' value="' . $typemod . '"> ' . $modname . ' </option>';

    }
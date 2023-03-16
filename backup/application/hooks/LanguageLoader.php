<?php

class LanguageLoader
{
    function initialize() {
        $ci =& get_instance();
        $ci->load->helper('language');

        $controller = strtolower($ci->router->fetch_class());

        $siteLang = $ci->session->userdata('site_lang');
        if ( ! $siteLang) {
            $siteLang = 'english';
        }
        if($controller != "crons"){
            $ci->lang->load($controller,$siteLang);
            $ci->lang->load('common',$siteLang);
        }
    }
}
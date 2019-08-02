<?php

if (!function_exists('app')) {
    /**
     * Get current CI instance
     *
     * @param string $type [name of method or property of class]
     *
     * @return object
     */
    function app($type = null)
    {
        $CI =& get_instance();
        // CI not initialized yet if hook 'pre_controller' is running.
        // So, we will initialize it manually
        if (empty($CI)) {
            $CI = new CI_Controller();
        }
        return !is_string($type) || !$type ? $CI : $CI->$type;
    }
}

if (!function_exists('isApi')) {
    /**
     * Check the current url whether it is the restful api
     *
     * @return bool
     */
    function isApi()
    {
        $pattern = '#^'.(Constant::PREFIX_API ?? 'api').'#i';
        return preg_match($pattern, app()->uri->uri_string()) === 1;
    }
}

// function getLang()
// {
//     $idiom = app()->session->get_userdata('language');
//     $this->lang->load('error_messages', $idiom);
//     $oops = $this->lang->line('message_key');
// }

// function setLang()
// {

// }

// function trans($key, $lang = 'en')
// {

// }

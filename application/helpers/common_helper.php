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

if (!function_exists('currentLang')) {
    /**
     * Get the current language
     *
     * @return string
     */
    function currentLang()
    {
        return app()->config->item('language');
    }
}

if (!function_exists('setLang')) {
    /**
     * Set language
     *
     * @param  string $lang
     *
     * @return void
     */
    function setLang($lang)
    {
        app()->config->set_item('language', $lang);
    }
}

if (!function_exists('trans')) {
    /**
     * Translate content of language to the specified language
     *
     * @param  string $key
     * @param  string|array $filenames
     * @param  string $lang
     *
     * @return string|null
     */
    function trans($key, $filenames = null, $lang = null)
    {
        $currentLang = $lang ?: currentLang();
        if (!empty($filenames)) {
            // get only the language data of the specified languages withnot changing the system language data before
            $dataLang = (function ($currentLang, $filenames) {
                $lang = [];
                $filenames = is_array($filenames) ? $filenames : [$filenames];
                foreach ($filenames as $filename) {
                    include(APPPATH.'language/'.$currentLang.'/'.$filename.'_lang.php');
                }
                return $lang;
            })($currentLang, $filenames);
            return $dataLang[$key] ?? null;
        }
        $result = app()->lang->line($key);
        return  $result === false ? null : $result;
    }
}

if (!function_exists('throwException')) {
    /**
     * Throw exception
     *
     * @param  string $message
     *
     * @return void
     * @throws \Exception
     */
    function throwException($message)
    {
        throw new \Exception($message);
    }
}

<?php
/**
 * Set the system language based on the request headers
 * Setup in hook
 * Called very early during system execution.
 * Only the benchmark and hooks class have been loaded at this point.
 * No routing or other processes have happened
 *
 * Php version 7.0.0
 *
 * @category Description
 * @package  Category
 * @author   Name <email@email.com>
 * @license  MIT <http://url-to-license.com>
 * @version  GIT 1.0.0 | SVN: 1.0.0 | CVS: 1.0.0
 * @link     http://url.com
 */
defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Set the system language based on the request headers
 *
 * @category Description
 * @package  Category
 * @author   Name <email@email.com>
 * @license  MIT <http://url-to-license.com>
 * @link     http://url.com
 */
class SetLanguage
{
    /**
     * Handle the incomming request
     *
     * @return void
     */
    public function handle()
    {
        $this->_setLang();
    }

    /**
     * Set the system language from the request headers
     *
     * @return void
     * @throws \Exception
     */
    private function _setLang()
    {
        $headers = getallheaders();
        $config  =& load_class('Config', 'core');
        $keyLang = Constant::LANG_KEY;

        // If the key 'Lang' exists in request headers, check it in the supported languages.
        // Otherwise, get the dedault language
        if (!array_key_exists($keyLang, $headers)) {
            $currentLang = $config->item('default_language') ?? $config->item('language');
        } else {
            $currentLang = $headers[$keyLang];
            $supportedLangs = $config->item('supported_languages');
            if (!empty($supportedLangs) && !in_array($headers[$keyLang], $supportedLangs)) {
                throwException('Only supported languages: ['.implode(', ', $supportedLangs).']');
            }
        }

        $config->set_item('language', $currentLang);
    }
}

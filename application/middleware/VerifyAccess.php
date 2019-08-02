<?php
/**
 * <File description>
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

require_once APPPATH.'traits/ApiResponse.php';
require_once APPPATH.'common/Crypt.php';

/**
 * Verify access to system based on X-API-TOKEN on request headers
 *
 * @category Description
 * @package  Category
 * @author   Name <email@email.com>
 * @license  MIT <http://url-to-license.com>
 * @link     http://url.com
 */
class VerifyAccess
{
    use ApiResponse;

    /**
     * Handle the incomming request
     *
     * @return void
     */
    public function handle()
    {
        $CI = app()->load->library('session');
        var_dump($CI->session);die();
        var_dump(app()->lang->get_userdata('language'));die();
        if (isApi()) {
            $headers = app()->input->request_headers();
            if (!isset($headers[Constant::X_API_TOKEN_KEY])) {
                return $this->responseError('Missing Token on Header', Response::HTTP_NOT_FOUND);
            }
            $token = $headers[Constant::X_API_TOKEN_KEY];
            if (!in_array($token, $this->_tokensAllowed()) || !$this->_validatePayload($token)) {
                return $this->responseError('Token is invalid', Response::HTTP_BAD_REQUEST);
            }
        }
    }

    /**
     * Get tokens allowed (only for api)
     *
     * @return array
     */
    private function _tokensAllowed()
    {
        return [
            'b30e831848cc6c7d9cf06aecde6a59527849aee8727c6a6644f28e40ec1ce080', // localhost
            '0ef618e0f58ee1f90b0e59d6c5611a7a8a384cc17255a99480593850ed4d0fae'  // 127.0.0.1
        ];
    }

    /**
     * Check payload of the encrypted string
     *
     * @param  string $strEncrypted
     *
     * @return bool
     */
    private function _validatePayload($strEncrypted)
    {
        $currentHost = explode(':', app()->input->get_request_header('Host', true));
        return Crypt::encrypt(array_shift($currentHost)) == $strEncrypted;
    }
}

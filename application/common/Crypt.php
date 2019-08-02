<?php

class Crypt
{
    private static $_secret = 'qMZaTV8tZrHskS0P8xoonrFXsWaFio0p';
    private static $_delimeter = '.';

    /**
     * Encrypt the given string
     *
     * @param  string $str
     *
     * @return string
     */
    public static function encrypt($str)
    {
        return hash_hmac('sha256', $str, self::$_secret);
    }

    /**
     * Decrypt the encrypted string
     *
     * @param  string $strEncrypted
     *
     * @return mixed
     */
    public static function decrypt($strEncrypted)
    {
        //
    }
}

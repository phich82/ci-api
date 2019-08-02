<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|    https://codeigniter.com/user_guide/general/hooks.html
|
*/
// This hook will run 1st
$hook['pre_system'][] = [
    'class'    => 'SetLanguage',
    'function' => 'handle',
    'filename' => 'SetLanguage.php',
    'filepath' => 'middleware',
    'params'   => []
];

// This hook will run 2nd
$hook['pre_controller'][] = [
    'class'    => 'VerifyAccess',
    'function' => 'handle',
    'filename' => 'VerifyAccess.php',
    'filepath' => 'middleware',
    'params'   => []
];

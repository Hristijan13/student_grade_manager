<?php
/**
 * PHPMailer SPL Autoloader compatible with PHP 7 and PHP 8
 */
function PHPMailerAutoload($classname)
{
    $filename = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'class.' . strtolower($classname) . '.php';
    if (is_readable($filename)) {
        require $filename;
    }
}

// Register using modern spl_autoload_register as required by PHP 8
spl_autoload_register('PHPMailerAutoload');
?>
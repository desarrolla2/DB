<?php

/**
 * This file is part of the D2Cache proyect.
 * 
 * Description of AdapterNotSetException
 *
 * @author : Daniel González Cerviño <daniel.gonzalez@ideup.com>
 * @file : AdapterNotSetException.php , UTF-8
 * @date : Sep 4, 2012 , 4:06:46 PM
 */

namespace Desarrolla2\DB\Exception;

class AdapterNotSetException extends \Exception
{

    public function __construct($message, $code, $previous)
    {
        $_message = 'Adapter not set';
        if ($message) {
            $_message .= ' ( ' . $message . ' )';
        }
        parent::__construct($_message, $code, $previous);
    }

}
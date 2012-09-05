<?php

/**
 * This file is part of the DB proyect.
 * 
 * Description of DumperInterface
 *
 * @author : Daniel González <daniel.gonzalez@freelancemadrid.es> 
 * @file : DumperInterface.php , UTF-8
 * @date : Sep 5, 2012 , 9:23:08 PM
 */

namespace Desarrolla2\DB;

interface DumperInterface
{

    /**
     * 
     * @param string $filename
     */
    public function dump($filename);

    /**
     * 
     * @param string $filename
     */
    public function load($filename);

    /**
     * @param string $key
     * @param string $value
     */
    public function setOption($key, $value);

    /**
     * @param array $options
     */
    public function setOptions($options = array());
}

<?php

/**
 * This file is part of the DB proyect.
 * 
 * Description of connection
 *
 * @author : Daniel González <daniel.gonzalez@freelancemadrid.es> 
 * @file : connection.php , UTF-8
 * @date : Sep 5, 2012 , 10:57:01 PM
 */
require __DIR__ . '/../vendor/autoload.php'; //generate by composer

use Desarrolla2\DB\DB;
use Desarrolla2\DB\Adapter\MySQL;

$db = new DB;
$db->setAdaper(new MySQL);

$db->setOptions(array(
    'database' => '', 'username' => '',
    'hostname' => '', 'password' => ''
));

$db->connect();

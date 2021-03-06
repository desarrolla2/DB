<?php

/**
 * This file is part of the DB proyect.
 * 
 * Description of DBInterface
 *
 * @author : Daniel González <daniel.gonzalez@freelancemadrid.es> 
 * @file : DBInterface.php , UTF-8
 * @date : Sep 5, 2012 , 8:52:56 PM
 */

namespace Desarrolla2\DB;

use Desarrolla2\DB\Adapter\AdapterInterface;

interface DBInterface
{

    /**
     * 
     * @param array $options
     */
    public function connect(array $options = array());

    /**
     * returns number errors in this session or 0
     *
     * @return int $n
     */
    public function countErrors();

    /**
     * returns number query executed in this session or 0
     *
     * @return int $n
     */
    public function countQueries();

    /**
     * 
     * @param string $databaseName
     */
    public function dropDatabase($databaseName);

    /**
     * retrieve results as array from database
     * 
     * @param string $query
     * @return array
     */
    public function fetch_arrays($query);

    /**
     * retrieve one object from database
     * 
     * @param string $query
     * @return object
     */
    public function fetch_object($query);

    /**
     * retrieve a object's collection from database
     * 
     * @param string $query
     * @return Collection
     */
    public function fetch_objects($query);

    /**
     * returns the error stack or false if
     * no error
     *
     * @return array $errors or false
     */
    public function getErrors();

    /**
     * returns query executed in this session or false
     *
     * @return array $queries or false
     */
    public function getQueries();

    /**
     * returs a option
     * 
     * @param string $key
     * @return array | null
     */
    public function getOption($key);

    /**
     * 
     * @param type $query
     */
    public function query($query);

    /**
     * @param \Desarrolla2\DB\Adapter\AdapterInterface $adapter
     */
    public function setAdaper(AdapterInterface $adapter);

    /**
     * @param string $key
     * @param string $value
     */
    public function setOption($key, $value);

    /**
     * @param array $options
     */
    public function setOptions(array $options = array());
    
        /**
     * 
     * @param type $filename
     * @return type
     */
    public function load($filename);

    /**
     * 
     * @param type $filename
     * @return type
     */
    public function dump($filename);
    
    public function getLastId();
}

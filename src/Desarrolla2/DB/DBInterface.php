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

interface DBInterface
{

    /**
     * 
     * @param array $options
     */
    public function connect($options = array());

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
     * returns the last error occurred,
     * removed it from the stack or false if
     * no errors
     *
     * @return string $error or false
     */
    public function getError();

    /**
     * returns the error stack or false if
     * no error
     *
     * @return array $errors or false
     */
    public function getErrorStack();

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
     * @return type
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
    public function setOptions($options = array());
}

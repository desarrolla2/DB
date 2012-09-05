<?php

/**
 * This file is part of the DB proyect.
 * 
 * Description of AdapterInterface
 *
 * @author : Daniel González <daniel.gonzalez@freelancemadrid.es> 
 * @file : AdapterInterface.php , UTF-8
 * @date : Sep 5, 2012 , 8:53:45 PM
 */

namespace Desarrolla2\DB\Adapter;

interface AdapterInterface
{

    /**
     * 
     * @param array $options
     */
    public function connect();

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
     * @return string
     */
    public function getLastError();

    /**
     * @return string
     */
    public function getLastQuery();

    /**
     * 
     * @param type $query
     * @return type
     */
    public function query($query);
}

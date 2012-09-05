<?php

/**
 * This file is part of the DB proyect.
 * 
 * Description of DB
 *
 * @author : Daniel González <daniel.gonzalez@freelancemadrid.es> 
 * @file : DB.php , UTF-8
 * @date : Sep 5, 2012 , 8:52:43 PM
 */

namespace Desarrolla2\DB;

use Desarrolla2\DB\DBInterface;
use Desarrolla2\DB\Exception\AdapterNotSetException;
use Desarrolla2\DB\Adapter\AdapterInterface;

class DB implements DBInterface
{

    /**
     * 
     * @param array $options
     */
    public function connect($options = array())
    {
        $this->setOptions($options);
        $this->adapter->connect();
    }

    /**
     * returns number errors in this session or 0
     *
     * @return int $n
     */
    public function countErrors()
    {
        if ($this->errors) {
            return count($this->errors);
        } else {
            return 0;
        }
    }

    /**
     * returns number query executed in this session or 0
     *
     * @return int $n
     */
    public function countQueries()
    {
        if ($this->queries) {
            return count($this->queries);
        } else {
            return 0;
        }
    }

    /**
     * 
     * @param string $databaseName
     */
    public function dropDatabase($databaseName)
    {
        return $this->adapter->dropDatabase($databaseName);
    }

    /**
     * retrieve results as array from database
     * 
     * @param string $query
     * @return array
     */
    public function fetch_arrays($query)
    {
        return $this->getAdapter()->fetch_arrays($query);
    }

    /**
     * retrieve one object from database
     * 
     * @param string $query
     * @return object
     */
    public function fetch_object($query)
    {
        return $this->getAdapter()->fetch_object($query);
    }

    /**
     * retrieve a object's collection from database
     * 
     * @param string $query
     * @return Collection
     */
    public function fetch_objects($query)
    {
        return $this->getAdapter()->fetch_objects($query);
    }

    /**
     * retrieve adapter if exist
     * 
     * @return \Desarrolla2\DB\Adapter\AdapterInterface
     * @throws AdapterNotSetException
     */
    protected function getAdapter()
    {
        if ($this->adapter) {
            return $this->adapter;
        } else {
            throw new AdapterNotSetException();
        }
    }

    /**
     * returns the last error occurred,
     * removed it from the stack or false if
     * no errors
     *
     * @return string $error or false
     */
    public function getError()
    {
        $error = array_pop($this->errors);
        if ($error) {
            return $error;
        } else {
            return false;
        }
    }

    /**
     * returns the error stack or false if
     * no error
     *
     * @return array $errors or false
     */
    public function getErrorStack()
    {
        if ($this->errors) {
            return $this->errors;
        } else {
            return false;
        }
    }

    /**
     * returns query executed in this session or false
     *
     * @return array $queries or false
     */
    public function getQueries()
    {
        if ($this->queries) {
            return $this->queries;
        } else {
            return false;
        }
    }

    /**
     * returs a option
     * 
     * @param string $key
     * @return array | null
     */
    public function getOption($key)
    {
        if (isset($this->options[$key])) {
            return $this->options[$key];
        }
    }

    /**
     * 
     * @param type $query
     * @return type
     */
    public function query($query)
    {
        return $this->adapter->query($query);
    }

    /**
     * @param \Desarrolla2\DB\Adapter\AdapterInterface $adapter
     */
    public function setAdaper(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function setOption($key, $value)
    {
        $this->options[$key] = $value;
    }

    /**
     * @param array $options
     */
    public function setOptions($options = array())
    {
        foreach ($options as $key => $value) {
            $this->setOption($key, $value);
        }
    }

}

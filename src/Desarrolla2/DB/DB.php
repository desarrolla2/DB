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
use Desarrolla2\DB\Exception;
use Desarrolla2\DB\Adapter\AdapterInterface;

class DB implements DBInterface
{

    /**
     * @var \Desarrolla2\DB\Adapter\AdapterInterface
     */
    protected $adapter = null;

    /**
     * @var array
     */
    protected $queries = array();

    /**
     * @var array
     */
    protected $options = array();

    /**
     * @var array
     */
    protected $errors = array();

    /**
     * @var array
     */
    protected $validOptions = array(
        'database', 'username', 'hostname', 'userpass'
    );

    /**
     * Control queries
     */
    protected function addQueries()
    {
        $query = $this->getAdapter()->getLastQuery();
        if ($query) {
            array_push($this->queries, $query);
        }
    }

    /**
     * Control Errors
     */
    protected function addErrors()
    {
        $error = $this->getAdapter()->getLastError();
        if ($error) {
            array_push($this->errors, $error);
        }
    }

    /**
     * check if all options was set
     */
    protected function checkOptions()
    {
        foreach ($this->validOptions as $required) {
            if (!array_key_exists($required, $this->options)) {
                throw new Exception\OptionsNotValidException('Required option [' . $required . '] to works ');
            }
        }
    }

    /**
     * 
     * @param array $options
     */
    public function connect(array $options = array())
    {
        $this->setOptions($options);
        $this->checkOptions();
        $this->adapter->connect();
    }

    /**
     * returns number errors in this session or 0
     *
     * @return int $n
     */
    public function countErrors()
    {
        return count($this->getErrors());
    }

    /**
     * returns number query executed in this session or 0
     *
     * @return int $n
     */
    public function countQueries()
    {
        return count($this->getQueries());
    }

    /**
     * 
     * @param string $databaseName
     */
    public function dropDatabase($databaseName)
    {
        $this->getAdapter()->dropDatabase($databaseName);
        $this->addQueries();
        $this->addErrors();
    }

    /**
     * retrieve results as array from database
     * 
     * @param string $query
     * @return array
     */
    public function fetch_arrays($query)
    {
        $result = $this->getAdapter()->fetch_arrays($query);
        $this->addQueries();
        $this->addErrors();
        return $result;
    }

    /**
     * retrieve one object from database
     * 
     * @param string $query
     * @return object
     */
    public function fetch_object($query)
    {
        $result = $this->getAdapter()->fetch_object($query);
        $this->addQueries();
        $this->addErrors();
        return $result;
    }

    /**
     * retrieve a object's collection from database
     * 
     * @param string $query
     * @return Collection
     */
    public function fetch_objects($query)
    {
        $result = $this->getAdapter()->fetch_objects($query);
        $this->addQueries();
        $this->addErrors();
        return $result;
    }

    /**
     * retrieve adapter if exist
     * 
     * @return \Desarrolla2\DB\Adapter\AdapterInterface
     * @throws Desarrolla2\DB\ExceptionAdapterNotSetException
     */
    protected function getAdapter()
    {
        if ($this->adapter) {
            return $this->adapter;
        } else {
            throw new Exception\AdapterNotSetException();
        }
    }

    /**
     * returns the error stack or false if
     * no error
     *
     * @return array $errors or false
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * returns query executed in this session or false
     *
     * @return array $queries or false
     */
    public function getQueries()
    {
        return $this->queries;
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
        return $this->getAdapter()->query($query);
    }

    /**
     * 
     * @param string $databaseName
     */
    public function selectDatabase($databaseName)
    {
        $this->setOption('database', $databaseName);
        $this->adapter()->connect();
        $this->addQueries();
        $this->addErrors();
    }

    /**
     * @param \Desarrolla2\DB\Adapter\AdapterInterface $adapter
     */
    public function setAdaper(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * 
     * @param string $option
     * @return string
     */
    protected function sanitizeOption($option)
    {
        return trim(strtolower((string) $option));
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function setOption($key, $value)
    {
        $value = $this->sanitizeOption($value);
        $key = $this->sanitizeOption($key);
        if (!in_array($key, $this->validOptions)) {
            throw new Exception\OptionNotValidException('Option not valid ' . $key);
        }
        $this->options[$key] = $value;
        $this->getAdapter()->setOption($key, $value);
    }

    /**
     * @param array $options
     */
    public function setOptions(array $options = array())
    {
        foreach ($options as $key => $value) {
            $this->setOption($key, $value);
        }
    }

}
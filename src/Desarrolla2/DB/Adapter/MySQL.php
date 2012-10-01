<?php

/**
 * This file is part of the DB proyect.
 * 
 * Description of MySQL
 *
 * @author : Daniel González <daniel.gonzalez@freelancemadrid.es> 
 * @file : MySQL.php , UTF-8
 * @date : Sep 5, 2012 , 8:53:54 PM
 */

namespace Desarrolla2\DB\Adapter;

use Desarrolla2\DB\Adapter\AdapterInterface;
use Desarrolla2\DB\Exception\ConnectionException;

class MySQL implements AdapterInterface
{

    /**
     * @var array
     */
    protected $options = array();

    /**
     * @var resource
     */
    protected $con = null;

    /**
     * @var string
     */
    protected $query = null;

    /**
     * @var string
     */
    protected $error = null;

    /**
     * Destructor
     */
    public function __destruct()
    {
        if ($this->con) {
            mysql_close($this->con);
        }
    }

    /**
     * Clean Query to safe and optimal execution
     */
    protected function cleanQuery()
    {
        $this->query = preg_replace('#\/\*[^(*\/)]+\*\/#', ' ', $this->query);
        $this->query = preg_replace('#\s+#', ' ', $this->query);
        $this->query = trim(($this->query)); // mysql_real_escape_string
    }

    /**
     * {@inheritdoc } 
     */
    public function connect()
    {
        $this->con = mysql_connect($this->options['hostname'], $this->options['username'], $this->options['password']);
        if ($this->con) {
            $select_db = $this->selectDatabase($this->options['database']);
        }
        if (!$this->con || !$select_db) {
            throw new ConnectionException(mysql_error());
        }
    }

    /**
     * {@inheritdoc } 
     */
    public function dropDatabase($databaseName)
    {
        $query = 'DROP DATABASE IF EXISTS ' . $databaseName . ';';
        $this->query($query);
    }

    /**
     * {@inheritdoc } 
     */
    public function createDatabase($databaseName)
    {
        $query = 'CREATE DATABASE  ' . $databaseName . ';';
        $this->query($query);
    }

    /**
     * {@inheritdoc } 
     */
    public function fetch_arrays($query)
    {
        $items = array();
        $result = $this->query($query);
        if ($result) {
            while ($item = mysql_fetch_array($result, MYSQL_ASSOC)) {
                array_push($items, $item);
            }
            return $items;
        } else {
            return false;
        }
    }

    /**
     * {@inheritdoc } 
     */
    public function fetch_object($query)
    {
        $result = $this->query($query);
        if ($result) {
            return mysql_fetch_object($result);
        } else {
            return false;
        }
    }

    /**
     * {@inheritdoc } 
     */
    public function fetch_objects($query)
    {
        $items = array();
        $result = $this->query($query);
        if ($result) {
            while ($item = mysql_fetch_object($result)) {
                array_push($items, $item);
            }
            return $items;
        } else {
            return false;
        }
    }

    /**
     * {@inheritdoc } 
     */
    public function getLastError()
    {
        $error = $this->error;
        $this->error = null;
        return $error;
    }

    /**
     * {@inheritdoc } 
     */
    public function getLastQuery()
    {
        $query = $this->query;
        $this->query = null;
        return $query;
    }

    /**
     * {@inheritdoc }
     */
    public function query($query)
    {
        $this->query = $query;
        $this->cleanQuery();
        $result = mysql_query($this->query);
        $error = mysql_error();
        if ($error) {
            $this->error = $error;
            return false;
        }
        return $result;
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
     * 
     * @param string $databaseName
     */
    public function selectDatabase($databaseName)
    {
        $query = 'USE ' . $databaseName . ';';
        return $this->query($query);
    }

    /**
     * 
     * @param type $filename
     * @return type
     */
    public function load($filename)
    {
        $this->dropDatabase();
        $this->createDatabase();
        $cmd = 'mysql -u ' . $this->options['username'] . ' -p\'' . $this->options['password'] . '\'' .
                ' -h ' . $this->options['hostname'] . ' ' . $this->options['database'] .
                ' --verbose --quick < ' . $file_name;
        echo $cmd . PHP_EOL;
        return exec($cmd);
    }

    /**
     * 
     * @param type $filename
     * @return type
     */
    public function dump($filename)
    {
        $cmd = 'mysqldump -u ' . $this->options['username'] . ' -p\'' . $this->options['password'] . '\'' .
                ' -h ' . $this->options['hostname'] . ' ' . $this->options['database'] .
                ' --add-drop-table --add-locks --create-options --disable-keys --extended-insert ' .
                ' --quick --set-charset --compress --verbose --no-create-db > ' . //--compatible=mysql40
                $file_name;
        echo $cmd . PHP_EOL;
        return exec($cmd);
    }

}

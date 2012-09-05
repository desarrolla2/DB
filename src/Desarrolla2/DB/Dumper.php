<?php

/**
 * This file is part of the DB proyect.
 * 
 * Description of Dumper
 *
 * @author : Daniel González <daniel.gonzalez@freelancemadrid.es> 
 * @file : Dumper.php , UTF-8
 * @date : Sep 5, 2012 , 9:22:56 PM
 */

namespace Desarrolla2\DB;

use Desarrolla2\DB\DumperInterface;

class Dumper implements DumperInterface
{

    public function __construct()
    {
        throw new Exception('Not ready yet');
    }

    public function dump($filename)
    {
        echo 'DUMPING' . PHP_EOL;
        $cmd = 'mysqldump -u ' . $this->options['username'] . ' -p\'' . $this->options['password'] . '\'' .
                ' -h ' . $this->options['host'] . ' ' . $this->options['database'] .
                ' --add-drop-table --add-locks --create-options --disable-keys --extended-insert ' .
                ' --quick --set-charset --compress --verbose --no-create-db > ' . //--compatible=mysql40
                $file_name;

        echo $cmd . PHP_EOL;

        return exec($cmd);
    }

    public function load($filename)
    {
        echo 'LOADING' . PHP_EOL;
        $this->dropDatabase();
        $this->createDatabase();
        $cmd = 'mysql -u ' . $this->options['username'] . ' -p\'' . $this->options['password'] . '\'' .
                ' -h ' . $this->options['host'] . ' ' . $this->options['database'] .
                ' --verbose --quick < ' . $file_name;
        echo $cmd . PHP_EOL;
        return exec($cmd);
    }

    public function setOption($key, $value)
    {
        
    }

    public function setOptions($options = array())
    {
        
    }

}

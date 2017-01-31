<?php

namespace App\Spec\Service;


abstract class Database implements DatabaseInterface
{
    private $connection;

    protected function db($protocol = 'mysql')
    {
        $credentials = $this->credentials();
        switch (self::ADAPTER) {
            case 'PDO' :
                $this->connection = new \PDO(
                    self::PROTOCOL . ':dbname=' . $credentials['dbname'] . ';host=' . $credentials['host'] . ';port=' . $credentials['port'],
                    $credentials['username'],
                    $credentials['passwd']
                );
                break;
            case 'mysqli_connect' :
                $this->connection = \mysqli_connect(
                    $credentials['host'],
                    $credentials['username'],
                    $credentials['passwd'],
                    $credentials['dbname'],
                    $credentials['port']
                );
                break;
        }
        return $this->connection;
    }

    private function credentials()
    {
        $credentials = @file_get_contents(dirname(getcwd()) . self::DB_CONNECTION_PARAMS_FILE);
        $dbCredentials = explode("\n", $credentials);
        foreach($dbCredentials as $db => $line){
            if(trim($line) != '' && strpos($line, self::PROTOCOL) !== false){
                return $this->parseDSN($line);
            }
        }
    }

    /**
     * @param string $dsn mysql://root:passwd@127.0.0.1:3306\test
     * @return array
     */
    private function parseDSN(string $dsn)
    {
        $matches = [];
        preg_match('/^(?P<'.self::PROTOCOL.'>\w+)(:\/\/)(?P<username>\w+)(:(?P<passwd>\w+))?@(?P<host>[.\w]+)(:(?P<port>\d+))?\\\\(?P<dbname>\w+)$/im', $dsn, $matches);

        $values = [];
        foreach (self::CREDENTIALS as $key => $value) {
            if (array_key_exists($key, $matches) && !empty($matches[$key])) {
                $values[$key] = $matches[$key];
            }
        }
        return $values;
    }
}
<?php


namespace Connector;


class Database implements \App\Spec\Database
{
    /**
     * @var \PDO|\mysqli
     */
    private $connection;

    /**
     * @param string $credentialsFile
     * @return \mysqli|\PDO
     */
    public function connection(string $credentialsFile = '')
    {
        // Use default
        if ($credentialsFile === '') {
            $credentialsFile = dirname(__DIR__) . self::DATABASE_GYM_CREDENTIALS_FILE;
        }

        $credentials = $this->credentials($credentialsFile);
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

    /**
     * @param $credentialsFile
     * @return array
     */
    public function credentials($credentialsFile)
    {
        $credentials = @file_get_contents($credentialsFile);
        $dbCredentials = explode("\n", $credentials);
        foreach ($dbCredentials as $db => $line) {
            if (trim($line) != '' && strpos($line, self::PROTOCOL) !== false) {
                return $this->parseDSN($line);
            }
        }
        return false;
    }

    /**
     * @param string $dsn mysql://root:passwd@127.0.0.1:3306\test
     * @return array
     */
    private function parseDSN(string $dsn)
    {
        $matches = [];
        preg_match('/^(?P<' . self::PROTOCOL . '>\w+)(:\/\/)(?P<username>\w+)(:(?P<passwd>\w+))?@(?P<host>[.\w]+)(:(?P<port>\d+))?\\\\(?P<dbname>\w+)$/im', $dsn, $matches);

        $values = [];
        foreach (self::CREDENTIALS as $key => $value) {
            if (array_key_exists($key, $matches) && !empty($matches[$key])) {
                $values[$key] = $matches[$key];
            }
        }
        return $values;
    }
}
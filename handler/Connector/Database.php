<?php


namespace Connector;


class Database
{
    const CREDENTIALS = [
        'protocol' => '',
        'username' => '',
        'passwd' => '',
        'host' => '',
        'port' => '',
        'dbname' => ''
    ];
    private static $protocol;
    private static $adapter;
    /**
     * @var \PDO|\mysqli
     */
    private $connection = false;

    /**
     * @param string $credentialsFile
     * @param string $useDatabase
     * @param string $protocol
     * @param string $adapter
     * @return \mysqli|\PDO
     */
    public function connection(string $credentialsFile, string $useDatabase, $protocol = 'mysql', $adapter = \PDO::class)
    {
        self::$protocol = $protocol;
        self::$adapter = $adapter;

        $credentials = $this->credentials($credentialsFile, $useDatabase);
        if (!empty($credentials)) {
            switch (self::$adapter) {
                case 'PDO' :
                    $this->connection = new \PDO(
                        self::$protocol . ':dbname=' . $credentials['dbname'] . ';host=' . $credentials['host'] . ';port=' . $credentials['port'],
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
        }
        return $this->connection;
    }

    /**
     * @param $credentialsFile
     * @param $useDatabase
     * @return array
     * @throws \Exception
     */
    public function credentials($credentialsFile, $useDatabase)
    {
        if (!file_exists($credentialsFile)) {
            throw new \Exception(sprintf('Not found, file `%s` for %s ', $credentialsFile, __METHOD__));
        }

        if (false === ($content = @file_get_contents($credentialsFile))) {
            throw new \Exception(sprintf('Could not get content, file `%s` for %s ', $credentialsFile, __METHOD__));
        }

        $dbCredentials = explode("\n", $content);
        foreach ($dbCredentials as $line) {
            if (!empty(trim($line))
                && substr($line, 0, strlen(self::$protocol)) === self::$protocol
                && substr($line, -(strlen($useDatabase))) === $useDatabase
            ) {
                return $this->parseDSN($line);
            }
        }
        return [];
    }

    /**
     * @param string $dsn mysql://root:passwd@127.0.0.1:3306\test
     * @return array
     */
    private function parseDSN(string $dsn)
    {
        $matches = [];
        preg_match('/^(?P<' . self::$protocol . '>\w+)(:\/\/)(?P<username>\w+)(:(?P<passwd>\w+))?@(?P<host>[.\w]+)(:(?P<port>\d+))?\\\\(?P<dbname>\w+)$/im', $dsn, $matches);

        $values = [];
        foreach (self::CREDENTIALS as $key => $value) {
            if (array_key_exists($key, $matches) && !empty($matches[$key])) {
                $values[$key] = $matches[$key];
            }
        }
        return $values;
    }
}
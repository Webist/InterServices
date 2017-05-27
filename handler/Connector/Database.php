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

    private static $adapter;
    /**
     * @var \PDO|\mysqli
     */
    private $connection = false;

    /**
     *
     * @param string $dsn mysql://root:passwd@127.0.0.1:3306\test
     * @param $protocol
     * @return array
     */
    private function parseDSN(string $dsn, $protocol)
    {
        $matches = [];
        preg_match('/^(?P<' . $protocol . '>\w+)(:\/\/)(?P<username>\w+)(:(?P<passwd>\w+))?@(?P<host>[.\w]+)(:(?P<port>\d+))?\\\\(?P<dbname>\w+)$/im', $dsn, $matches);

        $values = [];
        foreach (self::CREDENTIALS as $key => $value) {
            if (array_key_exists($key, $matches) && !empty($matches[$key])) {
                $values[$key] = $matches[$key];
            }
        }
        return $values;
    }

    /**
     * @param $content
     * @param $useDatabase
     * @param string $protocol
     * @return array
     */
    public function credentials($content, $useDatabase, $protocol = 'mysql')
    {
        $dbCredentials = explode("\n", $content);
        foreach ($dbCredentials as $line) {
            if (!empty(trim($line))
                && substr($line, 0, strlen($protocol)) === $protocol
                && substr($line, -(strlen($useDatabase))) === $useDatabase
            ) {
                return $this->parseDSN($line, $protocol);
            }
        }
        return [];
    }

    /**
     * @param $credentialsContent
     * @param string $useDatabase
     * @param string $protocol
     * @param string $adapter
     * @return \mysqli|\PDO
     */
    public function connection($credentialsContent, string $useDatabase, $protocol = 'mysql', $adapter = \PDO::class)
    {
        self::$adapter = $adapter;

        $credentials = $this->credentials($credentialsContent, $useDatabase);
        if (!empty($credentials)) {
            switch (self::$adapter) {
                case 'PDO' :
                    $this->connection = new \PDO(
                        $protocol . ':dbname=' . $credentials['dbname'] . ';host=' . $credentials['host'] . ';port=' . $credentials['port'],
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
}
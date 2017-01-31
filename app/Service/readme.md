### External Services Env

Services do; 
+ Pre-config (auto-connect, pop-up or build)
+ Accept process-data (query command, mail-data to send)


Services comply to;
+ Non-blocking command executions
+ Tasks completion by a new process, via queueing system
+ Instantiating vendor apps

Composition of reusable's
+ DRY  


Examples:  
MySQL is an external service.  
Connection and execution of queries can be handled as a (micro)-service.

Creating the (micro)-service
```
class App\Service\Database extends \App\Spec\Service\Database
{
    private $callback;

    public function __construct($callback)
    {
        $this->callback = $callback;
    }

    public function handle()
    {
        return call_user_func($this->callback, $this->db());
    }
}
```
 
Inserting a record into database via callback.
```
        $routeId = $this->route['indexKey'];
        $ip = filter_input(INPUT_SERVER, 'REMOTE_ADDR');  
        

        $visitsDbLogger = function($pdo) use ($routeId, $ip) {

            $query = "INSERT INTO visits SET route_id = :routeId, ip = :ip";
            $dbh = $pdo->prepare($query);
            return $dbh->execute(
                [':routeId' => $routeId, ':ip' => $ip]
            );
        };

        $db = $this->service(\App\Service\Database, $visitsDbLogger);
        $db->handle();
```



Other examples are  
pdf creator (wkhtmltopdf), image parser   
and even a session handler can be implemented as service.

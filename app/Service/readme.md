### External Services Env

Services live inside a domain and independed form their execution envrionments.
A service share's schema, contract and not class.
The compablitity of a service is based on policy (business rules), not on business logic (process).

Services are;  
+ Performs a "global" specific task. (So any PHP object is a service if it used globally)
+ Each service do just one job.
+ simple to instantiate, invoke.

+ Aggregations
+ Facade
+ function-objects

Services do; 
+ Pre-config (auto-connect, pop-up or build)
+ Accept Handlers to process-data (query command, mail to send)


Services comply to;
+ Non-blocking command executions
+ Tasks completion by a new process, via queueing system
+ Instantiating vendor apps
+ Building Commands/Operations should be possible to build on the client-side app.

Services are accessible as;
+ Web service (http://.../UserService.wsdl)
+ Globally within app Envrionment
+ Single operand (microServices)

Service Actions (operations/methods) (generally) are;
+ get / query (parameters, response), list / selections
+ mutate (parameters, response)
+ dispatch (to an handler) 
+ invoke (callbacks)
+ notify (commpand pattern, pub/sub (leave a message, trigger a listener)) 
+ errors

Composition of reusable's
+ DRY  


Examples:  
MySQL is an external service.  
Connection and execution of queries can be handled as a (micro)-service.

```
namespace App\Service;


class Database
{
    /**
     * Holds the callback as it was defined when this service was reflected
     * @example Query container to execute $visitsLoggerQuery = function($pdo) use ($params) {}
     *
     * @var \Closure
     */
    private $callback;

    public function __construct(\Closure $callback)
    {
        $this->callback = $callback;
    }

    /**
     * @param null $credentialsFile when used, overrides default credentials file
     * @return mixed
     */
    public function invoke($credentialsFile = null)
    {
        return call_user_func($this->callback, $this->db($credentialsFile));
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
        $db->invoke();
```



Other examples are  
pdf creator (wkhtmltopdf), image parser   
and even a session handler can be implemented as service.

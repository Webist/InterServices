### External Services Env

Services live inside a domain and independent form their execution environments.
A service share's schema, contract and not class.
The compatibility of a service is based on policy (business rules), not on business logic (process).

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
+ Globally within app Environment
+ Single operand (microServices)

Service Actions (operations/methods) (generally) are;
+ maintainLifeCycle
+ setLifeCycle
+ mutate / dispatch
Via ReturnValue object
+ state
+ getSucceedMessages
+ getFailureErrors
+ uuid

Composition of reusable's
+ DRY  


Examples are  
pdf creator (wkhtmltopdf), image parser   
and even a session handler can be implemented as service.

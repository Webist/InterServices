### Controller env

Classes, called controller, of regular route destinations.

However the naming controller is not indicative, 
a controller is in essence an entry point abstraction layer of the application.  
By analogy, it is the project definition with different activities in it.

It is not a management layer.  
As a project, it hosts or uses the management layers such as InterActor, ViewModel 
to accept the request and response properly.

### Conventions
Conventions from higher to lower level models.
#### Legenda  
+ `action-name` is a class method name
+ `project-name` is a class name and its controller class is the destination of a router. 
Other classes in the same control flow has the same name.
 

#### Naming
Highest layer  
+ In an entry point `Controller\{project-name}`, when an array map for a mutation used then method name `{action-name}ReturnValue`  
+ In an entry point `Controller\{project-name}`, when an uuid for a result-set used then `{action-name}Unit`  

Lower layer  
+ In a handler `InterActor\{project-name}`, a service should be initially maintained with a operator `maintain{action-name}Unit($operator)`
+ In a handler `InterActor\{project-name}`, a service should organize the specific operations `{action-name}Operations()`
+ In a handler `InterActor\{project-name}`, when mutation operations needed then `mutate`
+ In a handler `InterActor\{project-name}`, when result-set operations needed then `get`

Lower layer  
+ In an operations `Service\{project-name}`, all by `InterActor` required methods should exists.

##### Control flow 
+ In an operations `Service\{project-name}`, an unit, either domain-centric domain or data-centric domain, should be hidden or encapsulated. 
+ In an operations `Service\{project-name}`, should be taken care of Inversion flow of Control.




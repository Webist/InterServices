### Application services - Use cases

Business lifeCycle operations.  

An application service is a framework that handles operations lifeCycle in own space.  
 
A lifeCycle basically includes business rules, workflow or a finite state machine and execution handlers.

**Layer**
+ Implements use cases
+ High-level application logic
+ Knows about domain
+ No knowledge of other layers
+ Contains interface for details

**Governance**  
+ Dependency inversion  
+ Inversion flow of control  
+ Independent deploy-ability  
+ Flexibility and maintainability  
+ Command-Query Separation  / CQRS    
   + By methods : Commands are `returnValue` named methods, Queries are `unit` named methods.  
   + By objects : Commands and Queries are different classes. Probably event-sourcing.  

#### Domain-centric  
Domain-centric domain service.  
This means communications are with a [persistence](../../handler/readme.md) and/or [infrastructure](../Storage/readme.md) layer.  
Model and relations live in application via object orchestration. 
Database lives behind the persistence.  

Start-point is specifying the domain logic.  

**Pros**
+ Focus on essential, use cases
+ code reuse by creating APIs (REST, SOAP)
+ Less coupling to details
+ Refactoring, scaling by modify according to new requirements works better
+ less friction (e.g. db updates) between the developers, requires less SQL knowledge
+ Necessary for DDD

**Cons**
+ Change is difficult, harder for developers to assure consistency. 
+ Requires extra thought, additional maintenance overhead at the beginning
+ Initial higher cost
+ IoC (Inversion of Control) might be counter-intuitive. Knowledge about fractals makes easier to understand.


#### Data-centric  
Data-centric domain service.  
This means communications are done with a database.  
Model and Relations live in database via join, stored procedures.   

Start-point is modeling database schema's.  

**Pros**  
+ Ease of maintaining data consistency
+ Easier to start with

**Cons**  
+ the more complex a project gets, the less appealing
+ code reuse by using the database as an integration point
+ more friction (e.g. db updates) between de developers, requires more SQL knowledge


[../../handler/readme.md](../../handler/readme.md)
 
 
[Read more](http://www.matthewrenze.com/presentations/clean-architecture.pdf)


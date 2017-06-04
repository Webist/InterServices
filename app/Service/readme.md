# Application services - Use cases

An application that does one job, called Business lifeCycle operations.  

An application service is a framework that handles operations lifeCycle in own space.  

Meaning this an application service might be a domain model with aggregations unit, but also 
a simple function such as findDiff() as an utility.   
The main focus is use case operations.  

Smallest application service is probably a for loop.
```php
for(Initialization; Condition; Afterthought) {
  // Execute 1: Initialization : Declare or assign variables
  // Execute 2: Condition : Evaluate condition
  // Execute 3: Afterthought : Decide a statement 
 }
```
Theoretically not much difference for an advanced application service.
```php
  // Execute 1: Initialization : Declare or assign variables 
  $customerService->maintain($arrayMap);  
  
  // Execute 2: Condition : Evaluate condition
  $operators = $customerService->operators($operator, $uuid);  
  
  // Execute 3: Afterthought : Decide a statement
  $operations = new \Statement\Operations($operators, new \Statement\ReturnValue());  
  
  return $operations->execute();
```

A business lifeCycle basically includes business rules, workflow or a finite state machine and execution.

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


## Types of Application Services

#### Function-centric
Function-centric domain service.  
Accepts input, does one job without necessarily communication with others.  
Behaves as an utility, such as pdf-converter, arrayMap searcher.  

Start-point is writing a small program.  

**Pros**
+ Focus on single task
+ Fast availability

**Cons**
+ No storage  
+ Gets quickly complex to maintain   

#### Data-centric  
Data-centric domain service.  
Accepts input, does one job by communicating database.  
Behaves as a service-between data mapper, such as SQL, XML interActor.
Model and Relations live in database via join, stored procedures.   

Start-point is modeling database schema's.  

**Pros**  
+ Ease of maintaining data consistency
+ Easier to start with  

**Cons**  
+ the more complex a project gets, the less appealing  
+ code reuse by using the database as an integration point  
+ more friction (e.g. db updates) between de developers, requires more SQL knowledge  

#### Domain-centric  
Domain-centric domain service.  
Accepts input, does one job by communicating a [persistence](../../handler/readme.md) and/or [infrastructure](../Storage/readme.md) layer.  
Model and relations live in application via object orchestration.  
Database lives behind the persistence.  

Start-point is specifying the domain logic.   

**Pros**
+ Focus on essential, use cases
+ Code reuse by creating APIs (REST, SOAP)
+ Less coupling to details
+ Refactoring, scaling by modify according to new requirements works better
+ Less friction (e.g. db updates) between the developers, requires less SQL knowledge
+ Necessary for DDD

**Cons**
+ Change is difficult, harder for developers to assure consistency. 
+ Requires extra thought, additional maintenance overhead at the beginning
+ Initial higher cost
+ IoC (Inversion of Control) might be counter-intuitive. Knowledge about fractals makes easier to understand.





[../../handler/readme.md](../../handler/readme.md)
 
 
[Read more](http://www.matthewrenze.com/presentations/clean-architecture.pdf)


### Web Delivery - Simple, MVC, MOM

Main concern of this /app directory is the application access 
to become the web delivery by communicating with components/services.

It consists of routing, request model/composition and protocol translation.  

With the appliance of MOM (Machine Object Model) 
objects structure relies strongly on DI (Dependency Injection) principle.
Therefore the structure is generally, including MVC, component/service oriented.  

There is no framework, which would bring many benefits, to develop in a boxed area.
Instead architectural principles that challenges the best practices in software development.

Nine different type of folders meets the requirements of the MOM.


+ Spec  
Specification data (interfaces, config). 

+ Handler  
Controller specific Handlers/Components or Middleware's  

+ Controller   
The entry points 

+ Meta
Platform, route, portable data-storage 

+ Service  
Connection/adapters, frameworks that hold statements, operations (commands/queries) and execute

+ ReturnValue
Results representation in an object

+ Operator
Commands/Queries holder

+ Container
Service objects holder  

+ DataStorage  
File Data Store  

+ Source  
Command/Query operations build for relational data structure with source-type fields
 
+ Event  
Command/Query operations build for event records-history with event-type fields

+ Exception   
Controller specific error handlers  

+ View  
Layout, templates composition and rendering



   
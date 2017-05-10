### Web Delivery - Simple, MVC, MOM

Main concern of this /app directory is the application access 
to become the web delivery by communicating with components/services.

It consists of routing, request model/composition and protocol translation.  

With the appliance of [MOM (Machine Object Model)](http://webist.nl/articles/machine-object-model.md)
objects structure relies strongly on DI (Dependency Injection) principle.
Therefore the structure is generally, including MVC, component/service oriented.  

There is no framework, which would bring many benefits, to develop in a boxed area.
Instead architectural principles that challenges the best practices in software development.

Different type of folders meets the requirements of the MOM.


+ Spec  
Specifications, configurations by interfaces. 

+ Handler  
Controller specific Handlers/Components or Middleware's  

+ Controller   
Entry points 

+ Meta   
Platform, route, portable data-storage 

+ Service  
Operations, collection of handlers and execution. Instantiates such as 
Query & Command, Connection/Adapter, Mail handler.

+ ReturnValue   
Results representation in an object, used by Service executions.

+ Container  ``` @deprecated ```   
Service objects holder  

+ DataStorage  
File Data Store  

+ Source  ``` @empty ```   
Command/Query operations build for relational data structure with source-type fields
 
+ Event  ``` @empty ```   
Command/Query operations build for event records-history with event-type fields

+ Exception   
Error handlers  

+ View  
Layout, templates composition and rendering



   
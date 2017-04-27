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

+ Service  
External service connection/adapters 

+ DataStorage  
File Data Store  

+ Source  
Command/Query operations build for source-type fields in relational data structure context 
 
+ Event  
Command/Query operations build for event-type fields in event records-history context

+ Exception   
Controller specific error handlers  

+ View  
Layout, templates composition and rendering



   
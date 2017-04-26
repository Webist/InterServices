### Web Delivery - Simple, MVC, MOM

Main concern of this /app directory is the application access 
to become the web delivery by communicating with components/services.

It consists of routing, request model/composition and protocol translation.  

With the appliance of MOM (Machine Object Model) 
objects structure relies strongly on DI (Dependency Injection) principle.
Therefore the structure is generally, including MVC, component/service oriented.  

There is no framework, which would bring many benefits, to develop in a boxed area.
Instead architectural principles that challenges the best practices in software development.

Seven different type of folders meets the requirements of the MOM.


+ Spec  
Specification data (interfaces, config). 

+ Handler  
Controller specific Handlers or Middleware's  

+ Controller   
The entry points 

+ DataStorage  
Data Store  

+ Service  
External service connection/adapters, microservices  

+ Exception   
Controller specific error handlers  

+ View  
Layout, templates composition and rendering model 



   
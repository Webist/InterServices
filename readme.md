### MOM Web Delivery

MOM Web Delivery is based on component orientation mechanism M.O.M [(Machine Object Model)](http://webist.nl/articles/machine-object-model.md).


The MVC pattern with MOM Web Delivery remains same.   
However the relationships from higher level to lower layers occur accordingly with the role of the object.  
Inheritance within the delivery cycle are in the following order;
 + Composition  
 Higher layers host an input and a handler.
 + Association  
 Lower management layers use other management, such as services.
 + Aggregation  
 Lower service layers own statement builders and executors.
 + Is a (parent-child inheritance)   
 No usage in the component orientation and so the generic delivery cycle. 
 
 
An easy analogy of MVC within the MOM Web Delivery;  

+ By analogy, Controller layer is a *Project*
+ By analogy, Model layer is a *Manager*
+ By analogy, View layer is a *ResultSet*

#### Controller Layer
The controller layer is responsible for incoming HTTP requests and deliver a suitable response.  

A controller hosts by default an InputHandler and an InterActor.  


By analogy, a controller is a Project.  
It is an activity within a restricted space to create something, 
it distinguishes itself by once-only process.  
Activities are handled by methods to interact with an InterActor Manager, optionally View Model and so provide a ResultSet.  

#### Model Layer
The model layer is responsible for the InterAction and the LifeCycle of the business logic.  

An InterActor by default hosts a infrastructure, as meta, information provider and a service provider (c.q. service-container).  


By analogy, an InterActor is a maintaining manager that interacts with service delivery frameworks.
InterActor has the role of regulator and therefore it aggregates multiple services 
to provide information either towards controller, infrastructure or application service. 
  
An application service is a provider of a unit and operations for use case's within a certain domain.  
Note that the word `a unit` in previous sentence matches the model within an application service.  
 
A typical application service is a domain model layer responsible for the operations such as creating statements 
by commands and queries for that specific domain, followed by execute or let it execute by a persistence layer.
 
#### View Layer
The view layer provides composition tools such as a DOM builder for HTML, XML output.  

A view model accepts input data and requires DOM template inclusions. 
It is typically used by the controller layer to render a response in certain format.  

By analogy, a view model is a ResultSet provider.
It wraps and demonstrates the outcomes in certain format.

[app/readme.md](app/readme.md)

#### Development and Version 
Development is, as of May 2017, in early stages. 
However rapid structure change velocity is becoming less.  
Therefore applying TDD, BDD, Integration testing becoming more feasible.  
After a high degree testing code-coverage, workflow code generation is planned.  
Code generation might look like [this](https://dl.dropboxusercontent.com/u/774859/Work/Laravel-4-Generators/Get-Started-With-Laravel-Custom-Generators.mp4)   
and following the basic mindset, make independently use of components/services,  
of this system using "way/generators" and only developing own templates would be great.

[code_coverage.md](code_coverage.md)



  


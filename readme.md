### MOM Web Delivery

MOM Web Delivery is based on component orientation mechanism M.O.M [(Machine Object Model)](http://webist.nl/articles/machine-object-model.md).


The MVC pattern remains same within the MOM Web Delivery.  
However the relationships are based on compositional inheritance.  
Basically there is no parent-child relationship, composition only. 
 
An easy analogy of MVC within the MOM Web Delivery should be as follows;  

+ Controller layer represents the *Project*
+ Model layer represents the *Manager*
+ View layer represents the *Results*

#### Controller Layer
The controller layer is responsible for incoming HTTP requests and deliver a suitable response.  

A controller hosts by default an InputHandler and an InterActor.  


Considering, by analogy, a controller is a Project.  
It is an activity within a restricted space to create something, 
it distinguishes itself by once-only process.  
Activities are the incoming requests and regulated by an InterActor-Manager.  

#### Model Layer
The model layer is responsible for the InterAction and the LifeCycle of the business logic.  

A model by default hosts a meta information provider and a Service-Container.  


Considering, by analogy, a model consists of one or multiple Managers.
An InterAction manager takes care of regulation and might aggregate multiple service-managers.  

A service-manager, in collaboration with InterAction manager, takes care of operations, 
such as creating statements by commands and queries and execute or let it execute by a persistence layer.
 
#### View Layer
The view layer provides composition tools such as a DOM builder for HTML, XML.  

A view model accepts input data and requires DOM template inclusions. 
It is typically used by the controller layer to render a response in certain format.  

Considering, by analogy, a view model is a Results provider.
It demonstrates the outcomes in certain format.



#### Development and Version 
Development is, as of May 2017, in early stages. 
However rapid structure change velocity is becoming less.  
Therefore applying TDD, BDD, Integration testing becoming more feasible.  
After a high degree testing code-coverage, workflow code generation is planned.  
Code generation might look like [this](https://dl.dropboxusercontent.com/u/774859/Work/Laravel-4-Generators/Get-Started-With-Laravel-Custom-Generators.mp4)   
and following the basic mindset, make independently use of components/services,  
of this system using "way/generators" and only developing own templates would be great.

[code_coverage.md](code_coverage.md)



  


### MOM Web Delivery

MOM Web Delivery is based on component orientation mechanism M.O.M [(Machine Object Model)](http://webist.nl/articles/machine-object-model.md).


The MVC pattern remains same within the MOM Web Delivery.  
However the relationships are primarily based on compositional inheritance.  
Basically there is no parent-child relationship, composition only. 
 
An easy analogy of MVC within the MOM Web Delivery could be;  

+ Controller layer represents the *Project*
+ Model layer represents the *Manager*
+ View layer represents the *Results*

#### Controller Layer
The controller layer is responsible for incoming HTTP requests and a suitable response.  
By default it hosts an InterActor.  

A controller can represent a Project.  
It is an activity to create something, within a restricted space.  
Characteristics of the project is that it distinguishes itself by once-only process.  
Activities of the controller is usually regulated by managers and conducted in collaboration of service delivering components/organisations.
#### Model Layer
The model layer is responsible for the InterAction and the LifeCycle of the business logic.  


A model layer represents two main roles, the InterAction-Manager and the Service-Manager.  
InterAction-Manager takes care of regulation by for example requirement validation, 
interacts with services by aggregation and transfers the response to the controller layer.   
Service-Manager takes care of the operations.  
Such as creating the statements by commands and queries and let it execute by a persistent layer.    
#### View Layer
The view layer provides composition tools such as a DOM builder for HTML, XML.  

A view layer accepts input data and requires DOM template inclusions. 
A view layer is typically used by the controller layer to render a response in certain format.



#### Development and Version 
Development is, as of May 2017, in early stages. 
However rapid structure change velocity is becoming less.  
Therefore applying TDD, BDD, Integration testing becoming more feasible.  
After a high degree testing code-coverage, workflow code generation is planned.  
Code generation might look like [this](https://dl.dropboxusercontent.com/u/774859/Work/Laravel-4-Generators/Get-Started-With-Laravel-Custom-Generators.mp4)   
and following the basic mindset, make independently use of components/services,  
of this system using "way/generators" and only developing own templates would be great.

[code_coverage.md](code_coverage.md)


  


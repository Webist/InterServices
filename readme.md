### MOM Web Delivery

2 main lifeCycle layers   
+ Web Delivery lifeCycle   
Start-point `public/index.php`, end-point `app/Controller/{class}`.  
HTTP request, response cycle.

+ Application Service lifeCycle   
Start-point `app/InterActor/{class}`, end-point `app/Service/{class}`.  
Internal request, service-application response cycle. 


##### Web Delivery lifeCycle
Web delivery lifeCycle handles the http request.   
Request, route information is available via `InputHandler`.  


##### Application Service lifeCycle  
Application Service lifeCycle handles the request via an internal application, such as CLI, Controller object of the MVC.    
An `app/InterActor/{class}` without construct, just works.  
However the best practice is that an interActor hosts (inheritance via DI) an application service.  

The typical use case is; hosting an application service for Web Delivery LifeCycle.   
```markdown
In a web delivery environment an `InterActor` object will be accessed from the `Controller` object,
therefore it is best practice to build the InterActor with a constructor that hosts the app service `__construct(\App\Service\App $app)`.    
   
Such an InterActor object, in a CLI environment, remains easy to use  
because the `\App\Service\App` is nothing more than an utility without dependencies.  
Event better, it provides a service container for the efficient usage of the classes. 
```

#### MVC Analogy
The MVC pattern with MOM Web Delivery remains same.    
An easy analogy of MVC within the MOM Web Delivery;  

+ By analogy, Controller is a *Project*
+ By analogy, Model is a *Manager*
+ By analogy, View is a *ResultSet*

#### Controller
The controller is responsible for incoming HTTP requests and deliver a suitable response.  

A controller hosts by default an InputHandler and an InterActor.  


By analogy, a controller is a Project.  
It is an activity within a restricted space to create something, 
it distinguishes itself by once-only process.  
Activities are handled by methods to interact with an InterActor Manager, optionally View Model and so provide a ResultSet.  

#### Model
The model is responsible for the InterAction and the LifeCycle of the business logic.  

An InterActor by default hosts utility, such as service provider (c.q. service-container).  


By analogy, an InterActor is a maintaining manager that interacts with service delivery frameworks.
InterActor has the role of regulator and therefore it aggregates (multiple) services 
to provide information either towards controller, infrastructure or application service. 
  
An application service is a provider of a unit and operations for use case's within a certain domain.  
Note that the word `a unit` in previous sentence matches the model within an application service.  
 
A typical application service is a domain model layer responsible for the operations such as creating statements 
by commands and queries for that specific domain, followed by execute or let it execute by a persistence layer.
 
#### View
The view provides composition tools such as a DOM builder for HTML, XML output.  

A view model accepts input data and requires DOM template inclusions. 
It is typically used by the controller layer to render a response in certain format.  

By analogy, a view model is a ResultSet provider.
It wraps and demonstrates the outcomes in certain format.


#### Component Orientation Mechanism
MOM Web Delivery is based on component orientation mechanism M.O.M [(Machine Object Model)](http://webist.nl/articles/machine-object-model.md).
 
Constructing relationships from higher level to lower layers 
are role base structured.   

Inheritance within the MOM delivery cycle are in the following order;
 + Composition  
 Higher layers host an input and a handler.
 + Association  
 Lower InterActor layers use services.
 + Aggregation  
 Lower service layers own statement builders and executors.
 + Is a (parent-child inheritance)   
 No usage in the component orientation and so the generic MOM delivery cycle. 

  
More about web delivery  
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



  


# MOM Web Delivery

MOM Web Delivery consists of two cycles.


   
+ Web Delivery cycle   
Process of HTTP request, response. 


+ Application Governance and Service cycle (app cycle)  
Process of internal request, regulation by action governance and use case based service. 


## Web Delivery cycle
Start-point `public/index.php`, end-point `app/Controller/{class}`.   
Request, route information is available via `InputHandler`.  
A controller optionally owns a `\View\Model` for a proper response.
   

## Application Governance and Service cycle (app cycle)
Start-point `app/InterActor/{class}`, end-point `app/Service/{class}`.   
Web delivery end-point `app/Controller/{class}` hosts (inheritance via DI) the app cycle start-point `app/InterActor/{class}`.

An InterActor object is responsible for maintaining and so governing the actions.  
Depending on how advanced the business requirements, 
it eventually applies regulations such as identification, assertion, countermeasure, monitoring, incident response.
  
A request for an InterActor is an internal application process, it might be implemented by an MVC controller object or
it might be the entry-point for a service.

```markdown
When an InterActor is used in MVC context then it is best practice to construct the InterActor 
object with the web delivery service app. `__construct(\App\Service\App $app)`.     
 

`\App\Service\App` is an utility-service. Which means it has no construction and higher grade dependencies to operate.  
For example it provides a DI service container for reusing the objects efficiently.
```

## MVC Analogy  
An easy analogy of MVC within the MOM Web Delivery;  

+ By analogy, Controller is a *Project*
+ By analogy, Model is a *Activity Governance and Service*
+ By analogy, View is a *ResultSet*

### Controller
The controller is responsible for incoming HTTP requests and deliver a suitable response.  

A controller hosts by default a request InputHandler and an activity InterActor.  


By analogy, a controller is a Project.  
It is an activity within a restricted space to create something, 
it distinguishes itself by once-only process.  
Activities are handled by object methods to interact with an InterActor and optionally View Model to provide a ResultSet.  

### Model
The model is responsible for the InterAction and the LifeCycle of the business logic.  

An InterActor might host an utility, such as service provider (c.q. service-container).  

**InterActor**   
By analogy, an InterActor is a maintaining activity owner that interacts with service delivery frameworks.
InterActor has the role of regulator and therefore it aggregates (multiple) services 
to provide information either towards controller, infrastructure or application service. 
  
**Application Service**   
An application service is a provider of a unit (or a model) and operations for use case's within a certain domain.  
 
A typical application service is a domain model layer responsible for the operations such as creating statements 
by commands and queries for that specific domain, followed by execute or let it execute by a persistence layer.
 
### View
The view provides composition tools such as a DOM builder for HTML, XML output.  

A view model accepts input data and requires DOM template inclusions. 
It is typically used by the controller layer to render a response in certain format.  

By analogy, a view model is a ResultSet provider.
It wraps and demonstrates the outcomes in certain format.


## Component Orientation Mechanism
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



  


### InterServices 

`InterServices is a temporary name of this system.`

### Component/Service Orientation - Web Delivery Mechanism 
See [Robert C Martin - Clean Architecture and Design](https://www.youtube.com/watch?v=Nsjsiz2A9mg)   

As the DI (Dependency Injection) is strictly preferred above inheritance,  
the development environment is component/service oriented.  
Specifying upfront is forced to avoid implementing dynamic configuration
modifications, such as triggers, trough the code.  
This upfront specification is also a way of avoiding cyclomatic complexity (if, elseif, case, or, ...).

#### Supported Delivery Mechanism's
+ Simple, the route points to a file
+ MVC, the route points to the Controller
   + any Controller object might extend a BaseController to use a framework
   + NotFoundException of routing can be utilized for exclusive environments, such as fall-back to a framework environment
+ M.O.M, the route points to the Controller that implements specification Interface and injects an Interactor/Handler 
   + any Controller object might extend a BaseController to use a framework
   + NotFoundException of routing can be utilized for exclusive environments, as fall-back to a framework environment
See [(Machine Object Model)](http://webist.nl/articles/machine-object-model.md)
 

The system is not MVC dependant and therefore framework agnostic.  

#### Development and Version 
Development is, as of May 2017, in early stages. 
However rapid structure change velocity is becoming less.  
Therefore applying TDD, BDD, Integration testing becoming more feasible.  
After a high degree testing code-coverage, workflow code generation is planned.  
Code generation might look like [this](https://dl.dropboxusercontent.com/u/774859/Work/Laravel-4-Generators/Get-Started-With-Laravel-Custom-Generators.mp4)   
and following the basic mindset, make independently use of components/services,  
of this system using "way/generators" and only developing own templates would be great.

[code_coverage.md](code_coverage.md)

### A short leading Doc
Directories contain `readme.md` file.
A good place to start explore is `app/Spec` directory.
After the specification environment you can read more in the directories such as `app/Controller`, `app/Handler`
to see how they were implemented.  


  


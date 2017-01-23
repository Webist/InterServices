### Internal Handlers

##### Adapters to External handlers
In this directory resides Controller internal adapter-handlers.  
An internal handler is the connection to an external service or handler.  
Services are containers to manage the external handlers in a DRY principle.

##### Basic Rules
+ Every Controller has its Handler representation in this directory.
+ An Handler extends Services (with Registered external handlers) 
+ An Handler implements own specific Handler-Config (an interface) wherein  
 the methods are declared (Declarations of a Controller-Config are interface constants).  
 ```
 // path to global config of a Controller
 class Controller\RootPath implements \App\Config\RootPath 
 interface \App\Config\RootPath extends GlobalConfig
 ```
 ```
 // path to external handler of a Controller
 class Handler\RootPath extends Service\Services 
                        implements \App\Config\RootPathHandler   
                        
 // Services manage the declared classes in Registers 
 Container\Services implements Service\Locator
```
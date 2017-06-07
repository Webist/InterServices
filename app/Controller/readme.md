# Web Delivery Controller

A web delivery controller is the destination of a route.

However the naming controller is not indicative, 
a controller is in essence an entry point abstraction layer for the application service.   


By analogy, it is the project definition, not a manager, with different activities in it.

It hosts (inheritance via DI) the interActor of the web delivery (InputHandler) and the interActor for the use case application service.   
 
It optionally owns (a new instance within the action) a View model to render an appropriate response.  










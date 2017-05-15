#### Routing
Currently supported options.

+ Match the URL path via REQUEST_URI, obviously.
+ REQUEST_METHOD [GET,POST,PUT]options
+ HTTP_X_REQUESTED_WITH (Ajax request) option.

#### Why is this router and not already an existing one?
+ This router uses an hash key to match a route.  
The hash is the index of a plain PHP array.  
With this it is significant faster than most routes provided by frameworks.

+ Direct forwarding to a file.  
Front-end development becomes easier without overhead from back-end.  



#### Type of routes
+ Forward route    
Directly the defined filename as destination opened.    
Fits better Front-end web/http development.   
 ```$route``` array with ```indexKey``` will be available. 

+ Regular route
Route instantiates a controller.  
Fits better Back-end web/http development.
 ```Http\Stream\InptHandler()``` will be available.


#### Adding route by example

Below are de example snippets for generating a route.
Such a snippet can be pasted in a file, for example /public/index.php, 
to generate.  

After running this a new file in the directory `/app/Storage/Routes` should appear.  


Example :  
Method: POST  
Path: /  
Controller: RootPath  
Method:  addPostXhrEmail  
```
$route = new Http\Routing\RouteBuilder('POST', '/', 'RootPath@addPostXhrEmail');
$route->setXRequestedWith(true);  

var_export($route->buildRoute(true));
```

```
$route = new Http\Routing\RouteBuilder('GET', '/test', 'Test@renderTestString');
$route->setXRequestedWith(true);  

var_export($route->buildRoute(true));
```
```
$route = new Http\Routing\RouteBuilder('POST', '/admin', 'Admin@renderForm');  

var_export($route->buildRoute(true));
```
A Forward route example
```
$route = new Http\Routing\RouteBuilder('GET', '/', '../web/home.php');  

var_export($route->buildRoute(true));
```


   
Now it can be tested via the webserver. 
Accessing via the browser is most convenient way.


[../Stream/readme.md](../Stream/readme.md)  
[../Delivery/readme.md](../Delivery/readme.md)  


[../../../web/readme.md](../../../web/readme.md)  
    


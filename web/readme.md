
### Front-end Files Development/Composition Environment

In this /web directory resides back-end (web-PHP) composition files.  
A web file is the end point of an app. 
It might be single file or composition of files (xHTML) to build a specific view.

This /web directory is protected from direct access by web server, a non-public directory.  
A php file in this directory is a template-gateway to a view (either template or layer) builder.  

One of the advantage of this structure is that a web crawler cannot access the php file without the web server,  
while the php file itself behaves as it resides in the /public directory  
(since the documentRoot is /public directory).  
Static files like (js, css, image etc) expected to be in the /public folder.  

A destination file in this /web directory might be accessed in two different ways
   + Direct access (Forward route)  
   + Controller access (Regular route)  
   
A **Forward Route** is a route with a destination-path defined route.  
For example the following route matches the root URL path (/) with GET requests and  
forwards directly to home.php file.  
```
RouteBuilder('GET', '/', '../web/home.php');
```

A **Reqular Route** is a Controller::method defined route.   
For example the following route matches the root URL path with POST request and   
instantiates the RootPath object, following with invoking the post() method.  
If there are parameters then these parameters will be as arguments passed to the post() method.  
```
RouteBuilder('POST', '/', 'RootPath@addHomePagePost');
```

#### Forward Route, Integrating Destination file with a Controller
While a forward route skips the Controller matching (dispatch and invoke) process, any controller can still be  
instantiated from a destination file.  
This might look like a callback, but it is nothing more than a different work-flow.  
A front-end developer might feel more comfortable with this work-flow.      

Instantiating a controller from this /web directory will look like the following code.  
```
$test = new App\Controller\Test();
```
##### Forward route Best Practice
In a destination file the variable ```$route``` array with ```indexKey``` will be globally available.  
A route indexKey value is unique and looks like this ```e531c13f9cf22ea38d0ccb29e27f1449```.  

Lets say we have this file
```
app/DataStorage/e531c13f9cf22ea38d0ccb29e27f1449.php
```
With the content
```
<?php

return [
    'title' => 'Example Title - example.com'
];
```

Having a data store, with this indexKey value, will make the job fetching appropriate data easy.  
It is a common use that there will be an adapter or some kind or repository manager to access the data store. 

For the practical example we call this adapter a handler.  
First prepare a handler in the directory /handler like this   
```/handler/Page/Data/Handler.php``` with the callable ```title()``` function. 

```
namespace Page\Data;

class Handler
{
    private $indexKey;
    private $pageData = [];  
    
    public function __construct($indexKey)
    {
        $this->indexKey = $indexKey;
        $this->pageData = include dirname(getcwd()) . '/app/DataStorage/'.$indexKey.'.php';
    }

    public function title()
    {
        return $this->pageData['title'];
    }
}
```
 
Using the class above from the route-destination file (e.g. home.php) will be look like this.
```
    // Instantiate the Controller object
    $test = new App\Controller\Test();  
    
    // Select the page data handler by route indexKey
    $pageData = $test->renderPageData($route['indexKey']);  
    
    // Get the value
    $title = $pageData->title();  
    
    var_dump($title);
```
Of course the same result could be done with non-object oriented programming way. 



#### Regular Route, Integrating Controller with a Destination file
In the destination method of the controller class use code like the one below.  
There is no need for echo or print, the outputHandler will take care of it.
```
ob_start();
$renderPageData = $this->handlers->renderPageData($route['indexKey']); 
include "../web/home.php"
return ob_get_clean();
```
Notice, since we are using an output handler for the response, output buffering is a better way.  

And in the file ```home.php```
```
$renderPageData->title();
```

#### Which routing

**forward-routing** might be the choice when; 
+ No need for back-end controller instantiation at first or occasionally needed.
+ Querying from the view to any controller is preferred.

**regular-routing** might be the choice when;
+ No need for destination view file. (for example json response or no output response at all)
+ Request method is about SET (POST, PUT etc) to be be handled first, before the output generation.


   

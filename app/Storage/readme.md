#### Storage env 

Saved, and mostly generated, data to reuse.  

+ meta data - such as platform, route information -
+ portable - usually xml -
+ cache
+ logs


 
#### Example use case  
A new project was requested.  
There will be a specific route, think of an url, for it.
No database usage.

In MOM Web Delivery every unique location (URL) route is addressed by an `indexKey`.
```
var_dump($route['indexKey']);
string 'e531c13f9cf22ea38d0ccb29e27f1449' (length=32)
```
by using the indexKey
```
'/app/Storage/Routes/'.$route['indexKey'].'.php';
```
the data can be fetched, for example by include   
```
 include /app/Storage/Routes/e531c13f9cf22ea38d0ccb29e27f1449.php
```



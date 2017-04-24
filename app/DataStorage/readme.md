#### DataStorage env 
In this directory resides storage files with data sets.  
These files are mostly generated to reuse.
Therefore this directory should remain writable.

Storage files are;
+ Route related md5().php files. 
+ Caching files

Data sets are;
 + input data to process
 + template data to reuse
 + result data to fetch
 
Example usage  
New route created and there is no need to connect to database, 
but fetch the data from a file storage.

In that case the `indexKey` of that route will be very useful
to save data in correct file and fetch contents.

Routing of this system provides a ```$route``` array and every route contains indexKey. 
```
var_dump($route['indexKey']);
string 'e531c13f9cf22ea38d0ccb29e27f1449' (length=32)
```

To match the storage file with the route
Create a filename that equals to the ```indexKey``` 

```
/app/DataStorage/e531c13f9cf22ea38d0ccb29e27f1449.php
```
A route-related storage file can be used dynamically. 
```
$this->pageData = include dirname(getcwd()) . '/app/DataStorage/'.$indexKey.'.php';
```

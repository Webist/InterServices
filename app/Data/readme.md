#### Data env 
In this directory resides data sets.  
Data sets are;
 + input data to process
 + template data to reuse
 + result data to fetch
 
Example usage  
New route created and there is no need to connect to database, 
but fetch the data from a file storage.

In that case the `indexKey` of that route will be very useful
to save data in correct file and fetch contents.

Every route contains indexKey. 
```
var_dump($route['indexKey']);
string 'e531c13f9cf22ea38d0ccb29e27f1449' (length=32)
```

Create a filename that equals to the ```indexKey``` 
```
/app/Data/e531c13f9cf22ea38d0ccb29e27f1449.php
```
Using a php-data file.
```
$this->pageData = include dirname(getcwd()) . '/app/Data/'.$indexKey.'.php';
```

#### App Data 
In this directory resides data sets, c.q. data store, files.  
Apart form the Interface data, see directory Config, these data sets are;
 + input data to process
 + template data set to reuse
 + result data to fetch
 
For example  
When there is a new route created, in this directory a new
file with the name indexKey of that route created.
This will make fetching data easy.

```
var_dump($route['indexKey']);
string 'e531c13f9cf22ea38d0ccb29e27f1449' (length=32)
```

A filename that equals the ```indexKey``` 
```
/app/Data/e531c13f9cf22ea38d0ccb29e27f1449.php
```
Using a php-data file.
```
$this->pageData = include dirname(getcwd()) . '/app/Data/'.$indexKey.'.php';
```


### Serialized data
.... 
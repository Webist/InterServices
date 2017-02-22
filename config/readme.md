### By vendors required directory

```php
Anecdote  
   This system at the core, with M.O.M, does not require config directory.
   Config's are usually Specification interfaces (php files). 
   See the directory /app/Spec  
   
   When this system at the core requires certain config implementation, 
   then there will be an interface will be instantiated. 
   Non existing interface will throw an exception 
   which is a guide to implement the interface with config parameters.
```


This directory was not required until the implementation
+ Doctrine  
  cli-config.php is a hardcoded requirement for Doctrine implementation.
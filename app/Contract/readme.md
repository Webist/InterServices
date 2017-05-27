### Contract - Specification, Behave Interfaces

Initial specification data with Interface constants.

Interface constants hold the *configuration*, among the other settings, data.


#### Interface, best practices
To avoid sensitive pollution interface objects are split in two ways of usage.

1. Specification defining Interfaces
2. Behave defining Interfaces

##### Specification defining Interfaces

Specifications are constant value agreements to reuse in the whole system as the type of configuration values.
Depending on context these might be strategy, settings, initial values.  

For example registering a class string can be used to access a facade (a service object) in MVC setup.
```php
interface App\Contract\Spec\Controller
{
    const  CONFIRMATION_MESSAGE_KEY = 'success';
}
```


##### Behave defining Interfaces   
Class Methods are behaviour agreement declarations to define a consistent minimum required implementation. 
```php
interface App\Contract\Behave\Customer extends Controller
{
     function handle();
}
```


##### Removing cyclomatic complexity 
Interfaces are good for removing cyclomatic complexity (if, else, switch, ... statements).

A conditional statement can be considered to define a configuration.
This configuration can be moved to an interface object to avoid a conditional statement.

Example   
```
    const inputStream = INPUT_SERVER;
    const inputStreamRequestUri = "REQUEST_URI";
```
Depending on web server mod_rewrite settings,  
the specification above could be changed  
and the system should just work.
```
    const inputStream = INPUT_GET;
    const inputStreamRequestUri = "uri";
```

##### Avoid using sensitive data in Interfaces
However all configuration data preferred to save in interface objects,  
some data is sensitive and should not be shared.

An interface constant will be visible to all inheriting classes and subclasses,
there is no hiding.

Recommendations  
+ Save authentication configuration in a separate file such as `.private.inc`.
+ Do not move every configuration to a single main interface object to avoid pollution.


Read more   
https://en.wikipedia.org/wiki/Constant_interface



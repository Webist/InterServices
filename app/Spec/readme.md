### Specification Env

This directory can be seen as the main-board of the system.
Herein resides the initial specification data (interface constants) 
-and methods- of a model.  

An app-specification is preferred to be an interface, which is a php file, 
and the main purpose is providing configuration to the implementing objects.

As of M.O.M (Machine Object Model)  requires every Controller and Handler implements a specification.
These specification data, via interfaces, will be available to every implementing 
classes and subclasses. Use it with caution.
To avoid sensitive pollution split interfaces in two different interface objects.

### `interface` object usage
+ Specifications;   
Specifications are constant value agreements to reuse in the whole system as the type of configuration values.
Depending on context these might be strategy, settings, initial values.  

For example registering a class string can be used to access a facade (a service object) in MVC setup.
```php
interface Main
{
    const CUSTOMER = \Commerce\Customer::class;
    
    const DOCTRINE = \App\Service\Doctrine::class;
    const DOCTRINE_PATH_TO_ENTITY_FILES = ['app', 'handler'];
}

interface App\Spec\Controller
{
    const  RESPONSE_MESSAGE_KEY = 'message';
}
```


+ Class Methods, behaviour;   
Class Methods are behaviour agreement declarations to define a consistent minimum required implementation. 
```php
interface Customer extends Controller, Main
{
     function handle();
     function buildOperations($postData);
}
```


### Anti-pattern warning
Generally known that an `interface` should specify the behavior.   
When using an interface for specification; 
For example the following example specifies  
the inputStream resource. 

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

The point of using interface here is;
+ No conditional checks (cyclomatic complexity) in the underlying code.
+ Interface is the specification (the app DNA). It is that simple.

#### Do not use sensitive data in Interfaces
Since an interface constant will be visible to all inheriting
classes and subclasses, there is no hiding.

```css
Tip :  
Generally the dot prefixed files are not committed to the public environments.
Creating a file with dot prefix e.g. `.private.php` with class `interface private {}`
might be a good solution.  

In any way better than during every request handling checking if a file or directory exists 
and eventually redirecting the user to installation directory.  


```


Read more   
https://en.wikipedia.org/wiki/Constant_interface
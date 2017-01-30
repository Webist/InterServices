### App Entry Point controllers

When regular route dispatched, 
then the appropriate Controller in this directory invoked.

M.O.M (Machine Object Model)  
**Machine object model principles**   

A machine object should: 
  + implement specification (for example via interfaces)
  + construct with an input (process-data) as the first argument
  + construct with its handler as the second argument
  + optionally construct with an output handler as the third argument
  

A machine object is not an extension of a contextualizing system.  
It does not directly extends of inherits from an another object or object groups.

It connects to an another system, such as services or a framework, via its handler.

```
class App\Controller\Admin implements \App\Main\Admin
{
  public function __construct(InputHandler $inputHandler, AdminHandler $handler)
}
```

```
class App\Handler\Admin extends BaseController implements \App\Main\AdminHandler
{
    private $input;
    public static $main;

    public function __construct($input, MainHandler $main)
    {
        $this->input = $input;
        self::$main = $main;
    }
}
```
```App\Handler\Admin``` is injected into the ```App\Controller\Admin``` 
and extends a `BaseController` object. This object might be the connection to a framework.


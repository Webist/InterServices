### App Entry Point controllers

When regular route dispatched, 
then the appropriate Controller in this directory invoked.

M.O.M (Machine Object Model)  
**Machine object model principles**   

A machine object should: 
  + implement config (for example via interfaces)
  + construct with input (process-data) as the first argument
  + construct with its handler as the second argument
  + optionally construct with a output handler as the third argument
  

A machine object is autonomous. 
It is not an extension of a contextualizing system and therefore
does not directly extends an another object.

But it may connect to another system, such as framework, via its handler.

```
class App\Controller\Admin implements \App\Config\Admin
{
  public function __construct(InputHandler $inputHandler, AdminHandler $handler)
}
```

```
class App\Handler\Admin extends BaseController implements \App\Config\AdminHandler
{
    private $input;
    public static $global;

    public function __construct($input, GlobalHandler $global)
    {
        $this->input = $input;
        self::$global = $global;
    }
}
```
```App\Handler\Admin``` is injected into the ```App\Controller\Admin``` 
and extends a `BaseController` and this might belong to a framework.


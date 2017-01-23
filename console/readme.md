
### SystemAdmin Environment
 
 + Generate complete set MOM structure for MVC
    1. Route with ```indexKey```
    2. xController with construct, 
        * xInterface extends Global, 
        * xHandler
        * xHandlerInterface (register classes, container)
        * xException, 
    3. methods with docblock
        * get() with throw xException
        * post() with throw xException
        * postXhr() with throw xException
        * getXhr() with throw xException
        
 + Upgrade, Downgrade, Migrate commands
 
 + Worker commands

        
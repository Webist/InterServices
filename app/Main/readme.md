### App Main Specification

This directory can be seen as the main-board of the system.
Herein resides the very begin specification data and/or method of a model.  

A app-specification is typically an interface.

+ Every Controller and Handler implements a specific-config.
+ Specification-Config data, via interfaces, should be intended to share with every implementing 
classes and subclasses. Use it with caution.
 

### Anti-pattern warning
An `interface` should specify the behavior.   
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
+ No conditional checks (cyclomatic complexity) in the code.
+ Interface is the specification-config (the app DNA). It is that simple.

#### Do not use sensitive data in Interfaces
Since an interface constant will be visible to all inheriting
classes and subclasses, there is no hiding.

Read more   
https://en.wikipedia.org/wiki/Constant_interface
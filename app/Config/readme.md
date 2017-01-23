### Config (mostly interfaces, final classes)

+ Every Controller and Handler for that controller implements specific config.
+ Config data, via interfaces, should be intended to share with every implementing 
classes and subclasses. Use it with caution.
 

M.O.M (Machine Object Model)  
Every Machine (object) should implement a Config.
That is the DNA of an object. 
So it is very basic specification constant.



### Anti-pattern warning
Interfaces should specify behavior. 
For example following example specifies from which 
incoming data the variables should read.
This makes conditional checks obsolete. 
```
    const inputStream = INPUT_SERVER;
    const inputStreamRequestUri = "REQUEST_URI";
```
Read more 
https://en.wikipedia.org/wiki/Constant_interface
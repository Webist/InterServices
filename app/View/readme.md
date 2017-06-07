#### View - ViewModel

View composition tools such as a DOM builder for HTML, XML. 

A typical ViewModel does parsing data into the templates, template engine.

#### An example ViewModel / Template Engine
A placeholders-ViewModel is a simple but an effective model.  
A placeholder will be defined, such as ":pageBaseContent", in the result page.  
The viewModel by applying a replacement function, e.g. `preg_replace()`, replace this
placeholder by specified data.

[../../handler/Dom/readme.md](../../handler/Dom/readme.md)



```php
Anecdote  
Using an other viewModel or Template Engine 
a matter of creating a simple file in this directory to include the component of choice. 
```


[../../web/readme.md](../../web/readme.md)  
[../../public/readme.md](../../public/readme.md)
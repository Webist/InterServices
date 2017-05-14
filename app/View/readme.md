#### View or ViewModel

View composition tools such as a DOM builder for HTML, XML. 

A typical ViewModel does parsing data into the templates, template engine.

#### An example ViewModel / Template Engine
A placeholders-ViewModel is a simple but an effective model.  
A placeholder will be defined, such as ":pageBaseContent", in the result page.  
The viewModel by applying a replacement function, e.g. `preg_replace()`, replace this
placeholder by specified data.


```php
Anecdote  
Choosing an another viewModel or Template Engine is not blocked in any of sense.  
It is a matter of creating a simple file in this directory to include the component of choice. 
```


[../../web/readme.md](../../web/readme.md)  
[../../public/readme.md](../../public/readme.md)
### Controller env

The destination of a regular route is the controller object in this directory.

A Controller in this directory should meet the requirements M.O.M (Machine Object Model).

##### Machine Object Model principles
A machine object should: 
  + implement specification (for example via interfaces)
  + construct with an input (process-data) injection as the first argument
  + construct with its handler injection as the second argument
  + optionally construct with an output handler injection as the third argument
  
A machine object does not require:
  + Inheritance   
  Extending from other class is not required. But it might be used for some cases.
  
  
##### Anecdote  
M.O.M scales up via input acceptance and handler attachments.
For example, adding `Invoice` feature to object `Customer` is practically
  + Enrich Customer-Input 
  + Attach `Invoice` via `CustomerHandler`
  
```
$customerInput = ['genereateInvoice' => true ];
```
```
class CustomerHandler 
{
  function generateInvoice()
  {
  // .. connect to the Invoice service and handle.
  }
}   
```
```
class Customer implements Spec\Customer
{
 public function __construct($customerInput, new CustomerHanlder()) {}
}
```



### Controller env

The destination of a regular route is the controller object in this directory.

A Controller in this directory should meet the requirements [M.O.M (Machine Object Model)](http://webist.nl/articles/machine-object-model.md).

##### Machine Object Model principles
A machine object should: 
  + implement specification (for example via interfaces)
  + construct with an input (process-data) injection as the first argument
  + construct with its handler injection as the second argument
  + optionally construct with an output handler injection as the third argument
  
A machine object does not require:
  + Inheritance   
  Extending from other class is initially not required.
  When it might seem good idea to implement an abstract class, for example reusing it from different class, 
  then the way of constructing of the client-sides should be reconsidered.
  
  
##### Anecdote and example
M.O.M scales up via input acceptance and handler methods.  
For example, adding `Invoice` feature to object `Customer` is practically
  + Specify the `Invoice` class in main interface
  + Enrich Customer-Input with parameters
  + Access `Invoice` via `CustomerHandler`
 
 
Add to main interface. 
```
interface Main
{
    const Invoice = \App\Service\Invoice::class;
}
```  
Some input parameters.
```
$customerInput = ['genereateInvoice' => true ];
```
Handler method for the customer object.
```
class CustomerHandler extends AbstractHandler 
{
 // ..
}
```

```
$customerHandler = new CustomerHandler();
```
```
class Customer implements Spec\Customer
{
 public function __construct($customerInput, $customerHandler) 
 {
   // .. $this->input = $customerInput;
   // .. $this->handler = $customerHandler;   
   
   
   // .. $invoice = $this->handler->service(self::Invoice, $this->input);
   // .. $invoice->generateInvoice();
 }
}
```



#### Mail handler, test only

A good way of writing mail handler should look like this
```php
    public function __construct(MailData $customerData, $mailHandler)
    {
      // ...
    }
    
    public function handle()
    {
      // ...
    }
```
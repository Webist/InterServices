### Services - Components

Domain services.
These services are mostly used by [Application services](../app/Service/readme.md).   

**Example components**

+ Infrastructure 
  + Http\Routing\RouteHandler
  + App\Storage\Meta
  + Exceptions\Customer

+ Persistence layer access 
  + Connector\Database
  + Connector\ORM
+ Persistence layer data objects / Entities
  + Account\UserData
  + Commerce\CustomerData
  + Mail\EmailData
  + Payment\BillingScheduleData
  + Payment\CreditCardData
+ Persistence layer execution and after
  + Statement\Operation
  + Statement\Operator
  + Journal\EntityEventData
  
+ View layer / User Interface / Presentation Layer
  + Dom\Html\Element




```
/vendor directory contains also similar handlers.  
These are developed by external organisations or persons.
Handlers in this directory are the candidate components for vendor directory.
```

[Mail/readme.md](Mail/readme.md)
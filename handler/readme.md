### External Handlers

In this /handler directory resides various components.  

A handler deals with specific type of job.
Examples are 
   + Mailer   
   Sends email.
   + Http  
   Reads http input and dispatches a route.
   + Customer 
   Accepts CustomerData, EntityManager and sends to storage.  
   Notice:  
   CustomerData is called Entity in DDD.   
   Customer might look similar to Repository.
   ```


/vendor directory contains also similar handlers.  
These are developed by external organisations or persons.
### Internal Handler env

An internal handler is a injected handler object of a controller.
Every controller should have its handler representation in this directory.

Internal handlers are useful for making use of;
+ External services
+ Main specifications
+ Specific business logic

An external service might be;
+ Connection to a database as service

A main specification might be;
+ Admin E-mail address saved in `Spec\Main` interface to use throughout the system. 

Specific business logic might be;
+ Validation controller specific data, like checking if a certain post value exists. 

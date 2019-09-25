# DEPRECATED

This project is no longer subject to any further development.

### I am working on a new project
Last two years much effort has been focused on my self-thought Delivery Model in private workspace.

Some of the significant features of the new Delivery Model I am working on;

Named `Callable`;
 
 + Delivery path resolve. 
   A callable, for instance a class-file, is a hashed keyword match. No routing system as it is known in the wild. 
 
 + M.O.M development model. M.O.M stands for Machinery Object Model. 
   M.O.M is interactivity driven, instead of abstract (class) structures. 
   It enforce's high disciplined object creation with clear roles, every single time. 
   It disapproves abstract classes, most design patterns (including containers, registry, factory),
   constant's, dynamic variables and many other magic that unfortunately come along with the language it self.
 
 + Every internal delivery model is by default questionable by the independent command-line interface 
   and directly implement-able by the independent http-docs layer. 
   Technically speaking the delivery model is an Entry-Govern-Service pattern instead of Model-View-Controller pattern.
   View model is the http-docs layer that compose the templates and wrap the (data) result-set in a markup language.
   
   View model is detached, It does not extend or belong to the internal delivery model, 
   instead it implements the delivery-engine by choice.
   Similar to automobile's those are built with arbitrary carrosserie and implement the qualified engine.
   The engine of the automobile is a prepared callable. That is repsonsible for delivering result-set, 
   (c.q. processing the proper data for the actual request), after the client-side (http-doc's layer) calls it's callable.
   
 + Standarized input options (command-line input), and parameters (http request inputs).
   High discipline consistency and convention everywhere. 
   For example an input option/parameter such as `limit` or in short `-l` is a convention that is nicely cleaned and available via Filter object. 
   
 + Package-able (micro) services. A service is by default built with `Planner[Input, Operator[Task, Adapter]]` pattern.
 
 Reach me via https://webist.eu

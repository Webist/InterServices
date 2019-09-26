# DEPRECATED

This project is no longer subject to any further development.

### I am working on a new project
Last two years I've been focused with much attention on my new Delivery Model project in private workspace.

Some of the significant features of the new Delivery Model;

Named `Callable`;
 
 + Delivery path resolve. 
   A callable, for example a class-file, is a hashed keyword match. No routing system as it is known in the wild. 
 
 + M.O.M development model. It stands for Machinery Object Model. 
 
   M.O.M is interactivity oriented, instead of abstract (class) structures orientation. 
   It fully disregards object inheritance mechanism (including SOLID principles). 
   Instead it enforce's composition with clear roles.
   
   It disapproves abstract classes, most design patterns (including containers, registry, factory),
   constant's, getter-setter tricks, dynamic variables, annotations and many other magic that also come along with the programming language it self.
 
 + Every internal delivery model is by default possible to question via CLI interface. 
   A simple http-docs layer (typically `public/index` page), as client, makes the same delivery model via Browser interface callable. 
   Meaning, it is by design that every command-line option can represent http request parameter without touching the originally written delivery model code.
 
   Technically the internal delivery model is an Entry-Govern-Service pattern instead of Model-View-Controller pattern.
   View model is by desing completely apart from the internal delivery model, there is no any cyclomatic condition involved. 
   It only comes in play as the part of the http-docs layer where the composition of templates done. 
   View model do not extend or belong to any structure, instead it implements a result-set delivery model by choice.
   
   Note: An MVC pattern would perfectly work within the MOM model, however a tight-coupled of View model is not accepted.
   
 + Standarized input options (command-line input), and parameters (http request inputs).
   High discipline consistency and convention everywhere. 
   For example an input option/parameter such as `limit` or in short `-l` is a convention that is nicely cleaned and available via Filter object. 
   
 + Package-able (micro) services. 
   An advanced service composite a pattern such as `Planner[ Task[ Filter[ Input, Handler ]], Operator[tty, Adapter]]`.
 
 Reach me via https://webist.eu

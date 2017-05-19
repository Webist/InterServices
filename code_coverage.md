### Config and Magic  
Note that vendor components are excluded.  
+ 0 ini_set configurations, env variable usage
+ 0 Superglobal usage
+ 0 Global constants usage
+ 0 Object-Recursions
+ 0 Object-Serialization
+ 1 Exotic file conversion for configuration (database credentials), such as yaml, ini, xml  
    Following file is used for database connection `app/Contract/Spec/.private.inc`
+ 0 Reserved words
+ 1 Path magic, `private const CONTROLLER_PATH_NAME = "App\\Controller\\";` see `NameServer` object.  
    This constant will be derived from Meta specification.
+ 0 Naming conversion magic (no prefixes, suffixes, camelCase, ...)
+ 0 Pre-defined Bundle/Module rule. Non-existent.
+ 1 Magic method, `__construct` (unavoidable, it is the PHP language construct), 
    Should be replaced in `main` if the language choice is C++ or JAVA.   
+ 0 Mutability after construction (immutability).  
    Note: The used ORM tool with setters is a vendor tool. 
+ 0 public `public $` variables. For public class `const` used.   
+ 0 Factory, DI is used
+ 0 High-level Parent-Child inheritance. All composition.
+ 0 Controllers (Projects) without `interface` implementation
+ 0 Internal Handlers (InterActors) without `interface` implementation
+ 0 `abstract class`, and so less pollution, no "one base class" tight coupling and no discrimination by types  
    Implementation requirements or default behavior are done via `interface`s.  
    Encapsulation is preferred in Closures.  
    Reuse is done by DI.  
    Having 0 amount of abstract classes can be considered as of 
    overall applied single responsibility, high cohesion, loose coupling and 
    separation of concerns.  
    
    Abstracting is essentially doing reconstruction by adding 
    or removing classes to move responsibilities to higher or lower level modules.  
    
    In another words, you add abstraction by applying for example by doing loose coupling  
    but not creating a class and adding the prefix abstract to it.
+ 0 `instanceof`, `is_array`, `is_object` etc. usage
+ 0 output buffering

    




#### Testing, Code Inspection, Static analysis, Code Coverage  
Making use of following tools are in the road-map.  
+ Code smell
+ Code Style
+ Naming conventions
+ PHPDoc, phpdox
+ Control flow
+ Code Sniffer
+ Mess detector
+ phploc
+ pdepend
+ phpcpd
+ Probable Bugs
+ Undefined
+ Unused
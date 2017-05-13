### Config and Magic  
Note that vendor components are excluded.  
+ 0 ini_set configurations, env variable usage
+ 0 Superglobal usage
+ 0 Global constants usage
+ 0 Object-Recursions
+ 0 Object-Serialization
+ 1 Exotic file conversion for configuration (database credentials), such as yaml, ini, xml  
    This single database credentials file will be replaced by php interface class `interface private {}`
+ 0 Reserved words
+ 1 Path magic, `private const CONTROLLER_PATH_NAME = "App\\Controller\\";` see `NameServer` object.  
    This constant will be derived from Meta specification.
+ 0 Naming conversion magic (no prefixes, suffixes, camelCase, ...)
+ 0 Pre-defined Bundle/Module rule. Non-existent.
+ 0 Magic methods (so far), except __construct and a vendor component [Magic methods in PHP](http://php.net/manual/en/language.oop5.magic.php)
+ ~ Data Injection via __construct instead using setters for immutability   
    More will be refactored for this principle
+ 0 Factory, DI is preferred

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
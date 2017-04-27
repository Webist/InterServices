#### Source Builds - Repository builds

Reads, via query, are destined for relational data structures (instead of event store).

#### Indications of Source fields
Source field indications are recognizable by looking at the command or the field name.  
+ name
+ size
+ is-house
+ has-car

These are not event attributes such as status, active, approved,
but property or trait defining indicators to build the relations in
a data structure. 
These data structures are description of body's.

#### Specific Source Schema's
A source schema would be a 1 to 1 reflection of an entity.


```
Anecdote:  
CQRS seggrates command and query.
Taking this concept to further level is segragating Event and Source.
```
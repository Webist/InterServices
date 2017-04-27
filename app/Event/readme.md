#### Event builds - Projection builds

Updates, via commands, are destined for event store (instead of relational data store).

#### Indications of Event fields
Event field indications are recognizable by looking at the command or field name.
+ status  
+ active
+ updatedAt
+ approved

These are not source attributes such as name, size of an entity, 
but state defining indicators to locate the position in the business process.
These business processes are a workflow or an event stream.

#### Specific Event schema's
An event schema can be 1 to 1 with resource-entities, but the best practice
would be easy to recognize naming with the domain.
For example customerEvents.
Since a Customer information would built up from multiple schema's like 
User, UserProfile, Payment all the related events can be stored in the 
customerEvents schema.


```
Anecdote:  
CQRS seggrates command and query.
Taking this concept to further level is segragating Event and Source.
```
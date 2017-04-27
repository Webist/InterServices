#### Event builds - Command

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

```
Anecdote:  
Journal\EntityEvent creates also records on postPersist, postUpdate for every entity.
These records are system-generic logs. It is not specified on a domain. Trying to get 
specific domain event logs would result in complex projection read models.
```


#### Specific Event schema's
An event schema can be 1 to 1 with resource-entities, but the best practice
would be an easy to recognize naming accordingly with the domain.
For example customerEvents.
Since a Customer information would built up from multiple schema's like 
User, UserProfile, Payment all the related events can be stored in the 
customerEvents schema.


```
Anecdote:  
CQRS seggrates command and query.
Taking this concept to further level is segragating Event and Source.
```
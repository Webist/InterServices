### Journals - Generated change logs

A Journal component is by an event triggered recorder.
These event recorders are mostly triggered before or after a difference.
A difference indication occurs from a certain change of a product, service or time.


```
Anecdote:
Double-entry accounting module uses also the term journal.
A journal is a record in a many-to-many relation schema for the Account and Invoice entities.
Attaching an Invoice to an Account (either debt or credit) is done via Journal-schema, therefore strict relations.
```

#### Journal types in (event) logging

+ **Event Loggers - Relational Model**
```
Anecdote  
A relational model is applied to product/service to increase its market-value by various enrichments.
```

  Event Logs are "apply only" by value difference (e.g. new-old value) triggered records;
  + Application runtime information, report, error logs to review
  + (Big) Data generation to research
  + Magazine data generation about particular subject or hobby
  + Specific practical information
  

+ **Transition Recorders - Event Stream Model**
```
Anecdote  
A stream model is applied to product/service to increase its availibiltiy and does not care about the market-value. 
```

  Transition Records are "apply only" by transition (e.g. changeItem(x) command ) triggered event records;
  + Transition records in a generic Domain (e.g. the track for new-to-old )
  + Transition records in a (throwable) specific event stream (e.g. shopping cart usage track history by a specific user)

Event Stream Model records uniquely the events leading to a particular-state of something to resource the "state history", 
and they care less about the structural representation.
Resourcing the relational-state from different perspectives is not evident.  

Representational-state in Event Stream Model are solved with projections in the application layer, 
called persistent read model.
These read models are actually generated cache's (e.g. documents in json). 


Illustrations 

+ Journal'ing in an Event Stream Model
```
                                 [itemAdd]
                                     |
[ x = null ] --- transition ---> [ x = A ]
                     |                |
                     |                ---> Command Handler : Aggregate root (domain/entity current state)
                     |                       | (MessageBus/Router)
                     |                       |
                     |                     Repository
                     |                       | (Data Mapping), (Diff Handling)
                     |                       | EventBus
                     |                       v
                   uuid ------------------- [itemAdded]
                                             |  |_ subscriber
                                             |  |_ subscriber
                                             |
                                             v
                                           Event Store =/= Journal History
                                             |
                                             |
                                             v                                           
                                           Data Store =/= Relations 
                                                   (Persistent Read Model)  
                                                           
[itemAdd] is the command.
[ x = A ] is wrapped in a serialization (a sort of caching).
[itemAdded] is a (translated, e.g. account balance) result-state record.
Transition process to [itemAdded] requires immutability.
```

    
+ Journal'ing in a Relational Model
```
                                 [itemAdd]
                                  ---/---
[ x = null ] --- transition ---> [ x = A ] 
                     |                |
                     |                --> Repository
                     |                      | (Data Mapping)
                     |                      |
                     |                      v
                     |                    Data Store =/= Relations
                     |                      |     (Relational Database)
                     |                      |     (Diff Handling)
                     |                      | Event Triggering / Listening
                     |                      |
                     |                      v
                   uuid ------------------ [itemAdded] 
                                            |  |_ subscriber
                                            |  |_ subscriber
                                            |
                                            v
                                          Event Store =/= Journal History
                                                               
[itemAdd] is the command.
[ x = A ] is the latest representational state. 
[itemAdded] is the whole or partly result-information record.
Transition process to [itemAdded] does not require the immutability.

```

As it can be seen above, event-sourcing is triggered at the transition stage.
Business logic is essentially "the truth is the latest result". 
This is useful for business cases like shipment handling 
as the latest state is the main concern.  

Some of the use cases  
+ Shipment Handling
+ Bookkeeping (Banking, Accountancy)
+ Document Management (Justice, Lawyers, Consultancy Framework/Process )
+ Risk Governance Framework (Change management, Monitoring and Control)
+ Certification Audit Process
+ Recruitment / Acquisition Process
+ Publication (Ad) Framework
+ Telecom Communication (short-living throwable connection records)
+ Shopping Cart (process)
+ IoT (portable short-living data exchange)

#### A real world example
Scenario:   
Product/Service X was ordered and will be drop-shipped.

Roles:   
+ X provider (producer)
+ X Handler, Shipment organisation (transition provider)
+ X reseller (merchant)
+ X buyer (end user)

+ Payment processor (Bank)
+ Accountancy office


Shipping product X to a reseller requires some transition changes.
For example reserved, dispatched.
Since these transition processes can take couple of days and might stuck somewhere,
the X reseller, X provider, X buyer are interested in tracking the shipment status.  

The value of the X is not in interest of the X Handler (shipment) provider.
Therefore the business of the X Handler fits in Event Stream Model.
Since every state change is a new record in the event-store (database)
the workflow is a finite state-machine.   

All other roles are interested in the value of X.
Since the value of X is an output of relational structure (for example a relation to "how to use manual"), their business fits
in a relational model. 
Direct accessible representational state, c.q. database, is in their best interest.

They will use Money and Invoice relations for X so the event-stream becomes possible.
They will exchange information with the Bank and Accountancy office.

Even the merchant (X reseller) might seem an event-streaming organisation, their
real business is building relations like ads, landing pages,
categories and many more around that product.

We can easily conclude that the event-stream using organisations are the transition helping middleman's
between the relationally built structures.  

#### Business Domains indications for Event Sourcing 
+ Automating the middleman
Business domain takes the role of a middleman.
In this case applying event-sourcing should be a good solution.
Because then the business value excels with being a stateMachine 
by providing transaction (sync), current-state, current-place, difference's and version'ing.

+ The market-value is not in our interest or business.
Business domain does not operate around enriching relations.

+ A Delivery Framework
Business domain might indicate the transportation of needs is main operation.
Short-living state and delivering as soon as possible is the ultimate goal. 

+ Portable data set exchange, sync.
Exchanging portable data sets might indicate a business domain
need to be build around feeding a state.


These delivery systems might stay hidden to us. 
For example an MVC model itself is a web delivery framework.
Every request is an event.


### StateMachine - Life Cycle Callbacks

State Machine Model complements event sourcing.  
Guarding states.   
Chaining transactions and preventing interferes.  
Advertising, distributing and defining the possible (following) states. 




http://blockchain.glorat.net/2015/11/16/6-components-of-any-blockchain-design-solution/
 
 
 
 
   
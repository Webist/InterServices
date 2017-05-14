#### Mail handler, test only

Sandbox processing an email.
+ Authorize : Validate against filters such as blacklist, dns-record.            
+ EmailData : Data object (Entity) for data mapping
+ Email : Data object command
+ EmailSend : Real email send handler
+ ReturnValue : Aggregation of result values in object

Non-implemented 
+ Workflow : Transition stages for an email.   
             Useful when the requirements are advanced, such as an email should be approved first.
             Spreading email process of multiple machines will become easy.
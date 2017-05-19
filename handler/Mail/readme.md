#### Mail handler, test only

Sandbox processing an email.
+ EmailAuthorize : Validate against filters such as blacklist, dns-record.            
+ EmailData : Data object (Entity) for data mapping
+ EmailSend : Real email send handler

Non-implemented 
+ Workflow : Transition stages for an email.   
             Useful when the requirements are advanced, such as an email should be approved first.
             Spreading email process of multiple machines will become easy.
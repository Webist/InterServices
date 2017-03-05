### Front-end Template Composition

Here resides reusable HTML components.

This directory is named to currently used front-end template Metronic.


#### Reusable
Re-occurring parts of this template is split into chunks in php files.


#### Template Build
Starting with ```html.page.php``` as layout templates are parsed by matching the placeholder.

Example 

1. Declare a placeholder in desired page.
```php
  <!-- BEGIN PAGE BREADCRUMB -->
   :pageBreadCrumb
  <!-- END PAGE BREADCRUMB -->
```

2. Use a data holder object (entity in DDD, or operand). 
Create a custom one if not was required via ORM.

```php
class BreadCrumbData
{
    private $text;
    
    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text)
    {
        $this->text = $text;
    }
}
```

3. Inject data-object, Require template and Place into the appropriate content.
```php
$breadCrumb = new \Html\Element($breadCrumbData);
$breadCrumb->require( '../web/metronic/html.page.breadcrumb.php');
$bodyContent->addElement(':pageBreadCrumb',$breadCrumb);
```
4. Now the BreadCrumbData is in the parsed file and can be called like this.  
```php
<?= $this->data->getText() ?>
```
Anecdote:  
Do not use logic-statements, like [if, else] in templates.
Move those to data-object or even higher level. 
A template should get the end-point data.


#### Models Design
Dealing with the data mappings difference between Back-end Domain Model and Front-end Model. 

While a html form might be built with the fields username, password and email in Account Setup context,
in the back-end the email field might live in data-object UserProfileData and username, password in data-object UserData.   

Since the post data will contain all these three fields (username, password, email) data,
in the back-end data mapping -should- can be done like this.
Note that we are using same ```$uuid``` instead of having linked relations between these two.
```php
     $repo = self::$entityManager->getRepository(\Account\UserData::class);
     $userData = $repo->find($uuid);   
     
     $repo = self::$entityManager->getRepository(\Account\UserProfileData::class);
     $userProfileData = $repo->find($uuid);
     
     // Profile data into UserData
     $userData->setProfileData($userProfileData);
```
Now in the template file belonging to userData, profile data can be accessed like this.
```php
<?= $this->data->profileData()->getEmail() ?>
```



# Simple DOM builder

Placeholder based DOM (html, xml) builder.  

Basically it is content building by replacing de placeholder, `preg_replace()`.

### Example build
**Steps**
+ Have an HTML template, with placeholder-text such as `:formAccountDetails` in it.
```php
dirname(dirname(__DIR__)) . '/web/metronic/form-customer/form.php'
```
+ Require this HTML template into a new Element object.
```php
$formContent = new Element([]);
$formContent->require(dirname(dirname(__DIR__)) . '/web/metronic/form-customer/form.php');
```
+ Have another HTML template and create Element object for the placeholder.
```php
$account = new Element($userData);
$account->require(dirname(dirname(__DIR__)) . '/web/metronic/form-customer/account.details.php');
```
+ Add the latest created element to the previous one
```php
$formContent->addElement(':formAccountDetails', $account);
```

Note:  
However composing content with `Element` via `addElement` can go in an endless depth, currently
there is no recursion in rendering process and max depth is 4.
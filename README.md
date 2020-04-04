# php-flashingo-messages
Session based flash messages for PHP.

Flash messages are optimalized to work with Bootstrap.

# Usage
```php
// Create new instance
$flashingo = new Romanato\FlashingoMessage\FlashingoMessage;

// Set flash messages
$flashingo->set('This is a flash message.')
$flashingo->set('I am awesome!')

// Display messages
$flashingo->displayAll();
```

# Advanced usage
```php
// Set type
$flashingo->set('This is a flash message.', 'error')

// Set options
$flashingo->set('I am awesome!', 'warning', [
  'name' => 'awesomeId',
  'class' => 'specialClass'
]);

// Display message by name
$flashingo->display('awesomeId');
```

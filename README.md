# php-flashingo-messages
Session based flash messages for PHP.

Flash messages are optimized to work with Bootstrap.

## Installation
```
composer require romanato/php-flashingo-messages
```

## Usage
```php
// Create new instance
$flashingo = new Romanato\FlashingoMessage\FlashingoMessage;

// Set flash message
$flashingo->set('This is a flash message.');

// Display messages
$flashingo->displayAll();
```

## Advanced usage
```php
// Set type using set method
$flashingo->set('This is a flash error message.', 'error');

// Set type using shorter method
$flashingo->setWarning('This is an warning but shorter.');

// Set options
$flashingo->set('I am awesome!', 'warning', [
  'name' => 'awesomeId',
  'class' => 'specialClass'
]);

$flashingo->setSuccess('I am awesome!', [
  'name' => 'awesomeId',
  'class' => 'specialClass'
]);

// Display message by name
$flashingo->display('awesomeId');
```

## Customize

#### Editing default css class
In FlashingoMessage.php you can add your own default class so it will fit perfectly for your project:
```php
public $cssDefaultClass = 'myAwesomeClass';
```

#### Adding custom types
In FlashingoMessage.php you can add your own types:
```php
public $types = [
  'default' => 'alert-primary',
  'error' => 'alert-error',
  'warning' => 'alert-warning',
  'info' => 'alert-info',
  'success' => 'alert-success',
  'custom' => 'alert-custom',
];
```

So the generated HTML can look like this:
```html
<div class='myAwesomeClass alert-custom' role='alert'>I am awesome!</div>
```

## Methods

#### set(`string` $message [, `string` $type, `array` $options])
This method sets a message. There are 3 parameters:
* `string` **$message** - The message that will shown
* `string` **$type** (optional) - Type of flash message
* `array` **$options** (optional) - Sets **name|class** for flash message.
```php
$flashingo->set($message, $type, [
    'class' => $class,
    'name' => $name
]);
```

#### setError(`string` $message [, `array` $options])
This method sets an error message.
```php
$flashingo->setError($message, [
    'class' => $class,
    'name' => $name
]);
```

#### setWarning(`string` $message [, `array` $options])
This method sets a warning message.
```php
$flashingo->setWarning($message, [
    'class' => $class,
    'name' => $name
]);
```

#### setInfo(`string` $message [, `array` $options])
This method sets a info message.
```php
$flashingo->setInfo($message, [
    'class' => $class,
    'name' => $name
]);
```

#### setSuccess(`string` $message [, `array` $options])
This method sets a success message.
```php
$flashingo->setSuccess($message, [
    'class' => $class,
    'name' => $name
]);
```

#### setDefault(`string` $message [, `array` $options])
This method sets a default message.
```php
$flashingo->setDefault($message, [
    'class' => $class,
    'name' => $name
]);
```

#### display(`string` $name)
This method shows a message with unique name.
```php
$flashingo->display($name);
```

#### displayAll()
This method shows all messages.
```php
$flashingo->displayAll();
```

#### destroyAll()
This method destroys all the session messages.
```php
$flashingo->destroyAll();
```

## Options
Every `set()` method has the same options as a 3rd array parameter:
* **name** - Unique id for flash message
* **class** - Custom class for flash message

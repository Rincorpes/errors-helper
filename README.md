# Errors Helper

Class to handle php errors

## Features

- Show stilized errors

## Usage

Include the ``Error`` class into your project using ``require_once()`` PHP function or something like that. make an instance of ``Error`` and it will display all errors.

```php

require_once 'vendor/error.php';

$error = new Vbt\Error;

```

You can add user errors by using the ``trigger_error();`` PHP function and it will display it to.

```php

triger_error('My error', E_USER_ERROR);

```
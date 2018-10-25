# DotNetPasswordHasher

PHP package for hash/validate passwords using the .NET PasswordHasher algorithm.

### Install

```bash
composer require pnicorelli/php-dotnet-password-hasher
```

### Usage

```php
<?php

require("vendor/autoload.php");

use DotNetPasswordHasher\DotNetPasswordHasher;
$hash = DotNetPasswordHasher::hash("CorrectHorseBatteryStaple");

if( DotNetPasswordHasher::verify("CorrectHorseBatteryStaple", $hash) ) {
  // Password match
  echo "yeah!";
} else {
  // Password mismatch
  echo "Nooooo";
}
```


### Test

```bash
./vendor/bin/phpunit test/*
```

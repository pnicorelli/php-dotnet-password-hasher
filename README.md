# DotNetPasswordHasher

PHP package for hash/validate passwords using the .NET PasswordHasher algorithm.

### Install


### Usage

```php
<?php

use DotNetPasswordHasher\DotNetPasswordHasher;
$hash = DotNetPasswordHasher::hash("CorrectHorseBatteryStaple");

if( DotNetPasswordHasher::verify("CorrectHorseBatteryStaple", $hash) ) {
  // Password match

}
```


### Test

```bash
./vendor/bin/phpunit test/*
```

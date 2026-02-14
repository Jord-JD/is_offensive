
# 🤬🤭 Is Offensive Helper Function

[![Build Status](https://travis-ci.org/Jord-JD/is_offensive.svg?branch=master)](https://travis-ci.org/Jord-JD/is_offensive)
[![Coverage Status](https://coveralls.io/repos/github/Jord-JD/is_offensive/badge.svg?branch=master)](https://coveralls.io/github/Jord-JD/is_offensive?branch=master)
[![StyleCI](https://styleci.io/repos/119539842/shield?branch=master)](https://styleci.io/repos/119539842)


This PHP package provides an `is_offensive` helper function. Passing a string to `is_offensive` will return a boolean telling you if it contains offensive words.

## Installation

The `is_offensive` package can be easily installed using Composer. Just run the following command from the root of your project.

```
composer require "jord-jd/is_offensive"
```

If you have never used the Composer dependency manager before, head to the [Composer website](https://getcomposer.org/) for more information on how to get started.

## Usage

To check if a word is offensive, just pass it to the `is_offensive` method.

Here are a few examples:

```php
is_offensive('fuck');  // true
is_offensive('fuk');   // true

is_offensive('duck');  // false
is_offensive('cat');   // false

is_offensive('sex');         // true
is_offensive('Middlesex');   // false

is_offensive('tit');         // true
is_offensive('Tittesworth'); // false

is_offensive('cunt');        // true
is_offensive('Scunthorpe');  // false
```

If you prefer to avoid using helper functions, the following syntax is also available.

```php
$offensive = (new OffensiveChecker())->isOffensive('fuck')  // true
```

### Custom word lists

There are reasons why you may wish to define your own list of offensive words. Perhaps the
ones supplied are too strict, or not strict enough.

```php
$blacklist = ['moist', 'stinky', 'poo'];

$offensiveChecker = new OffensiveChecker($blacklist);

$offensiveChecker->isOffensive('poo');     // true
$offensiveChecker->isOffensive('poops');   // true
```

You can also define a whitelist of words that will be accepted even if they match the defined
list of offensive words.

```php
$blacklist = ['moist', 'stinky', 'poo'];
$whitelist = ['poop'];

$offensiveChecker = new OffensiveChecker($blacklist, $whitelist);

$offensiveChecker->isOffensive('poo');     // true
$offensiveChecker->isOffensive('poops');   // false
```

---
title: Upgrading from 2.x
intro: This version removes the mutable class and renames the immutable one.
group: Reference
order: 90
---

## Summary of changes

This version is a breaking release. These are the changes that affect your code.

- `MutableBigInteger` and its interface are removed.
- `ImmutableBigInteger` is renamed to `BigInteger`.
- The namespace changes from `PHP\Math\BigInteger` to `PHPMath\BigInteger`.
- PHP 8.4 or newer is required.

## Step by step

Follow these three steps to move an existing project from 2.x.

### 1. Update the namespace

```php
// before
use PHP\Math\BigInteger\ImmutableBigInteger;

// after
use PHPMath\BigInteger\BigInteger;
```

### 2. Rename the class

Replace every `ImmutableBigInteger` with `BigInteger`. Type declarations, `new` calls and `instanceof` checks all change the same way.

### 3. Replace mutable code

Code that used `MutableBigInteger` relied on methods changing the object in place. Assign the result instead.

```php
// before
$number = new MutableBigInteger('10');
$number->add(new MutableBigInteger('5'));

// after
$number = new BigInteger('10');
$number = $number->add(new BigInteger('5'));
```

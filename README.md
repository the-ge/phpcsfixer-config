# [The Ge's PHP CS Fixer configuration](https://github.com/the-ge/phpcsfixer-config)

This is The Ge's PHP CS Fixer configuration.

## Usage

### 1. Add this package to your project by either the following methods:

> [!NOTE]
> [PHP CS Fixer](https://github.com/PHP-CS-Fixer/PHP-CS-Fixer) and [Kuba Werłos' custom fixers](https://github.com/kubawerlos/php-cs-fixer-custom-fixers) will be added as dependencies as well.

#### 1.1. Command line

```sh
composer require --dev thege/phpcsfixer-config
```

#### 1.2. Copy the package info to the `composer.json`'s `require-dev` section and install it:

```json
// [...]
  "require-dev": {
    // [...]
    "thege/phpcsfixer-config": "^1.0"
  }
// [...]
```

```sh
composer install
```

### 2. Run PHP CS Fixer (from your project's root) with this configuration either:

#### 2.1. Directly

```sh
# dry run
vendor/bin/php-cs-fixer fix src --config=vendor/the-ge/phpcsfixer-config/src/php-cs-fixer.dist.php --show-progress=dots --dry-run --diff
# real run
vendor/bin/php-cs-fixer fix src --config=vendor/the-ge/phpcsfixer-config/src/php-cs-fixer.dist.php --show-progress=dots
```

#### or

#### 2.2. As a script by adding it to your project's `composer.json` `scripts` section

```json
// [...]
  "scripts": {
    // [...]
    "fix:dry":  "vendor/bin/php-cs-fixer fix src --config=vendor/the-ge/phpcsfixer-config/src/php-cs-fixer.dist.php --show-progress=dots --dry-run --diff",
    "fix":      "vendor/bin/php-cs-fixer fix src --config=vendor/the-ge/phpcsfixer-config/src/php-cs-fixer.dist.php --show-progress=dots",
  }
// [...]
```

```sh
# dry run
composer fix:dry
# real run
composer fix
```

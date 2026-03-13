# [The Ge's PHP CS Fixer configuration](https://github.com/the-ge/phpcsfixer-config)

This is The Ge's PHP CS Fixer configuration.

## Usage

### 1. Add this package to your project's `composer.json` by command line:

```sh
composer require --dev thege/thege-phpcsfixer-config
```

or add the package info to the `require-dev` section:

```json
  "require-dev": {
    "thege/thege-phpcsfixer-config": "^1.0"
  }
```

and install it:

```sh
composer install
```

> [!NOTE]
> [PHP CS Fixer](https://github.com/PHP-CS-Fixer/PHP-CS-Fixer) and [Kuba Werłos' custom fixers](https://github.com/kubawerlos/php-cs-fixer-custom-fixers) will be added as dependencies as well.

### 2. Run it (from your project's root), either directly:

```sh
# dry run
vendor/bin/php-cs-fixer fix src --config=vendor/the-ge/phpcsfixer-config/src/php-cs-fixer.dist.php --show-progress=dots --dry-run --diff
# real run
vendor/bin/php-cs-fixer fix src --config=vendor/the-ge/phpcsfixer-config/src/php-cs-fixer.dist.php --show-progress=dots
```

or after you add it to your project's `composer.json` `scripts` section:

```json
  "scripts": {
    "fix:dry":  "vendor/bin/php-cs-fixer fix src --config=vendor/the-ge/phpcsfixer-config/src/php-cs-fixer.dist.php --show-progress=dots --dry-run --diff",
    "fix":      "vendor/bin/php-cs-fixer fix src --config=vendor/the-ge/phpcsfixer-config/src/php-cs-fixer.dist.php --show-progress=dots",
  }
```

```sh
# dry run
composer fix:dry
# real run
composer fix
```

# [The Ge's PHP CS Fixer configuration](https://github.com/the-ge/php-cs-config)

This is my PHP CS Fixer configuration.

## Usage

### 1. Add [PHP CS Fixer](https://github.com/kubawerlos/php-cs-fixer-custom-fixers) and [Kuba Werłos' custom fixers](https://github.com/kubawerlos/php-cs-fixer-custom-fixers) to your project:

```sh
composer require --dev friendsofphp/php-cs-fixer
composer require --dev kubawerlos/php-cs-fixer-custom-fixers
```

### 2. Add this configuration repository to your project's `composer.json` `repositories` section:

```json
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/the-ge/php-cs-config"
    }
  ]
```

and the package info to the `require-dev` section:

```json
  "require-dev": {
    "thege/thege-phpcsfixer-config": "dev-main"
  }
```

### 3. Finally, run it (from your project's root), either directly:

```sh
# dry run
vendor/bin/php-cs-fixer fix src --config=vendor/thege/thege-phpcsfixer-config/src/php-cs-fixer.thege.php --show-progress=dots --dry-run --diff
# real run
vendor/bin/php-cs-fixer fix src --config=vendor/thege/thege-phpcsfixer-config/src/php-cs-fixer.thege.php --show-progress=dots
```

or after you add it to your project's `composer.json` `scripts` section:

```json
  "scripts": {
    "try-fix":  "vendor/bin/php-cs-fixer fix src --config=vendor/thege/thege-phpcsfixer-config/src/php-cs-fixer.thege.php --show-progress=dots --dry-run --diff",
    "fix":      "vendor/bin/php-cs-fixer fix src --config=vendor/thege/thege-phpcsfixer-config/src/php-cs-fixer.thege.php --show-progress=dots",
  }
```

```sh
# dry run
composer try-fix
# real run
composer fix
```

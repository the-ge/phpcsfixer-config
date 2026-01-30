# [The Ge's PHP CS Fixer configuration](https://github.com/the-ge/php-cs-config)

This is my PHP CS Fixer configuration. To use it, add PHP CS Fixer to your project:

```sh
composer require --dev friendsofphp/php-cs-fixer
```

then add this configuration repository to your project's `composer.json`:

```json
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/the-ge/php-cs-config"
    }
  ],
```

and, finally, run it:

```sh
# dry run
vendor/bin/php-cs-fixer fix src --config=vendor/the/php-cs-fixer.thege.php --show-progress=dots --dry-run --diff
# real run
vendor/bin/php-cs-fixer fix src --config=vendor/the/php-cs-fixer.thege.php --show-progress=dots
```

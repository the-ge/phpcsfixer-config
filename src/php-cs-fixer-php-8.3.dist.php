<?php declare(strict_types=1);

/**
 * php-cs-fixer fix -vvv --config=".dev/php-cs-fixer-core.php" .
 *
 * File name: php-cs-fixer-8.3.php
 * Created:   2026-01-21 19:09:02
 * @author    Gabriel Tenita <g1704578400@tenita.eu>
 * @see       https://github.com/the-ge/
 * @copyright Copyright (c) 2026-present Gabriel Tenita
 * @license   https://www.apache.org/licenses/LICENSE-2.0 Apache License version 2.0
 */

$phpCsFixerconfig = (require_once __DIR__.'/.default.php');
$phpCsFixerconfig->setRules($phpCsFixerconfig->getRules() + [
    '@PHP8x3Migration'       => true,
    '@PHP8x3Migration:risky' => true,
]);

return $phpCsFixerconfig;

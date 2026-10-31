<?php declare(strict_types=1);

/**
 * php-cs-fixer fix -vvv --config=".dev/php-cs-fixer-core.php" .
 *
 * File name: php-cs-fixer.dist.php
 * Created:   2026-01-21 19:09:02
 * @author    Gabriel Tenita <g1704578400@tenita.eu>
 * @see       https://github.com/the-ge/
 * @copyright Copyright (c) 2026-present Gabriel Tenita
 * @license   https://www.apache.org/licenses/LICENSE-2.0 Apache License version 2.0
 */

$migrationRuleset = '@PHP'.\PHP_MAJOR_VERSION.'x'.\PHP_MINOR_VERSION.'Migration';
$phpMinVersion    = \PHP_MAJOR_VERSION * 10000 + \PHP_MINOR_VERSION * 100;
$phpMaxVersion    = $phpMinVersion + 100;
$phpCsFixerconfig = (require_once __DIR__.'/.default.php');
$phpCsFixerconfig->setRules($phpCsFixerconfig->getRules() + [
    $migrationRuleset           => $phpMinVersion <= \PHP_VERSION_ID && \PHP_VERSION_ID < $phpMaxVersion,
    "{$migrationRuleset}:risky" => $phpMinVersion <= \PHP_VERSION_ID && \PHP_VERSION_ID < $phpMaxVersion,
]);

return $phpCsFixerconfig;

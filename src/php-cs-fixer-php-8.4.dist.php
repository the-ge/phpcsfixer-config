<?php declare(strict_types=1);

/**
 * php-cs-fixer fix -vvv --config=".dev/php-cs-fixer-core.php" .
 *
 * File name: php-cs-fixer-8.4.php
 * Created:   2026-01-21 19:09:02
 * @author    Gabriel Tenita <g1704578400@tenita.eu>
 * @see       https://github.com/the-ge/
 * @copyright Copyright (c) 2024-present Gabriel Tenita
 * @license   https://www.apache.org/licenses/LICENSE-2.0 Apache License version 2.0
 */

$phpCsFixerconfig = (require_once __DIR__.'/.default.php');
$phpCsFixerconfig->setRules($phpCsFixerconfig->getRules() + [
    '@PHP8x4Migration'       => true,
    '@PHP8x4Migration:risky' => true,

    // Operator ----------------------------------------------------------------------------------------------------
    'new_expression_parentheses' => ['use_parentheses' => false], // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/operator/new_expression_parentheses.rst
]);

return $phpCsFixerconfig;

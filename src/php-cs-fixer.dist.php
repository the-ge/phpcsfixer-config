<?php declare(strict_types=1);

/**
 * php-cs-fixer fix -vvv --config=".dev/php-cs-fixer-core.php" .
 *
 * File name: .php-cs-fixer.php
 * Created:   2026-01-21 19:09:02
 *
 * @author    Gabriel Tenita <dev2023@tenita.eu>
 * @see       https://github.com/the-ge/
 * @copyright Copyright (c) 2024-present Gabriel Tenita
 * @license   https://www.apache.org/licenses/LICENSE-2.0 Apache License version 2.0
 */

use PhpCsFixer\Config;
use PhpCsFixer\Finder;
use PhpCsFixer\Runner\Parallel\ParallelConfigFactory;

//fwrite(STDOUT, var_export(PhpCsFixer\Runner\Parallel\ParallelConfigFactory::detect(), true));

$migrationRuleset = '@PHP'.\PHP_MAJOR_VERSION.'x'.\PHP_MINOR_VERSION.'Migration';
$phpMinVersion    = \PHP_MAJOR_VERSION * 10000 + \PHP_MINOR_VERSION * 100;
$phpMaxVersion    = $phpMinVersion + 100;

return (new Config())
    ->setParallelConfig(ParallelConfigFactory::detect())
    //->setUnsupportedPhpVersionAllowed(true)
    ->setRiskyAllowed(true)
    ->setUsingCache(false) // or
    //->setCacheFile(__DIR__.'/.php-cs-fixer.cache')
    ->registerCustomFixers(new PhpCsFixerCustomFixers\Fixers())  // composer require --dev kubawerlos/php-cs-fixer-custom-fixers
    ->registerCustomFixers(new ErickSkrauch\PhpCsFixer\Fixers()) // composer require --dev erickskrauch/php-cs-fixer-custom-fixers
    ->registerCustomFixers(new TheGe\PhpCsFixer\Fixers())        // composer require --dev thege/thege-phpcsfixer-fixers
    ->setFinder(
        (new Finder())
        ->in(__DIR__)
        ->name('*.php')
        ->name('*.inc')
        ->name('*.module')
        ->name('*.phtml')
        //->notName('*.blade.php')
        ->exclude(['.git', 'vendor'])
        ->notPath(['rector.php'])
    )
    ->setRules([ // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/index.rst
        '@PSR12'                    => true,
        $migrationRuleset           => $phpMinVersion <= \PHP_VERSION_ID && \PHP_VERSION_ID < $phpMaxVersion,
        "{$migrationRuleset}:risky" => $phpMinVersion <= \PHP_VERSION_ID && \PHP_VERSION_ID < $phpMaxVersion,

        // Alias -------------------------------------------------------------------------------------------------------
        'array_push'                       => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/alias/array_push.rst
        'ereg_to_preg'                     => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/alias/ereg_to_preg.rst
        'no_alias_language_construct_call' => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/alias/no_alias_language_construct_call.rst
        'no_mixed_echo_print'              => ['use' => 'echo'], // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/alias/no_mixed_echo_print.rst
        'set_type_to_cast'                 => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/alias/set_type_to_cast.rst

        // Array Notation ----------------------------------------------------------------------------------------------
        'no_whitespace_before_comma_in_array' => false, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/array_notation/no_whitespace_before_comma_in_array.rst
        'trim_array_spaces'                   => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/array_notation/trim_array_spaces.rst
        'whitespace_after_comma_in_array'     => ['ensure_single_space' => false], // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/array_notation/whitespace_after_comma_in_array.rst

        // Basic -------------------------------------------------------------------------------------------------------
        'braces_position' => [ // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/basic/braces_position.rst
            'allow_single_line_anonymous_functions'     => true,
            'allow_single_line_empty_anonymous_classes' => true,
            'anonymous_classes_opening_brace'           => 'same_line',
            'anonymous_functions_opening_brace'         => 'same_line',
            'classes_opening_brace'                     => 'next_line_unless_newline_at_signature_end',
            'control_structures_opening_brace'          => 'same_line',
            'functions_opening_brace'                   => 'next_line_unless_newline_at_signature_end',
        ],
        'no_trailing_comma_in_singleline' => [ // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/basic/no_trailing_comma_in_singleline.rst
            'elements' => [
                'arguments',
                'array',
                'array_destructuring',
                'group_import',
            ],
        ],
        'single_line_empty_body' => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/basic/single_line_empty_body.rst

        // Casing ------------------------------------------------------------------------------------------------------
        'class_reference_name_casing'    => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/casing/class_reference_name_casing.rst
        'integer_literal_case'           => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/casing/integer_literal_case.rst
        'magic_constant_casing'          => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/casing/magic_constant_casing.rst
        'magic_method_casing'            => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/casing/magic_method_casing.rst
        'native_function_casing'         => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/casing/native_function_casing.rst
        'native_type_declaration_casing' => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/casing/native_type_declaration_casing.rst

        // Cast Notation -----------------------------------------------------------------------------------------------
        'cast_spaces'             => ['space' => 'single'], // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/cast_notation/cast_spaces.rst
        'modernize_types_casting' => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/cast_notation/modernize_types_casting.rst
        'no_short_bool_cast'      => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/cast_notation/no_short_bool_cast.rst
        'no_unset_cast'           => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/cast_notation/no_unset_cast.rst

        // Class Notation ----------------------------------------------------------------------------------------------
        'class_attributes_separation' => [ // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/class_notation/class_attributes_separation.rst
            'elements' => [
                'const'        => 'none',
                'method'       => 'one',
                'property'     => 'one',
                'trait_import' => 'none',
                'case'         => 'none',
            ],
        ],
        'class_definition' => [ // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/class_notation/class_definition.rst
            'inline_constructor_arguments'        => false,
            'multi_line_extends_each_single_line' => false,
            'single_item_single_line'             => true,
            'single_line'                         => true,
            'space_before_parenthesis'            => false,
        ],
        //'final_public_method_for_abstract_class' => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/class_notation/final_public_method_for_abstract_class.rst
        'modern_serialization_methods' => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/class_notation/modern_serialization_methods.rst
        'no_php4_constructor'          => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/class_notation/no_php4_constructor.rst
        // PrestaShop will choke on this
        //'no_null_property_initialization' => true,
        'no_unneeded_final_method'                 => ['private_methods' => true], // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/class_notation/no_unneeded_final_method.rst
        'phpdoc_readonly_class_comment_to_keyword' => \PHP_VERSION_ID >= 80200, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/class_notation/phpdoc_readonly_class_comment_to_keyword.rst
        'protected_to_private'                     => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/class_notation/protected_to_private.rst
        'self_static_accessor'                     => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/class_notation/self_static_accessor.rst
        'single_class_element_per_statement'       => ['elements' => ['const', 'property']], // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/class_notation/single_class_element_per_statement.rst
        //'single_trait_insert_per_statement' => false,

        // Comment -----------------------------------------------------------------------------------------------------
        'no_empty_comment'                  => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/comment/no_empty_comment.rst
        'multiline_comment_opening_closing' => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/comment/multiline_comment_opening_closing.rst
        'single_line_comment_spacing'       => false, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/comment/single_line_comment_spacing.rst
        'single_line_comment_style'         => ['comment_types' => ['hash']], // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/comment/single_line_comment_style.rst

        // Constant Notation -------------------------------------------------------------------------------------------
        'native_constant_invocation' => [ // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/constant_notation/native_constant_invocation.rst
            'exclude'      => ['null', 'false', 'true'],
            'fix_built_in' => true,
            'include'      => [],
            'scope'        => 'all',
            'strict'       => false,
        ],

        // Control Structure -------------------------------------------------------------------------------------------
        'empty_loop_body'                 => ['style' => 'braces'], // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/control_structure/empty_loop_body.rst
        'empty_loop_condition'            => ['style' => 'while'], // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/control_structure/empty_loop_condition.rst
        'include'                         => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/control_structure/include.rst
        'no_alternative_syntax'           => ['fix_non_monolithic_code' => true], // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/control_structure/no_alternative_syntax.rst
        'no_superfluous_elseif'           => true,
        'no_unneeded_braces'              => ['namespaces' => true], // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/control_structure/no_unneeded_braces.rst
        'no_unneeded_control_parentheses' => [ // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/control_structure/no_unneeded_control_parentheses.rst
            'statements' => [
                'break',
                'clone',
                'continue',
                'echo_print',
                'negative_instanceof',
                'others',
                'return',
                'switch_case',
                'yield',
                'yield_from',
            ],
        ],
        'no_useless_else'             => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/control_structure/no_useless_else.rst
        'simplified_if_return'        => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/control_structure/simplified_if_return.rst
        'switch_continue_to_break'    => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/control_structure/switch_continue_to_break.rst
        'trailing_comma_in_multiline' => [ // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/control_structure/trailing_comma_in_multiline.rst
            'after_heredoc' => true,
            'elements'      => ['array_destructuring', 'arrays', 'match', 'parameters'],
        ],

        // Function Notation -------------------------------------------------------------------------------------------
        'combine_nested_dirname' => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/function_notation/combine_nested_dirname.rst
        'fopen_flag_order'       => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/function_notation/fopen_flag_order.rst
        'function_declaration'   => [ // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/function_notation/function_declaration.rst
            'closure_function_spacing'   => 'none',
            'closure_fn_spacing'         => 'none',
            'trailing_comma_single_line' => false,
        ],
        'lambda_not_used_import'        => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/function_notation/lambda_not_used_import.rst
        'method_argument_space'         => [
            'after_heredoc'                    => true,
            'attribute_placement'              => 'ignore',
            'keep_multiple_spaces_after_comma' => true,
            'on_multiline'                     => 'ensure_fully_multiline',
        ],
        'native_function_invocation'    => [ // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/function_notation/native_function_invocation.rst
            'exclude' => [],
            'include' => ['@compiler_optimized'],
            'scope'   => 'namespaced',
            'strict'  => true,
        ],
        'nullable_type_declaration_for_default_null_value' => true, // [PHP 7.1+] @Symfony @PHP8x4+Migration // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/function_notation/nullable_type_declaration_for_default_null_value.rst

        // Import ------------------------------------------------------------------------------------------------------
        'fully_qualified_strict_types' => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/import/fully_qualified_strict_types.rst
        'global_namespace_import'      => [ // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/import/global_namespace_import.rst
            'import_classes'   => false,
            'import_constants' => false,
            'import_functions' => false,
        ],
        'no_unneeded_import_alias' => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/import/no_unneeded_import_alias.rst
        'no_unused_imports'        => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/import/no_unused_imports.rst
        'ordered_imports'          => [ // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/import/ordered_imports.rst
            'imports_order'  => ['const', 'function', 'class'],
            'sort_algorithm' => 'alpha',
        ],

        // Language Construct ------------------------------------------------------------------------------------------
        'combine_consecutive_issets'    => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/language_construct/combine_consecutive_issets.rst
        'combine_consecutive_unsets'    => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/language_construct/combine_consecutive_unsets.rst
        'declare_parentheses'           => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/language_construct/declare_parentheses.rst
        'dir_constant'                  => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/language_construct/dir_constant.rst
        'explicit_indirect_variable'    => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/language_construct/explicit_indirect_variable.rst
        'function_to_constant'          => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/language_construct/function_to_constant.rst
        'get_class_to_class_keyword'    => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/language_construct/get_class_to_class_keyword.rst
        'is_null'                       => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/language_construct/is_null.rst
        'nullable_type_declaration'     => ['syntax' => 'question_mark'], // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/language_construct/nullable_type_declaration.rst
        'single_space_around_construct' => [ // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/language_construct/single_space_around_construct.rst
            'constructs_contain_a_single_space'     => ['yield_from'],
            'constructs_followed_by_a_single_space' => [
                'abstract',
                'as',
                'attribute',
                'break',
                'case',
                'catch',
                'class',
                'clone',
                'comment',
                'const',
                'const_import',
                'continue',
                'do',
                'echo',
                'else',
                'elseif',
                'enum',
                'extends',
                'final',
                'finally',
                'for',
                'foreach',
                'function',
                'function_import',
                'global',
                'goto',
                'if',
                'implements',
                'include',
                'include_once',
                'instanceof',
                'insteadof',
                'interface',
                'match',
                'named_argument',
                'namespace',
                'new',
                'open_tag_with_echo',
                'php_doc',
                'php_open',
                'print',
                'private',
                'private_set',
                'protected',
                'protected_set',
                'public',
                'public_set',
                'readonly',
                'require',
                'require_once',
                'return',
                'static',
                'switch',
                'throw',
                'trait',
                'try',
                'type_colon',
                'use',
                'use_lambda',
                'use_trait',
                'var',
                'while',
                'yield',
                'yield_from',
            ],
            'constructs_preceded_by_a_single_space' => ['as', 'else', 'elseif', 'use_lambda'],
        ],

        // Namespace Notation ------------------------------------------------------------------------------------------
        'clean_namespace'                 => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/namespace_notation/clean_namespace.rst
        'no_leading_namespace_whitespace' => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/namespace_notation/no_leading_namespace_whitespace.rst

        // Operator ----------------------------------------------------------------------------------------------------
        //'assign_null_coalescing_to_coalesce_equal' => true,
        'binary_operator_spaces' => [ // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/operator/binary_operator_spaces.rst
            'default'   => 'single_space',
            'operators' => [
                '='  => 'align_single_space_minimal',
                '=>' => 'align_single_space_minimal',
                '|'  => 'no_space',
            ],
        ],
        'concat_space'               => ['spacing' => 'none'], // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/operator/concat_space.rst
        'logical_operators'          => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/operator/logical_operators.rst
        'long_to_shorthand_operator' => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/operator/long_to_shorthand_operator.rst
        'new_expression_parentheses' => ['use_parentheses' => true], // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/operator/new_expression_parentheses.rst
        'new_with_parentheses'       => [ // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/operator/new_with_parentheses.rst
            'anonymous_class' => false,
            'named_class'     => true,
        ],
        'no_useless_concat_operator'   => ['juggle_simple_strings' => true], // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/operator/no_useless_concat_operator.rst
        'no_useless_nullsafe_operator' => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/operator/no_useless_nullsafe_operator.rst
        'standardize_increment'        => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/operator/standardize_increment.rst
        'standardize_not_equals'       => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/operator/standardize_not_equals.rst
        //'ternary_to_null_coalescing' => true, // @PHP7x0+Migration
        'unary_operator_spaces' => ['only_dec_inc' => false], // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/operator/unary_operator_spaces.rst

        // PHP Tag -----------------------------------------------------------------------------------------------------
        'blank_line_after_opening_tag' => false, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/php_tag/blank_line_after_opening_tag.rst
        'echo_tag_syntax'              => [ // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/php_tag/echo_tag_syntax.rst
            'format'                         => 'short',
            'long_function'                  => 'echo',
            'shorten_simple_statements_only' => true,
        ],
        'linebreak_after_opening_tag' => false, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/php_tag/linebreak_after_opening_tag.rst

        // PHPDoc ------------------------------------------------------------------------------------------------------
        'align_multiline_comment'             => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/phpdoc/align_multiline_comment.rst
        'no_blank_lines_after_phpdoc'         => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/phpdoc/no_blank_lines_after_phpdoc.rst
        'no_empty_phpdoc'                     => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/phpdoc/no_empty_phpdoc.rst
        'no_superfluous_phpdoc_tags'          => ['allow_hidden_params' => true, 'remove_inheritdoc' => true], // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/phpdoc/no_superfluous_phpdoc_tags.rst
        'phpdoc_add_missing_param_annotation' => ['only_untyped' => true], // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/phpdoc/phpdoc_add_missing_param_annotation.rst
        'phpdoc_align'                        => [ // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/phpdoc/phpdoc_align.rst
            'align'   => 'vertical',
            'spacing' => 1,
        ],
        'phpdoc_annotation_without_dot' => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/phpdoc/phpdoc_annotation_without_dot.rst
        'phpdoc_indent'                 => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/phpdoc/phpdoc_indent.rst
        'phpdoc_inline_tag_normalizer'  => [ // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/phpdoc/phpdoc_inline_tag_normalizer.rst
            'tags' => [
                'example',
                'id',
                'internal',
                'inheritdoc',
                'inheritdocs',
                'link',
                'source',
                'toc',
                'tutorial',
            ],
        ],
        'phpdoc_line_span' => [ // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/phpdoc/phpdoc_line_span.rst
            'case'         => 'single',
            'class'        => 'single',
            'const'        => 'single',
            'function'     => 'single',
            'method'       => 'single',
            'other'        => 'single',
            'property'     => 'single',
            'trait_import' => 'single',
        ],
        //'phpdoc_list_type' => true, // [RISKY]
        'phpdoc_no_access'    => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/phpdoc/phpdoc_no_access.rst
        'phpdoc_no_alias_tag' => [ // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/phpdoc/phpdoc_no_alias_tag.rst
            'replacements' => [
                'const'          => 'var',
                'link'           => 'see',
                'property-read'  => 'property',
                'property-write' => 'property',
                'type'           => 'var',
            ],
        ],
        'phpdoc_no_useless_inheritdoc' => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/phpdoc/phpdoc_no_useless_inheritdoc.rst
        'phpdoc_order'                 => ['order' => ['param', 'return', 'throws']], // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/phpdoc/phpdoc_order.rst
        'phpdoc_param_order'           => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/phpdoc/phpdoc_param_order.rst
        'phpdoc_return_self_reference' => [ // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/phpdoc/phpdoc_return_self_reference.rst
            'replacements' => [
                'this'    => '$this',
                '@this'   => '$this',
                '$self'   => 'self',
                '@self'   => 'self',
                '$static' => 'static',
                '@static' => 'static',
            ],
        ],
        'phpdoc_scalar' => [ // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/phpdoc/phpdoc_scalar.rst
            'types' => [
                'boolean',
                'callback',
                'double',
                'integer',
                'never-return',
                'never-returns',
                'no-return',
                'real',
                'str',
            ],
        ],
        'phpdoc_separation' => [ // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/phpdoc/phpdoc_separation.rst
            'groups' => [
                ['Annotation', 'NamedArgumentConstructor', 'Target'],
                ['link', 'see', 'author', 'copyright', 'license', 'deprecated', 'since'],
                ['category', 'package', 'subpackage'],
                ['property', 'property-read', 'property-write'],
                ['param', 'return', 'throw'],
            ],
            'skip_unlisted_annotations' => false,
        ],
        'phpdoc_single_line_var_spacing'                => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/phpdoc/phpdoc_single_line_var_spacing.rst
        'phpdoc_trim_consecutive_blank_line_separation' => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/phpdoc/phpdoc_trim_consecutive_blank_line_separation.rst
        'phpdoc_trim'                                   => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/phpdoc/phpdoc_trim.rst
        'phpdoc_types'                                  => ['groups' => ['alias', 'meta', 'simple']], // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/phpdoc/phpdoc_types.rst
        'phpdoc_types_order'                            => ['null_adjustment' => 'always_last', 'sort_algorithm' => 'none'], // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/phpdoc/phpdoc_types_order.rst
        'phpdoc_var_annotation_correct_order'           => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/phpdoc/phpdoc_var_annotation_correct_order.rst
        'phpdoc_var_without_name'                       => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/phpdoc/phpdoc_var_without_name.rst

        // Return Notation ---------------------------------------------------------------------------------------------
        'no_useless_return'      => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/return_notation/no_useless_return.rst
        'simplified_null_return' => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/return_notation/simplified_null_return.rst

        // Semicolon ---------------------------------------------------------------------------------------------------
        'no_empty_statement'                         => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/semicolon/no_empty_statement.rst
        'no_singleline_whitespace_before_semicolons' => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/semicolon/no_singleline_whitespace_before_semicolons.rst
        //'semicolon_after_instruction' => true,
        'space_after_semicolon' => ['remove_in_empty_for_expressions' => true], // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/semicolon/space_after_semicolon.rst

        // Strict ------------------------------------------------------------------------------------------------------
        'declare_strict_types' => ['preserve_existing_declaration' => false], // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/strict/declare_strict_types.rst
        'strict_comparison'    => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/strict/strict_comparison.rst
        'strict_param'         => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/strict/strict_param.rst

        // String Notation ---------------------------------------------------------------------------------------------
        'explicit_string_variable'          => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/string_notation/explicit_string_variable.rst
        'no_binary_string'                  => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/string_notation/no_binary_string.rst
        'simple_to_complex_string_variable' => true, // @PHP8x2+Migration @Symfony // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/string_notation/simple_to_complex_string_variable.rst
        'single_quote'                      => ['strings_containing_single_quote_chars' => false], // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/string_notation/single_quote.rst

        // Whitespace --------------------------------------------------------------------------------------------------
        'array_indentation'           => true, // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/whitespace/array_indentation.rst
        'blank_line_before_statement' => ['statements' => ['return', 'try']], // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/whitespace/blank_line_before_statement.rst
        'no_extra_blank_lines'        => [ // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/whitespace/no_extra_blank_lines.rst
            'tokens' => [
                'attribute',
                'break',
                'case',
                'comma',
                'continue',
                'curly_brace_block',
                'default',
                'extra',
                'parenthesis_brace_block',
                'return',
                'square_brace_block',
                'switch',
                'throw',
                //'use',
                //'use_trait'
            ],
        ],
        //'no_spaces_around_offset' => ['positions' => ['inside', 'outside']], // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/whitespace/no_spaces_around_offset.rst
        'statement_indentation'   => ['stick_comment_to_next_continuous_control_statement' => true], // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/whitespace/statement_indentation.rst
        'types_spaces'            => [ // https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/master/doc/rules/whitespace/types_spaces.rst
            'space'                => 'none',
            'space_multiple_catch' => null,
        ],
        'PhpCsFixerCustomFixers/declare_after_opening_tag'     => true, // https://github.com/kubawerlos/php-cs-fixer-custom-fixers
        'PhpCsFixerCustomFixers/no_useless_dirname_call'       => true,
        'PhpCsFixerCustomFixers/no_useless_parenthesis'        => true,
        'PhpCsFixerCustomFixers/promoted_constructor_property' => true,
        'ErickSkrauch/align_multiline_parameters'              => [     // https://github.com/erickskrauch/php-cs-fixer-custom-fixers
            'variables' => true,
            'defaults'  => true,
        ],
        'TheGe/blank_lines_before_classy_block'                => true,
    ])
;

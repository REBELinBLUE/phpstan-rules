<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/src')
    ->in(__DIR__ . '/tests');

$config = new PhpCsFixer\Config();

return $config
    ->setRiskyAllowed(true)
    ->setRules(
        [
            '@PSR1'                                  => true,
            '@PSR2'                                  => true,
            '@PSR12'                                 => true,
            'binary_operator_spaces'                 => ['operators' => ['=>' => 'align_single_space_minimal', '=' => 'align_single_space_minimal']],
            'php_unit_test_annotation'               => ['style' => 'annotation'],
            'ordered_imports'                        => true,
            'array_syntax'                           => ['syntax' => 'short'],
            'void_return'                            => true,
            'declare_strict_types'                   => true,
            'concat_space'                           => ['spacing' => 'one'],
            'native_function_invocation'             => ['include' => ['@compiler_optimized']],
            'align_multiline_comment'                => ['comment_type' => 'phpdocs_like'],
            'date_time_immutable'                    => true,
            'method_chaining_indentation'            => true,
            'multiline_whitespace_before_semicolons' => true,
            'no_alias_functions'                     => ['sets' => ['@all']],
            'no_superfluous_elseif'                  => true,
            'no_useless_else'                        => true,
            'phpdoc_no_alias_tag'                    => ['replacements' => ['type' => 'var', 'link' => 'see']],
            'phpdoc_to_comment'                      => ['ignored_tags' => ['var']],
            'comment_to_phpdoc'                      => ['ignored_tags' => ['phpstan-ignore-next-line']],
        ]
    )
    ->setFinder($finder);

<?php

declare(strict_types=1);

namespace REBELinBLUE\PHPStanRules;

use PhpParser\Node;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\Node\Stmt\Catch_;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

/**
 * @template TNodeType of PhpParser\Node\Stmt\Catch_
 * @implements Rule<TNodeType>
 */
final class NoPokemonRule implements Rule
{
    public function getNodeType(): string
    {
        return Catch_::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        $type = $node->types[0];

        if (!$type instanceof FullyQualified) {
            return [];
        }

        $part = $type->parts[0];

        if (\Exception::class === $part) {
            return [
                RuleErrorBuilder::message(
                    'You should not catch \Exception'
                )->build(),
            ];
        }

        if (\Throwable::class === $part) {
            return [
                RuleErrorBuilder::message(
                    'You should not catch \Throwable'
                )->build(),
            ];
        }

        return [];
    }
}

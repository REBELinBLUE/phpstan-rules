<?php

declare(strict_types=1);

namespace REBELinBLUE\PHPStanRules\Rules;

use Error;
use Exception;
use PhpParser\Node;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\Node\Stmt\Catch_;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;
use Throwable;

/**
 * Ensure that no code is catching the top \Exception, \Error classes or the \Throwable interface
 * as these should be handled by the global exception handler...
 *
 * So unlike Pokemon, we've not "Gotta Catch 'Em All"
 *
 * @implements Rule<Catch_>
 * @see \REBELinBLUE\PHPStanRules\Tests\Rules\NoPokemonRuleTest
 */
final class NoPokemonRule implements Rule
{
    public function getNodeType(): string
    {
        return Catch_::class;
    }

    /**
     * @param Catch_ $node
     */
    public function processNode(Node $node, Scope $scope): array
    {
        foreach ($node->types as $type) {
            if (!$type instanceof FullyQualified) {
                continue;
            }

            $part = $type->parts[0];

            if (Exception::class === $part || Throwable::class === $part || Error::class === $part) {
                return [
                    RuleErrorBuilder::message(
                        sprintf('You should not catch the root level \%s class', $part)
                    )->build(),
                ];
            }
        }

        return [];
    }
}

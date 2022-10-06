<?php

declare(strict_types=1);

namespace REBELinBLUE\PHPStanRules\Rules;

use Error;
use Exception;
use PhpParser\Node;
use PhpParser\Node\Name;
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
            if (Exception::class === (string) $type ||
                Throwable::class === (string) $type ||
                Error::class === (string) $type
            ) {
                return [
                    RuleErrorBuilder::message(
                        sprintf('You should not catch the root level %s class', $type->toCodeString())
                    )->build(),
                ];
            }
        }

        return [];
    }
}

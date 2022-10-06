<?php

declare(strict_types=1);

namespace REBELinBLUE\PHPStanRules\Tests\Rules;

use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;
use REBELinBLUE\PHPStanRules\Rules\NoPokemonRule;

/**
 * @extends RuleTestCase<NoPokemonRule>
 */
final class NoPokemonRuleTest extends RuleTestCase
{
    /** @test */
    public function invalidCatchUses(): void
    {
        $this->analyse(
            [
                __DIR__ . '/../Fixtures/NoPokemonRule/catching-root-exception.php',
                __DIR__ . '/../Fixtures/NoPokemonRule/catching-root-throwable.php',
                __DIR__ . '/../Fixtures/NoPokemonRule/catching-root-error.php',
                __DIR__ . '/../Fixtures/NoPokemonRule/multiple-catch-statements.php',
                __DIR__ . '/../Fixtures/NoPokemonRule/catch-without-variable.php',
                __DIR__ . '/../Fixtures/NoPokemonRule/catch-multiple-exceptions.php',
            ],
            [
                ['You should not catch the root level \Exception class', 7],
                ['You should not catch the root level \Throwable class', 7],
                ['You should not catch the root level \Error class', 7],
                ['You should not catch the root level \Exception class', 8],
                ['You should not catch the root level \Exception class', 7],
                ['You should not catch the root level \Exception class', 7],
            ]
        );
    }

    /** @test */
    public function validCatches(): void
    {
        $this->analyse(
            [__DIR__ . '/../Fixtures/NoPokemonRule/catching-other-exception.php'],
            []
        );
    }

    protected function getRule(): Rule
    {
        return new NoPokemonRule();
    }
}

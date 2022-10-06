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
    /**
     * @test
     */
    public function rootException(): void
    {
        $this->analyse(
            [__DIR__ . '/../Fixtures/catching-root-exception.php'],
            [
                ['You should not catch the root level \Exception class', 5],
            ]
        );
    }

    /**
     * @test
     */
    public function rootThrowable(): void
    {
        $this->analyse(
            [__DIR__ . '/../Fixtures/catching-root-throwable.php'],
            [
                ['You should not catch the root level \Throwable class', 5],
            ]
        );
    }

    /**
     * @test
     */
    public function otherException(): void
    {
        $this->analyse(
            [__DIR__ . '/../Fixtures/catching-other-exception.php'],
            []
        );
    }

    protected function getRule(): Rule
    {
        return new NoPokemonRule();
    }
}

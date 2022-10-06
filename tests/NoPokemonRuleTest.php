<?php


use PHPUnit\Framework\TestCase;
use REBELinBLUE\PHPStanRules\NoPokemonRule;

final class NoPokemonRuleTest extends \PHPStan\Testing\RuleTestCase
{
    public function testRootException(): void
    {
        $this->analyse(
            [__DIR__ . '/Fixtures/catching-root-exception.php'],
            [
                ['You should not catch \Exception', 5],
            ]
        );
    }

    public function testRootThrowable(): void
    {
        $this->analyse(
            [__DIR__ . '/Fixtures/catching-root-throwable.php'],
            [
                ['You should not catch \Throwable', 5],
            ]
        );
    }

    public function testOtherException(): void
    {
        $this->analyse(
            [__DIR__ . '/Fixtures/catching-other-exception.php'],
            []
        );
    }

    protected function getRule(): \PHPStan\Rules\Rule
    {
        return new NoPokemonRule();
    }
}

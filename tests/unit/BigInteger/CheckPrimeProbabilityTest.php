<?php
/**
 * phpmath / biginteger (https://github.com/phpmath/biginteger)
 *
 * @link https://github.com/phpmath/biginteger for the canonical source repository
 */

declare(strict_types=1);

namespace PHPMath\BigInteger\Tests\BigInteger;

use PHPMath\BigInteger\BigInteger;
use PHPMath\BigInteger\ProbablePrime;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;

#[CoversMethod(BigInteger::class, 'checkPrimeProbability')]
final class CheckPrimeProbabilityTest extends TestCase
{
    public function testReturnsYesForSmallPrime(): void
    {
        // Arrange
        $n = new BigInteger('2');

        // Act
        $result = $n->checkPrimeProbability();

        // Assert
        static::assertSame(ProbablePrime::Yes, $result);
    }

    public function testReturnsMaybeForLargeProbablePrime(): void
    {
        // Arrange
        // A large known probable prime (Miller-Rabin test does not guarantee 100%)
        $n = new BigInteger('170141183460469231731687303715884105727');

        // Act
        $result = $n->checkPrimeProbability();

        // Assert
        static::assertContains($result, [ProbablePrime::Yes, ProbablePrime::Maybe]);
    }

    public function testReturnsNoForCompositeNumber(): void
    {
        // Arrange
        $n = new BigInteger('15'); // 3 * 5

        // Act
        $result = $n->checkPrimeProbability();

        // Assert
        static::assertSame(ProbablePrime::No, $result);
    }

    public function testReturnsNoForNegativeNumber(): void
    {
        // Arrange
        $n = new BigInteger('-7');

        // Act
        $result = $n->checkPrimeProbability();

        // Assert
        static::assertSame(ProbablePrime::No, $result);
    }

    public function testReturnsNoForZeroAndOne(): void
    {
        // Arrange
        $zero = new BigInteger('0');
        $one  = new BigInteger('1');

        // Act & Assert
        static::assertSame(ProbablePrime::No, $zero->checkPrimeProbability());
        static::assertSame(ProbablePrime::No, $one->checkPrimeProbability());
    }
}

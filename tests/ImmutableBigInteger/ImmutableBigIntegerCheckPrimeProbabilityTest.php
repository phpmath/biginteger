<?php
/**
 * phpmath / biginteger (https://github.com/phpmath/biginteger)
 *
 * @link https://github.com/phpmath/biginteger for the canonical source repository
 */

declare(strict_types=1);

namespace PHP\Math\BigInteger\Tests\ImmutableBigInteger;

use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;
use PHP\Math\BigInteger\ImmutableBigInteger;
use PHP\Math\BigInteger\ProbablePrime;

#[CoversMethod(ImmutableBigInteger::class, 'checkPrimeProbability')]
final class ImmutableBigIntegerCheckPrimeProbabilityTest extends TestCase
{
    public function testReturnsYesForSmallPrime(): void
    {
        // Arrange
        $n = new ImmutableBigInteger('2');

        // Act
        $result = $n->checkPrimeProbability();

        // Assert
        static::assertSame(ProbablePrime::Yes, $result);
    }

    public function testReturnsMaybeForLargeProbablePrime(): void
    {
        // Arrange
        // A large known probable prime (Miller-Rabin test does not guarantee 100%)
        $n = new ImmutableBigInteger('170141183460469231731687303715884105727');

        // Act
        $result = $n->checkPrimeProbability();

        // Assert
        static::assertContains($result, [ ProbablePrime::Yes, ProbablePrime::Maybe ]);
    }

    public function testReturnsNoForCompositeNumber(): void
    {
        // Arrange
        $n = new ImmutableBigInteger('15'); // 3 * 5

        // Act
        $result = $n->checkPrimeProbability();

        // Assert
        static::assertSame(ProbablePrime::No, $result);
    }

    public function testReturnsNoForNegativeNumber(): void
    {
        // Arrange
        $n = new ImmutableBigInteger('-7');

        // Act
        $result = $n->checkPrimeProbability();

        // Assert
        static::assertSame(ProbablePrime::No, $result);
    }

    public function testReturnsNoForZeroAndOne(): void
    {
        // Arrange
        $zero = new ImmutableBigInteger('0');
        $one  = new ImmutableBigInteger('1');

        // Act & Assert
        static::assertSame(ProbablePrime::No, $zero->checkPrimeProbability());
        static::assertSame(ProbablePrime::No, $one->checkPrimeProbability());
    }
}


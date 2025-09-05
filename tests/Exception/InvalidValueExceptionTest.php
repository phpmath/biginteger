<?php
/**
 * phpmath / biginteger (https://github.com/phpmath/biginteger)
 *
 * @link https://github.com/phpmath/biginteger for the canonical source repository
 */

declare(strict_types=1);

namespace PHP\Math\BigInteger\Tests\Exception;

use PHP\Math\BigInteger\Exception\InvalidValueException;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\TestCase;
use stdClass;

use function fclose;
use function fopen;

#[CoversMethod(InvalidValueException::class, 'fromValue')]
final class InvalidValueExceptionTest extends TestCase
{
    public function testFromValueWithInteger(): void
    {
        // Arrange
        $value = 42;

        // Act
        $exception = InvalidValueException::fromValue($value);

        // Assert
        static::assertInstanceOf(InvalidValueException::class, $exception);
        static::assertStringContainsString('42', $exception->getMessage());
    }

    public function testFromValueWithString(): void
    {
        $value = 'foo';

        $exception = InvalidValueException::fromValue($value);

        static::assertInstanceOf(InvalidValueException::class, $exception);
        static::assertStringContainsString('foo', $exception->getMessage());
    }

    public function testFromValueWithObject(): void
    {
        $value = new stdClass();

        $exception = InvalidValueException::fromValue($value);

        static::assertInstanceOf(InvalidValueException::class, $exception);
        static::assertStringContainsString(stdClass::class, $exception->getMessage());
    }

    public function testFromValueWithArray(): void
    {
        $value = [1, 2, 3];

        $exception = InvalidValueException::fromValue($value);

        static::assertInstanceOf(InvalidValueException::class, $exception);
        static::assertStringContainsString('array', $exception->getMessage());
    }

    public function testFromValueWithResource(): void
    {
        $resource = fopen('php://memory', 'r');

        $exception = InvalidValueException::fromValue($resource);

        static::assertInstanceOf(InvalidValueException::class, $exception);
        static::assertStringContainsString('resource', $exception->getMessage());

        fclose($resource);
    }

    public function testExceptionCanBeThrownAndCaught(): void
    {
        // Arrange
        $value = 'invalid';

        // Assert
        $this->expectException(InvalidValueException::class);

        // Act
        throw InvalidValueException::fromValue($value);
    }
}

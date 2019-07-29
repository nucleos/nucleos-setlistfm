<?php

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Core23\SetlistFm\Tests\Exception;

use Core23\SetlistFm\Exception\ApiException;
use PHPUnit\Framework\TestCase;

final class ApiExceptionTest extends TestCase
{
    public function testToString(): void
    {
        $exception = new ApiException('My error', 304);

        static::assertSame('304: My error', $exception->__toString());
    }
}
<?php

declare(strict_types=1);

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nucleos\SetlistFm\Tests\Model;

use Nucleos\SetlistFm\Model\User;
use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase
{
    public function testFromApi(): void
    {
        $data = <<<'EOD'
                    {
                      "userId": "Metal-42",
                      "fullname": "Max",
                      "about": "Some dummy text",
                      "website": "http://example.com",
                      "url": "https://www.setlist.fm/user/Metal-42"
                    }
EOD;

        $user = User::fromApi(json_decode($data, true));
        self::assertSame('Metal-42', $user->getId());
        self::assertSame('Some dummy text', $user->getAbout());
        self::assertSame('Max', $user->getFullname());
        self::assertSame('http://example.com', $user->getWebsite());
        self::assertSame('https://www.setlist.fm/user/Metal-42', $user->getUrl());
    }
}

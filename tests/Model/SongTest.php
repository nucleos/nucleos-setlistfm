<?php

declare(strict_types=1);

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nucleos\SetlistFm\Tests\Model;

use Nucleos\SetlistFm\Model\Song;
use PHPUnit\Framework\TestCase;

final class SongTest extends TestCase
{
    public function testFromApi(): void
    {
        $data = <<<'EOD'
                    {
                        "name" : "Roll Over Beethoven",
                        "info": "This is a song",
                        "tape": 1,
                        "cover" : {
                           "mbid" : "592a3b6d-c42b-4567-99c9-ecf63bd66499",
                           "tmid" : 734540,
                           "name" : "Chuck Berry",
                           "sortName" : "Berry, Chuck",
                           "disambiguation" : "",
                           "url" : "https://www.setlist.fm/setlists/chuck-berry-63d6a2b7.html"
                        },
                        "with" : {
                           "mbid" : "b10bbbfc-cf9e-42e0-be17-e2c3e1d2600d",
                           "tmid" : 735610,
                           "name" : "The Beatles",
                           "sortName" : "Beatles, The",
                           "disambiguation" : "",
                           "url" : "https://www.setlist.fm/setlists/the-beatles-23d6a88b.html"
                       }
                    }
EOD;

        $song = Song::fromApi(json_decode($data, true));
        self::assertSame('Roll Over Beethoven', $song->getName());
        self::assertSame('This is a song', $song->getInfo());
        self::assertNotNull($song->getCover());
        self::assertCount(1, $song->getFeaturings());
        self::assertTrue($song->isTaped());
    }
}

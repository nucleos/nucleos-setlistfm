<?php

declare(strict_types=1);

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nucleos\SetlistFm\Tests\Model;

use Nucleos\SetlistFm\Model\City;
use PHPUnit\Framework\TestCase;

final class CityTest extends TestCase
{
    public function testFromApi(): void
    {
        $data = <<<'EOD'
                    {
                      "id" : "5357527",
                      "name" : "Hollywood",
                      "stateCode" : "CA",
                      "state" : "California",
                      "coords" : {
                        "long" : -118.3267434,
                        "lat" : 34.0983425
                      },
                      "country" : {
                        "code" : "US",
                        "name" : "United States"
                      }
                    }
EOD;

        $city = City::fromApi(json_decode($data, true));
        self::assertSame(5357527, $city->getId());
        self::assertSame('Hollywood', $city->getName());
        self::assertSame('California', $city->getState());
        self::assertNotNull($city->getCountry());
        self::assertNotNull($city->getGeo());
        self::assertSame('CA', $city->getStateCode());
    }
}

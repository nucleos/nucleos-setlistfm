<?php

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Core23\SetlistFm\Tests\Bridge\Symfony\DependencyInjection;

use Core23\SetlistFm\Bridge\Symfony\DependencyInjection\Configuration;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\Definition\Processor;

final class ConfigurationTest extends TestCase
{
    public function testDefaultOptions()
    {
        $processor = new Processor();

        $config = $processor->processConfiguration(new Configuration(), array(array(
            'api' => array(
                'key' => '0815',
            ),
        )));

        $expected = array(
            'api' => array(
                'key'      => '0815',
                'endpoint' => 'https://api.setlist.fm/rest/1.0/',
            ),
            'http' => array(
                'client'          => 'httplug.client.default',
                'message_factory' => 'httplug.message_factory.default',
            ),
        );

        $this->assertSame($expected, $config);
    }
}

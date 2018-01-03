<?php
/**
 * DummyTest
 *
 * PHP version 7+
 *
 * Copyright (c) 2017 Federico Lozada Mosto <mosto.federico@gmail.com>
 * For the full copyright and license information, please view the LICENSE file that was distributed with this source code.
 *
 * @category  Resty/Logger/Tests
 * @package   Resty/Logger/Tests
 * @author    Federico Lozada Mosto <mosto.federico@gmail.com>
 * @copyright 2017 Federico Lozada Mosto <mosto.federico@gmail.com>
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link      http://www.mostofreddy.com.ar
 */
namespace Resty\Logger\Tests\Handler;

// PHPUnit
use PHPUnit\Framework\TestCase;
// Logger
use Resty\Logger\Handler\AbstractHandler;
use Resty\Logger\LogLevel;

/**
 * DummyTest
 *
 * @category  Resty/Logger/Tests
 * @package   Resty/Logger/Tests
 * @author    Federico Lozada Mosto <mosto.federico@gmail.com>
 * @copyright 2017 Federico Lozada Mosto <mosto.federico@gmail.com>
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link      http://www.mostofreddy.com.ar
 */
class AbstractHandlerTest extends TestCase
{
    /**
     * Test levelWeight attribute
     * 
     * @return void
     */
    public function testLevelWeight()
    {
        $expected = [
            'emergency' => 1,
            'alert' => 2,
            'critical' => 4,
            'error' => 8,
            'warning' => 16,
            'notice' => 32,
            'info' => 64,
            'debug' => 128
        ];
        $stub = $this->getMockForAbstractClass(AbstractHandler::class);

        $this->assertAttributeEquals($expected, 'levelWeight', $stub);
    }

    /**
     * Test setUid method
     * 
     * @return void
     */
    public function testSetUid()
    {
        $expected = 'uid_'.rand();

        $stub = $this->getMockForAbstractClass(AbstractHandler::class);
        $stub->setUid($expected);

        $this->assertAttributeEquals($expected, 'uid', $stub);
    }

    /**
     * Test setChannel method
     * 
     * @return void
     */
    public function testSetChannel()
    {
        $expected = 'channel_'.rand();

        $stub = $this->getMockForAbstractClass(AbstractHandler::class);
        $stub->setChannel($expected);

        $this->assertAttributeEquals($expected, 'channel', $stub);
    }

    /**
     * Test setLogLevel method
     * 
     * @return void
     */
    public function testSetLogLevel()
    {
        $expected = 2;

        $stub = $this->getMockForAbstractClass(AbstractHandler::class);
        $stub->setLogLevel(LogLevel::ALERT);

        $this->assertAttributeEquals($expected, 'levelEnabled', $stub);
    }

    /**
     * Test setLogLevel method
     *
     * @expectedException        \Exception
     * @expectedExceptionMessage Invalid log level
     * 
     * @return void
     */
    public function testSetLogLevelInvalid()
    {
        $stub = $this->getMockForAbstractClass(AbstractHandler::class);
        $stub->setLogLevel('asdasdasd');
    }

    /**
     * Test config method
     * 
     * @return void
     */
    public function testconfig()
    {
        $data = [
            'channel' => 'channel_'.rand(),
            'logLevel' => LogLevel::ALERT,
            'uid' => 'uid_'.rand()
        ];
        $expected = [
            'channel' => $data['channel'],
            'levelEnabled' => 2,
            'uid' => $data['uid'],
        ];

        $stub = $this->getMockForAbstractClass(AbstractHandler::class);
        $stub->config($data);

        foreach ($expected as $expectedKey => $expectedValue) {
            $this->assertAttributeEquals(
                $expectedValue,
                $expectedKey,
                $stub
            );
        }
    }
}

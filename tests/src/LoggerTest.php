<?php
/**
 * LoggerTest
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
namespace Resty\Logger\Tests;

// PHPUnit
use PHPUnit\Framework\TestCase;
// Logger
use Resty\Logger\Logger;
use Resty\Logger\LogLevel;
use Resty\Logger\Handler\Dummy;

/**
 * LoggerTest
 *
 * @category  Resty/Logger/Tests
 * @package   Resty/Logger/Tests
 * @author    Federico Lozada Mosto <mosto.federico@gmail.com>
 * @copyright 2017 Federico Lozada Mosto <mosto.federico@gmail.com>
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link      http://www.mostofreddy.com.ar
 */
class LoggerTest extends TestCase
{
    /**
     * Test generateUid method
     * 
     * @return void
     */
    public function testGenerateUid()
    {
        $logger = new Logger();
        $ref = new \ReflectionMethod($logger, 'generateUid');
        $ref->setAccessible(true);
        $uid = $ref->invoke($logger);
        $this->assertEquals(32, strlen($uid));
    }

    /**
     * Test append method
     * 
     * @return void
     */
    public function testAppendHandler()
    {
        $expected = [new Dummy()];
        $logger = new Logger();
        $logger->append($expected[0]);

        $this->assertAttributeEquals($expected, 'handlers', $logger);
    }

    /**
     * Test log method
     * 
     * @return void
     */
    public function testLog()
    {
        $expected = [new Dummy()];
        $logger = new Logger();
        $logger->append($expected[0]);

        $this->assertTrue(
            $logger->log(LogLevel::ALERT, 'Logger', [])
        );
    }
}

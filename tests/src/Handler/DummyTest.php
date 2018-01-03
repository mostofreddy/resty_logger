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
use Resty\Logger\Handler\Dummy;

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
class DummyTest extends TestCase
{
    /**
     * Test write method
     * 
     * @return void
     */
    public function testWrite()
    {
        $handler = new Dummy();
        $ref = new \ReflectionMethod($handler, 'write');
        $ref->setAccessible(true);
        $result = $ref->invokeArgs($handler, ['mensaje']);
        $this->assertNull($result);
    }

    /**
     * Test __call method
     * 
     * @return void
     */
    public function testCall()
    {
        $handler = new Dummy();
        $result = $handler->setBla('bla');
        $this->assertTrue($result);
    }
}

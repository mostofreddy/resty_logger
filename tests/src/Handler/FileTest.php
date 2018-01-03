<?php
/**
 * FileTest
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
use Resty\Logger\Handler\File;

/**
 * FileTest
 *
 * @category  Resty/Logger/Tests
 * @package   Resty/Logger/Tests
 * @author    Federico Lozada Mosto <mosto.federico@gmail.com>
 * @copyright 2017 Federico Lozada Mosto <mosto.federico@gmail.com>
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link      http://www.mostofreddy.com.ar
 */
class FileTest extends TestCase
{
    /**
     * Test setOutput method
     *
     * @return void
     */
    public function testSetOutputWhenIsDir()
    {
        $output = rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR);
        $expected = $output.'/log_'.date('Ymd').'.log';

        $handler = new File();
        $handler->setOutput($output);

        $this->assertAttributeEquals($expected, 'fileOutput', $handler);
    }

    /**
     * Test setOutput method
     *
     * @return void
     */
    public function testSetOutputWhenIsFile()
    {
        $output = rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR)
            .DIRECTORY_SEPARATOR
            .'test.log';
        file_put_contents($output, 'test'.PHP_EOL);

        $expected = $output;
        $handler = new File();
        $handler->setOutput($output);

        unlink($output);

        $this->assertAttributeEquals($expected, 'fileOutput', $handler);
    }

    /**
     * Test setOutput method
     *
     * @expectedException        \Exception
     * @expectedExceptionMessage Can't write log in: /home
     *
     * @return void
     */
    public function testSetOutputWhenInvalidDir()
    {
        $output = '/home';

        $handler = new File();
        $handler->setOutput($output);
    }

    /**
     * Test setOutput method
     *
     * @expectedException        \Exception
     * @expectedExceptionMessage Invalid ouput: 
     *
     * @return void
     */
    public function testSetOutputWhenInvalidOutput()
    {
        $output = '';

        $handler = new File();
        $handler->setOutput($output);
    }

    /**
     * Test setOutput method
     *
     * @return void
     */
    public function testSetOutputWhenInvalidFile()
    {
        $output = rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR)
            .DIRECTORY_SEPARATOR
            .'test.log';
        file_put_contents($output, 'test'.PHP_EOL);

        chmod($output, 0555);

        try {
            $handler = new File();
            $handler->setOutput($output);
        } catch(\Exception $e) {
            $this->assertEquals(
                'Can\'t write log in: /tmp/test.log',
                $e->getMessage()
            );
        } finally {
            chmod($output, 0755);
            unlink($output);
        }
    }

    /**
     * Test write method
     *
     * @return void
     */
    public function testWrite()
    {
        $output = rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR);
        $filePath = $output.'/log_'.date('Ymd').'.log';

        $handler = new File();
        $handler->setOutput($output);

        $ref = new \ReflectionMethod($handler, 'write');
        $ref->setAccessible(true);

        $ref->invokeArgs($handler, ['my_message']);

        $data = file_get_contents($filePath);

        unlink($filePath);
        $this->assertEquals('my_message'.PHP_EOL, $data);
    }
}

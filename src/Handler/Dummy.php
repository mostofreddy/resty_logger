<?php
/**
 * Dummy
 *
 * PHP version 7+
 *
 * Copyright (c) 2017 Federico Lozada Mosto <mosto.federico@gmail.com>
 * For the full copyright and license information, please view the LICENSE file that was distributed with this source code.
 *
 * @category  Resty/Logger/Handler
 * @package   Resty/Logger/Handler
 * @author    Federico Lozada Mosto <mosto.federico@gmail.com>
 * @copyright 2017 Federico Lozada Mosto <mosto.federico@gmail.com>
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link      http://www.mostofreddy.com.ar
 */
namespace Resty\Logger\Handler;

use Resty\Logger\Handler\AbstractHandler;

/**
 * Dummy
 *
 * @category  Resty/Logger/Handler
 * @package   Resty/Logger/Handler
 * @author    Federico Lozada Mosto <mosto.federico@gmail.com>
 * @copyright 2017 Federico Lozada Mosto <mosto.federico@gmail.com>
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link      http://www.mostofreddy.com.ar
 */
class Dummy extends AbstractHandler
{
    /********************************************************************************
     * Write log
     *******************************************************************************/
    /**
     * Write log
     *
     * @param string $message Message
     *
     * @return void
     */
    protected function write(string $message):void
    {
    }

    /**
     * __call method
     * 
     * @param mixed $message message
     * @param mixed $params  params
     * 
     * @return bool
     */
    public function __call($message, $params)
    {
        return true;
    }
}

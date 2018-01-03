<?php
/**
 * HandlerInterface
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
 * HandlerInterface
 *
 * @category  Resty/Logger/Handler
 * @package   Resty/Logger/Handler
 * @author    Federico Lozada Mosto <mosto.federico@gmail.com>
 * @copyright 2017 Federico Lozada Mosto <mosto.federico@gmail.com>
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link      http://www.mostofreddy.com.ar
 */
interface HandlerInterface
{
    /**
     * Logs with an arbitrary level.
     *
     * @param mixed  $level   Level name
     * @param string $message Message
     * @param array  $context Context
     *
     * @return void
     */
    public function log($level, $message, array $context = array()):void;
    /**
     * Set multi config
     * 
     * @param array $config Configuration
     * 
     * @return AbstractHandler
     */
    public function config(array $config):AbstractHandler;
}

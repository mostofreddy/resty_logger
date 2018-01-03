<?php
/**
 * Logger
 *
 * PHP version 7+
 *
 * Copyright (c) 2017 Federico Lozada Mosto <mosto.federico@gmail.com>
 * For the full copyright and license information, please view the LICENSE file that was distributed with this source code.
 *
 * @category  Resty/Logger
 * @package   Resty/Logger
 * @author    Federico Lozada Mosto <mosto.federico@gmail.com>
 * @copyright 2017 Federico Lozada Mosto <mosto.federico@gmail.com>
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link      http://www.mostofreddy.com.ar
 */
namespace Resty\Logger;

// PSR
use Psr\Log\LoggerInterface;
use Psr\Log\AbstractLogger;
use Resty\Logger\Handler\AbstractHandler;

/**
 * Logger
 *
 * @category  Resty/Logger
 * @package   Resty/Logger
 * @author    Federico Lozada Mosto <mosto.federico@gmail.com>
 * @copyright 2017 Federico Lozada Mosto <mosto.federico@gmail.com>
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link      http://www.mostofreddy.com.ar
 */
class Logger extends AbstractLogger implements LoggerInterface
{
    protected $handlers = [];
    protected $uid = null;

    /**
     * Genera un identificador único para todos los logs de un request
     *
     * @return string
     */
    protected function generateUid():string
    {
        if ($this->uid === null) {
            $now = \DateTime::createFromFormat('U.u', microtime(true), new \DateTimeZone('UTC'));
            $this->uid = md5($now->format("Y-m-d\TH:i:s.uO"));
        }
        return $this->uid;
    }

    /**
     * Append handler
     * 
     * @param AbstractHandler $handler Handler instance
     * 
     * @return self
     */
    public function append(AbstractHandler $handler): self
    {
        $handler->setUid($this->generateUid());
        $this->handlers[] = $handler;
        return $this;
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed  $level   Level
     * @param string $message Mensage
     * @param array  $context Context
     *
     * @return void
     */
    public function log($level, $message, array $context = array())
    {
        foreach ($this->handlers as $handler) {
            $handler->log($level, $message, $context);
        }
        return true;
    }
}

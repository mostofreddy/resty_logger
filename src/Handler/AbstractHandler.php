<?php
/**
 * AbstractHandler
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

use Exception;
use DateTime;
use DateTimeZone;
use Resty\Logger\Handler\HandlerInterface;

/**
 * AbstractHandler
 *
 * @category  Resty/Logger/Handler
 * @package   Resty/Logger/Handler
 * @author    Federico Lozada Mosto <mosto.federico@gmail.com>
 * @copyright 2017 Federico Lozada Mosto <mosto.federico@gmail.com>
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link      http://www.mostofreddy.com.ar
 */
abstract class AbstractHandler implements HandlerInterface
{
    protected $levelEnabled = 128;
    protected $channel = null;
    protected $uid = null;

    protected $levelWeight = [
        'emergency' => 1,
        'alert' => 2,
        'critical' => 4,
        'error' => 8,
        'warning' => 16,
        'notice' => 32,
        'info' => 64,
        'debug' => 128
    ];

    /********************************************************************************
     * Config
     *******************************************************************************/
    /**
     * Set uid
     * 
     * @param string $uid UID
     *
     * @return self
     */
    public function setUid(string $uid):self
    {
        $this->uid = $uid;
        return $this;
    }

    /**
     * Set channel name
     * 
     * @param string $channel Channel name
     *
     * @return self
     */
    public function setChannel(string $channel):self
    {
        $this->channel = $channel;
        return $this;
    }
    /**
     * Set level
     * 
     * @param string $level Level name
     *
     * @return self
     */
    public function setLogLevel(string $level):self
    {
        if (!isset($this->levelWeight[$level])) {
            throw new Exception("Invalid log level");
        }

        $this->levelEnabled = $this->levelWeight[$level];

        return $this;
    }

    /**
     * Set multi config
     * 
     * @param array $config Configuration
     * 
     * @return AbstractHandler
     */
    public function config(array $config):AbstractHandler
    {
        foreach ($config as $key=>$value) {
            $method = 'set'.ucwords($key);
            $this->$method($value);
        }
        return $this;
    }

    /********************************************************************************
     * Write log
     *******************************************************************************/

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed  $level   Level name
     * @param string $message Message
     * @param array  $context Context
     *
     * @return void
     */
    public function log($level, $message, array $context = array()):void
    {
        if ($this->isLoggeable($level)) {
            $this->write(
                $this->renderMessage($level, $message, $context)
            );
        }
    }

    /**
     * Check if message can be save
     * 
     * @param string $level Level name
     * 
     * @return boolean
     */
    protected function isLoggeable(string $level):bool
    {
        return ($this->levelWeight[$level] <= $this->levelEnabled);
    }

    
    /**
     * Write log
     *
     * @param string $message Message
     *
     * @return void
     */
    abstract protected function write(string $message):void;

    /********************************************************************************
     * Date 
     *******************************************************************************/

    /**
     * Devuelve el timezone
     * 
     * @return \DateTimeZone
     */
    protected static function timezone():DateTimeZone
    {
        static $timezone = null;
        if ($timezone == null) {
            $timezone = new DateTimeZone('UTC');
        }
        return $timezone;
    }

    /**
     * Return new instance of DateTime
     * 
     * @return \DateTime
     */
    protected function getDateTime():DateTime
    {
        $dateTime = new DateTime();
        $dateTime->setTimezone(static::timezone());
        return $dateTime;
    }

    /********************************************************************************
     * Render message
     *******************************************************************************/

    /**
     * Render menssage
     * 
     * @param string $level   Log name
     * @param string $message Message
     * @param array  $context Context
     * 
     * @return string
     */
    protected function renderMessage($level, $message, array $context = array()):string
    {

        return $this->getDateTime()->format('[c]')
            .' '.$level
            .(($this->uid)?' '.$this->uid:'')
            .(($this->channel)?' @'.$this->channel:'')
            .' - '
            .$message
            .' - '
            .json_encode($context);
    }
}

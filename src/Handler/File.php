<?php
/**
 * File
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
 * File
 *
 * @category  Resty/Logger/Handler
 * @package   Resty/Logger/Handler
 * @author    Federico Lozada Mosto <mosto.federico@gmail.com>
 * @copyright 2017 Federico Lozada Mosto <mosto.federico@gmail.com>
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link      http://www.mostofreddy.com.ar
 */
class File extends AbstractHandler
{
    protected $fileOutput;

    /**
     * Set output path
     * 
     * @param string $output Output path
     *
     * @return self
     */
    public function setOutput(string $output):self
    {
        $this->validateOutput($output);

        $this->fileOutput = $this->renderOutputPath($output);
        return $this;
    }

    /**
     * Generate output path
     * 
     * @param string $output Output
     * 
     * @return string
     */
    protected function renderOutputPath(string $output):string
    {
        return is_file($output)?$output:rtrim($output, '/').'/log_'.date('Ymd').'.log';
    }

    /**
     * Validate output
     * 
     * @param string $output Output
     * 
     * @return void
     */
    protected function validateOutput(string $output)
    {
        if (!is_file($output) && !is_dir($output)) {
            throw new \Exception("Invalid ouput: ".$output);
        }

        if (!is_writable($output)) {
            throw new \Exception('Can\'t write log in: '.$output);
        }
    }

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
        error_log($message.PHP_EOL, 3, $this->fileOutput);
    }
}

<?php

/**
 * Cola - MVC
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	Cola
 * @author	Emre Can ÖZTAŞ <emrecanoztas@outlook.com>
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://github.com/emrecanoztas/cola-mvc
 * @version	0.0.1
 */

namespace Cola\System {

    use Cola\Config\Config as Config;

    class Error
    {

        private function __construct()
        {

        }

        public static function setError($errorType = null, $description = null)
        {
            if (file_exists(Config::$core['errors'] . Config::$error . '.php')) {
                include (Config::$core['errors'] . Config::$error . '.php');
            } else {
                trigger_error('Error page is not found!');
            }
        }

        // $messageType = 256, 512 and 1024
        public static function basicError($message = null, $messageType = 512)
        {
            if (!is_null($message) && !is_bool($message)) {
                if (!is_null($messageType)) {
                    trigger_error($message, $messageType);
                } else {
                    trigger_error($message);
                }
            } else {
                trigger_error('Error!');
            }

        }

        public static function logError($errorType = null, $description = null, $timeAndDate = null)
        {

        }

        public static function stopSystem($message = null)
        {
            if (!is_null($message) && !is_bool($message)) {
                exit($message);
            } else {
                exit();
            }
        }

    }

}

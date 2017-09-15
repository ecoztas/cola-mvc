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
    use Cola\Config\Load as Load;
    use Cola\System\Error as Error;

    class Autoloader
    {

        private function __construct()
        {

        }

        public static function init()
        {
            if (file_exists(Config::$core['system'] . Config::$controller . '.php')) {
                include (Config::$core['system'] . Config::$controller . '.php');

                if (file_exists(Config::$core['system'] . Config::$model . '.php')) {
                    include (Config::$core['system'] . Config::$model . '.php');

                    self::loadLibraries();
                    self::loadHelpers();
                } else {
                    Error::setError(Config::$errorTypes['model'], 'Core-Model class is not found!');
                    Error::stopSystem();
                }
            } else {
                Error::setError(Config::$errorTypes['controller'], 'Core-Controller class is not found!');
                Error::stopSystem();
            }
        }

        public static function loadLibraries()
        {
            if (!is_null(Load::$libraries) && !is_bool(Load::$libraries)) {
                foreach (Load::$libraries as $library) {
                    if (file_exists(Config::$core['libraries'] . $library . '.php')) {
                        include (Config::$core['libraries'] . $library . '.php');
                    } else {
                        Error::setError(Config::$errorTypes['library'], 'Please check Core-Library name!');
                        Error::stopSystem();
                    }
                }
            }
        }

        public static function loadHelpers()
        {
            if (!is_null(Load::$helpers) && !is_bool(Load::$helpers)) {
                foreach (Load::$helpers as $helper) {
                    if (file_exists(Config::$core['helpers'] . $helper . '.php')) {
                        include (Config::$core['helpers'] . $helper . '.php');
                    } else {
                        Error::setError(Config::$errorTypes['helper'], 'Please check Core-Helper name!');
                        Error::stopSystem();
                    }
                }
            }
        }
    }
}

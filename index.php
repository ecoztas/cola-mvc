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

include ('core/config/Config.php');
include ('core/config/Load.php');
include ('core/config/UAData.php');
include ('core/config/FileTypes.php');
include ('core/system/Autolader.php');
include ('core/system/Error.php');
include ('core/config/PHPini.php');

use Cola\Config\Config as Config;
use Cola\System\Autoloader as Autolader;
use Cola\System\Error as Error;

Autolader::init();

$instance 	= null;
$className 	= null;
$methodName = null;

if (isset($_GET['url'])) {
    $url = explode('/', rtrim($_GET['url']));

    $className = $url[0];
    array_shift($url);

    if (file_exists(Config::$app['controllers'] . $className . '.php')) {
        include (Config::$app['controllers'] . $className . '.php');

        if (class_exists($className)) {
            $instance = new $className;

            if (isset($url[0])) {
                if (method_exists($instance, $url[0])) {
                    $methodName = $url[0];
                    array_shift($url);

                    if (isset($url[0])) {
                        call_user_func_array([$instance, $methodName], $url);
                    } else {
                        $instance->{$methodName}();
                    }
                } else {
                    Error::setError(Config::$errorTypes['method'], 'Please check your method name!');
                    Error::stopSystem();
                }
            } else {
                $instance->{Config::$default['method']}();
            }
        } else {
            Error::setError(Config::$errorTypes['class'], 'Please check your class name!');
            Error::stopSystem();
        }
    } else {
        Error::setError(Config::$errorTypes['page'], 'Please check your file name!');
        Error::stopSystem();
    }
} else {
    if (file_exists(Config::$app['controllers'] . Config::$default['controller'] . '.php')) {
        include (Config::$app['controllers'] . Config::$default['controller'] . '.php');

        $className = Config::$default['controller'];

        if (class_exists($className)) {
            $instance = new $className;

            if (method_exists($instance, Config::$default['method'])) {
                $instance->{Config::$default['method']}();
            } else {
                Error::setError(Config::$errorTypes['method'], 'Please create index method!');
                Error::stopSystem();
            }
        } else {
            Error::setError(Config::$errorTypes['class'], 'Please create Main Class!');
            Error::stopSystem();
        }
    } else {
        Error::setError(Config::$errorTypes['page'], 'Please create Main file!');
        Error::stopSystem();
    }

}
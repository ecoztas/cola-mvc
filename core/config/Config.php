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
 * @package Cola
 * @author  Emre Can ÖZTAŞ <emrecanoztas@outlook.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 * @link    https://github.com/emrecanoztas/cola-mvc
 * @version 0.0.1
 */

namespace Cola\Config {

    class Config
    {
        // Name of system core files
        public static $controller = 'Controller';
        public static $model      = 'Model';
        public static $error      = 'Error';
        public static $load       = 'Load';

        // Core paths
        public static $core = array(
            'errors'   => 'core/errors/',
            'helpers'  => 'core/helpers/',
            'libraries'=> 'core/libraries/',
            'system'   => 'core/system/',
            'load'     => 'core/config'
        );

        // App paths
        public static $app = array(
            'controllers'=> 'app/controllers/',
            'views'      => 'app/views/',
            'helpers'    => 'app/helpers/',
            'libraries'  => 'app/libraries/',
            'models'     => 'app/models/'
        );

        // Default settings
        public static $default = array(
            'path'      => 'http://127.0.0.1/cola-mvc/',
            'controller'=> 'Main',
            'method'    => 'index',
        );

        // Database settings
        public static $database = array(
            'host'    => 'localhost',
            'user'    => 'root',
            'password'=> '',
            'database'=> 'test',
            'encoding'=> 'utf8'
        );

        // Error types
        public static $errorTypes = array(
            'page'      => 'Page Not Found!',
            'class'     => 'Class Not Found!',
            'method'    => 'Method Not Found!',
            'controller'=> 'Controller Not Found!',
            'model'     => 'Model Not Found!',
            'library'   => 'Library Not Found!',
            'helper'    => 'Helper Not Found!',
            'view'      => 'View Not Found!',
            'database'  => 'Database Connection Failed!',
            'cExtends'  => 'This Class Not Extend Super Class!'
        );

        // Cookie values
        public static $cookie = array(
            'name'    => 'test',
            'value'   => 'empty',
            'expire'  => null,
            'path'    => '/',
            'domain'  => null,
            'secure'  => false,
            'httponly'=> false
        );

        // Upload file values
        public static $upload = array(
            'maxFileSize'      => 5120000,
            'allowedFileTypes' => null,
            'fileName'         => null,
            'originalFileName' => false,
            'path'             => 'upload/',
            'override'         => true
        );

        private function __construct()
        {

        }

    }

}
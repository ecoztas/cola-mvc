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

namespace Cola\Libraries {

    use Cola\Config\Config as Config;
    use Cola\System\Error as Error;

    class Cookie
    {
        private $_cookie;

        public function __construct()
        {
			$this->_cookie = null;
        }

        public function defaultCookie()
        {
            $this->_cookie = setcookie(Config::$cookie['name'], Config::$cookie['value'],
                Config::$cookie['expire'], Config::$cookie['path'], Config::$cookie['domain'],
                Config::$cookie['secure'], Config::$cookie['httponly']);

            if ($this->_cookie) {
                return ($this->_cookie);
            } else {
                Error::basicError('Please check your cookie values in config file!', 512);
            }
        }

        public function cookie($name = null, $value = null, $expire = null, $path = null,
            $domain = null, $secure = null, $httponly = null)
        {
            if (!is_null($name) && !is_bool($name)) {
                if (!is_null($value) && !is_bool($value)) {
                    $this->_cookie = setcookie($name, $value, $expire, $path, $domain, $secure, $httponly);

                    if ($this->_cookie) {
                        return ($this->_cookie);
                    } else {
                        Error::basicError('Please check your cookie values!', 512);
                    }

                } else {
                    return (null);
                }
            } else {
                return (null);
            }
        }

        public function getCookie($name = null)
        {
            if (!is_null($name) && !is_bool($name)) {
                if (isset($_COOKIE[$name])) {
                    $this->_cookie = $_COOKIE[$name];

                    return ($this->_cookie);
                } else {
                    Error::basicError('Please check name of your cookie!', 512);
                }
            } else {
                return (null);
            }
        }

        public function deleteCookie($name = null, $value = null, $expire = null, $path = null)
        {
            if (!is_null($name) && !is_bool($name)) {
                if (!is_null($value) && !is_bool($value)) {
                    if (is_null($expire)) {
                        $expire = time() - 2592000;
                        if (is_null($path)) {
                            $path = '/';
                            $this->_cookie = setcookie($name, $value, $expire, $path);

                            return ($this->_cookie);
                        } else {
                            $this->_cookie = setcookie($name, $value, $expire, $path);

                            return ($this->_cookie);
                        }
                    } else {
                        if (is_null($path)) {
                            $path = '/';
                            $this->_cookie = setcookie($name, $value, $expire, $path);

                            return ($this->_cookie);
                        } else {
                            $this->_cookie = setcookie($name, $value, $expire, $path);

                            return ($this->_cookie);
                        }
                    }
                } else {
                    return (null);
                }
            } else {
                return (null);
            }
        }

    }

}
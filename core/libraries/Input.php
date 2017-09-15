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

    class Input
    {
        private $_input;

        public function __construct()
        {
            $this->_input = null;
        }

        public function get($data = null)
        {
            if (!is_null($data) && !is_bool($data)) {
                if (isset($_GET[$data])) {
                    $this->_input = $_GET[$data];

                    return ($this->_input);
                } else {
                    Error::basicError('GET::Data Not Found!', 512);
                }
            } else {
                return (null);
            }
        }

        public function post($data = null)
        {
            if (!is_null($data) && !is_bool($data)) {
                if (isset($_POST[$data])) {
                    $this->_input = $_POST[$data];

                    return ($this->_input);
                } else {
                    Error::basicError('POST::Data Not Found!', 512);
                }
            } else {
                return (null);
            }
        }

        public function getPost($data = null)
        {
            if (!is_null($data) && !is_bool($data)) {
                if (isset($_GET[$data])) {
                    $this->_input = $_GET[$data];

                    return ($this->_input);
                } else
                if (isset($_POST[$data])) {
                    $this->_input = $_POST[$data];

                    return ($this->_input);
                } else {
                    Error::basicError('GET-POST::Data Not Found!', 512);
                }
            } else {
                return (null);
            }
        }

        public function postGet($data = null)
        {
            if (!is_null($data) && is_bool($data)) {
                if (isset($_POST[$data])) {
                    $this->_input = $_POST[$data];

                    return ($this->_input);
                } else
                if (isset($_GET[$data])) {
                    $this->_input = $_GET[$data];

                    return ($data);
                } else {
                    Error::basicError('POST-GET::Data Not Found!', 512);
                }
            } else {
                return (null);
            }
        }

        public function method()
        {
            if (isset($_SERVER['REQUEST_METHOD'])) {
                $this->_input = $_SERVER['REQUEST_METHOD'];
                return ($this->_input);
            } else {
                Error::basicError('SERVER::REQUEST_METHOD Not Found!', 512);
            }
        }

        public function ip()
        {
            if (isset($_SERVER['REMOTE_ADDR'])) {
                $this->_input = $_SERVER['REMOTE_ADDR'];

                return ($this->_input);
            } else {
                Error::basicError('SERVER::REMOTE_ADDR Not Found!', 512);
            }
        }

        public function server($data = null)
        {
            if (!is_null($data) && !is_bool($data)) {
                if (isset($_SERVER[$data])) {
                    $this->_input = $_SERVER[$data];

                    return ($this->_input);
                } else {
                    Error::basicError('SERVER::Data Not Found!', 512);
                }
            } else {
                return (null);
            }
        }

    }

}

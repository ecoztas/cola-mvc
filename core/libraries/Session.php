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

    use Cola\System\Error as Error;

    class Session
    {
        private $_session;

        public function __construct()
        {
            if (!isset($_SESSION)) {
                session_start();
            }

            $this->_session = null;
        }

        public function reStartSession()
        {
            if (!isset($_SESSION)) {
                session_start();
            }
        }

        public function setData($name = null, $data = null)
        {
            if (!is_null($name) && !is_bool($name)) {
                if (!is_null($data) && !is_bool($data)) {
                    if (isset($_SESSION)) {
                        $this->_session = $_SESSION[$name] = $data;

                        return ($this->_session);
                    } else {
                        Error::basicError('Please start session!', 256);
                    }
                }
            } else {
                return (null);
            }
        }

        public function getData($name = null)
        {
            if (!is_null($name) && !is_bool($name)) {
                if (isset($name)) {
                    if (isset($_SESSION)) {
                        $this->_session = $_SESSION[$name];

                        return ($this->_session);
                    } else {
                        Error::basicError('Please start session!', 1024);
                    }
                } else {
                    Error::basicError('SESSION::Data Not Found!', 512);
                }
            } else {
                return (null);
            }
        }

        public function getId()
        {
            if (isset($_SESSION)) {
                $this->_session = session_id();

                return ($this->_session);
            } else {
                Error::basicError('Please start session!', 1024);
            }
        }

        public function removeData($name = null)
        {
            if (!is_null($name) && !is_bool($name)) {
                if (isset($_SESSION)) {
                    if (isset($_SESSION[$name])) {
                        $this->_session = unset($_SESSION[$name]);

                        return ($this->_session);
                    } else {
                        Error::basicError('SESSION::Data Not Found!', 256);
                    }
                } else {
                    Error::basicError('Please start session!', 1024);
                }
            } else {
                return (null);
            }
        }

        public function removeAllData()
        {
            if (isset($_SESSION)) {
                $_SESSION = array();
            } else {
                Error::basicError('Please start session!', 1024);
            }
        }

        public function destroy()
        {
            if (isset($_SESSION)) {
                session_destroy();
            } else {
                Error::basicError('Please start session!', 1024);
            }
        }

    }

}

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
    use Cola\Config\UAData as UAData;

    class UserAgent
    {
        private $_userAgent;

        public function __construct()
        {

        }

        public function getUserAgent()
        {
            if (isset($_SERVER['HTTP_USER_AGENT'])) {
                $this->_userAgent = $_SERVER['HTTP_USER_AGENT'];

                return ($this->_userAgent);
            } else {
                Error::basicError('User Agent Not Found!', 256);
            }
        }

        public function getPlatform()
        {
            $ua = $this->getUserAgent();

            if (isset(UAData::$platforms)) {
                if (is_array(UAData::$platforms)) {
                    foreach (UAData::$platforms as $data => $value) {
                        if (strpos(strtolower($ua), $data)) {
                            $this->_userAgent = $value;

                            break;
                        } else {
                            $this->_userAgent = null;
                        }
                    }

                    return ($this->_userAgent);
                } else {
                    Error::basicError('UDATA::Platforms Not Well Format!', 256);
                }
            } else {
                Error::basicError('UAData::Platforms Not Found!', 256);
            }
        }

        public function getBrowser()
        {
            $ua = $this->getUserAgent();

            if (isset(UAData::$browsers)) {
                if (is_array(UAData::$browsers)) {
                    foreach (UAData::$browsers as $data => $value) {
                        if (strpos($ua, $data)) {

                            $this->_userAgent = $value;
                            break;
                        } else {
                            $this->_userAgent = null;
                        }
                    }

                    return ($this->_userAgent);
                } else {
                    Error::basicError('UDATA::Browsers Not Well Format!', 256);
                }
            } else {
                Error::basicError('UAData::Browsers Not Found!', 256);
            }
        }

        public function isMobile($mobileName = null)
        {
            $ua = $this->getUserAgent();

            if (is_null($mobileName)) {
                if (isset(UAData::$mobiles)) {
                    if (is_array(UAData::$mobiles)) {
                        foreach (UAData::$mobiles as $data => $value) {
                            if (strpos($ua, $data)) {
                                $this->_userAgent = $value;

                                break;
                            } else {
                                $this->_userAgent = null;
                            }
                        }
                    } else {
                        Error::basicError('UDATA::Mobiles Not Well Format!', 256);
                    }
                } else {
                    Error::basicError('UAData::Mobiles Not Found!', 256);
                }
            } else {
                if (!is_null($mobileName) && !is_bool($mobileName)) {
                    if (strpos($ua, $mobileName)) {
                        $this->_userAgent = $mobileName;

                        return ($this->_userAgent);
                    } else {
                        return (null);
                    }
                }
            }

        }

        public function isRobot()
        {
            $ua = $this->getUserAgent();

            if (isset(UAData::$robots)) {
                if (is_array(UAData::$robots)) {
                    foreach (UAData::$robots as $data => $value) {
                        if (strpos($ua, $data)) {

                            $this->_userAgent = $value;
                            break;
                        } else {
                            $this->_userAgent = null;
                        }
                    }

                    return ($this->_userAgent);
                } else {
                    Error::basicError('UDATA::Robots Not Well Format!', 256);
                }
            } else {
                Error::basicError('UAData::Robots Not Found!', 256);
            }
        }

    }

}
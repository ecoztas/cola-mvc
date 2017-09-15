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

    class Validate
    {
        private $_validate;

        public function __construct()
        {
            $this->_validate = null;
        }

        public function filterByBoolean($data = null)
        {
            if (!is_null($data)) {
                $this->_validate = filter_var($data, FILTER_VALIDATE_BOOLEAN);

                return ($this->_validate);
            } else {
                return (null);
            }
        }

        public function filterByEMail($data = null)
        {
            if (!is_null($data) && !is_bool($data)) {
                $this->_validate = filter_var($data, FILTER_VALIDATE_EMAIL);

                return ($this->_validate);
            } else {
                return (null);
            }
        }

        public function filterByFloat($data = null)
        {
            if (!is_null($data) && !is_bool($data)) {
                $this->_validate = filter_var($data, FILTER_VALIDATE_FLOAT);

                return ($this->_validate);
            } else {
                return (null);
            }
        }

        public function filterByInteger($data = null)
        {
            if (!is_null($data) && !is_bool($data)) {
                $this->_validate = filter_var($data, FILTER_VALIDATE_INT);

                return ($this->_validate);
            } else {
                return (null);
            }
        }
        // FILTER_FLAG_IPV4 or FILTER_FLAG_IPV6
        public function filterByIp($data = null, $ipType = 'FILTER_FLAG_IPV4')
        {
            if (!is_null($data) && !is_bool($data)) {
                if (is_null($ipType)) {
                    $this->_validate = filter_var($data, FILTER_VALIDATE_IP);
                } else {
                    $this->_validate = filter_var($data, FILTER_VALIDATE_IP, $ipType);
                }

                return ($this->_validate);
            } else {
                return (null);
            }
        }

        public function filterByRegex($data = null)
        {
            if (!is_null($data) && !is_bool($data)) {
                $this->_validate = filter_var($data, FILTER_VALIDATE_REGEXP);

                return ($this->_validate);
            } else {
                return (null);
            }
        }

        public function filterByUrl($data = null)
        {
            if (!is_null($data) && !is_bool($data)) {
                $this->_validate = filter_var($data, FILTER_VALIDATE_URL);

                return ($this->_validate);
            } else {
                return (null);
            }
        }

    }

}

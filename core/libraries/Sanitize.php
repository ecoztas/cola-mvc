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

    class Sanitize
    {
        private $_sanitize;

        public function __construct()
        {
            $this->_sanitize = null;
        }

        public function sanitizeByEMail($data = null)
        {
            if (!is_null($data) && !is_bool($data)) {
                $this->_sanitize = filter_var($data, FILTER_SANITIZE_EMAIL);

                return ($this->_sanitize);
            } else {
                return (null);
            }
        }

        public function sanitizeByEncoded($data = null)
        {
            if (!is_null($data) && !is_bool($data)) {
                $this->_sanitize = filter_var($data, FILTER_SANITIZE_ENCODED);

                return ($this->_sanitize);
            } else {
                return (null);
            }
        }

        public function sanitizeByMagicQuotes($data = null)
        {
            if (!is_null($data) && !is_bool($data)) {
                $this->_sanitize = filter_var($data, FILTER_SANITIZE_MAGIC_QUOTES);

                return ($this->_sanitize);
            } else {
                return (null);
            }
        }

        public function sanitizeByFloat($data = null)
        {
            if (!is_null($data) && !is_bool($data)) {
                $this->_sanitize = filter_var($data, FILTER_SANITIZE_NUMBER_FLOAT);

                return ($this->_sanitize);
            } else {
                return (null);
            }
        }

        public function sanitizeByInteger($data = null)
        {
            if (!is_null($data) && !is_bool($data)) {
                $this->_sanitize = filter_var($data, FILTER_SANITIZE_NUMBER_INT);

                return ($this->_sanitize);
            } else {
                return (null);
            }
        }

        public function sanitizeBySpecialChars($data = null)
        {
            if (!is_null($data) && !is_bool($data)) {
                $this->_sanitize = filter_var($data, FILTER_SANITIZE_SPECIAL_CHARS);

                return ($this->_sanitize);
            } else {
                return (null);
            }
        }

        public function sanitizeByString($data = null)
        {
            if (!is_null($data) && !is_bool($data)) {
                $this->_sanitize = filter_var($data, FILTER_SANITIZE_STRING);

                return ($this->_sanitize);
            } else {
                return (null);
            }
        }

        public function sanitizeByUrl($data = null)
        {
            if (!is_null($data) && !is_bool($data)) {
                $this->_sanitize = filter_var($data, FILTER_SANITIZE_URL);

                return ($this->_sanitize);
            } else {
                return (null);
            }
        }

        public function sanitizeByUnsafeRaw($data = null)
        {
            if (!is_null($data) && !is_bool($data)) {
                $this->_sanitize = filter_var($data, FILTER_UNSAFE_RAW);

                return ($this->_sanitize);
            } else {
                return (null);
            }
        }

    }

}

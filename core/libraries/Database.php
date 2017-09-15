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

    class Database
    {
        private $_link;
        private $_query;
        private $_result;

        public function __construct()
        {
            $this->_link = @mysqli_connect(Config::$database['host'], Config::$database['user'],
                Config::$database['password'], Config::$database['database']);

            if (!$this->_link) {
                Error::setError(Config::$errorTypes['database'], 'Please check database parameters');
                Error::stopSystem();
            } else {
                mysqli_set_charset($this->_link, Config::$database['encoding']);

                $this->_query = null;
                $this->_result = null;
            }
        }

        public function reConnect()
        {
            $this->_link = @mysqli_connect(Config::$database['host'], Config::$database['user'],
                Config::$database['password'], Config::$database['database']);

            if (!$this->_link) {
                Error::setError(Config::$errorTypes['database'], 'Please check database parameters');
                Error::stopSystem();
            } else {
                mysqli_set_charset($this->_link, Config::$database['encoding']);
            }
        }

        public function closeConnection()
        {
            if ($this->_link) {
                $this->_result = mysqli_close($this->_link);

                return ($this->_result);
            } else {
                Error::setError(Config::$errorTypes['database'], 'Please check database parameters');
                Error::stopSystem();
            }
        }

        public function escapeString($data = null)
        {
            if ($this->_link) {
                if (!is_null($data) && !is_bool($data)) {
                    $data = mysqli_real_escape_string($this->_link, $data);

                    return ($data);
                } else {
                    return (null);
                }
            } else {
                Error::setError(Config::$errorTypes['database'], 'Please check database parameters');
                Error::stopSystem();
            }
        }

        public function activeRecord($query = null)
        {
            if ($this->_link) {
                if (!is_null($query) && !is_bool($query)) {
                    $this->_result = mysqli_query($this->_link, $query);

                    if ($this->_result) {
                        return ($this->_result);
                    } else {
                        return (null);
                    }
                }
            } else {
                Error::setError(Config::$errorTypes['database'], 'Please check database parameters');
                Error::stopSystem();
            }
        }

        public function selected($columns = null, $tableName = null)
        {
            if ($this->_link) {
                if (!is_null($tableName) && !is_bool($tableName)) {
                    if (is_null($columns)) {
                        $this->_query = "SELECT * FROM " . $tableName;
                        $this->_result = mysqli_query($this->_link, $this->_query);

                        if ($this->_result) {
                            return ($this->_result);
                        } else {
                            return (null);
                        }
                    } else {
                        $this->_query = "SELECT " . $columns . " FROM " . $tableName;
                        $this->_result = mysqli_query($this->_link, $this->_query);

                        if ($this->_result) {
                            return ($this->_result);
                        } else {
                            return (null);
                        }
                    }
                }
            } else {
                Error::setError(Config::$errorTypes['database'], 'Please check database parameters');
                Error::stopSystem();
            }
        }

        public function selectedAll($tableName = null)
        {
            if ($this->_link) {
                if (!is_null($tableName) && !is_bool($tableName)) {
                    $this->_query = "SELECT * FROM " . $tableName;
                    $this->_result = mysqli_query($this->_link, $this->_query);

                    if ($this->_result) {
                        return ($this->_result);
                    } else {
                        return (null);
                    }
                }
            } else {
                Error::setError(Config::$errorTypes['database'], 'Please check database parameters');
                Error::stopSystem();
            }
        }

        public function inserted($tableName = null, $tableColumns = null, $insertedColumns = null)
        {
            if ($this->_link) {
                if (!is_null($tableName) && !is_bool($tableName)) {
                    if (!is_null($tableColumns) && !is_bool($tableColumns)) {
                        if (!is_null($insertedColumns) && !is_bool($insertedColumns)) {
                            $this->_query = "INSERT INTO " . $tableName . "(" . $tableColumns . ")" .
                            " VALUES " . "(" . $insertedColumns . ")";
                            $this->_result = mysqli_query($this->_link, $this->_query);

                            if ($this->_result) {
                                return ($this->_result);
                            } else {
                                return (null);
                            }
                        } else {
                            return (null);
                        }
                    } else {
                        return (null);
                    }
                } else {
                    return (null);
                }
            } else {
                Error::setError(Config::$errorTypes['database'], 'Please check database parameters');
                Error::stopSystem();
            }
        }

        public function where($tableName = null, $tableColumns = null, $whereIn = null)
        {
            if ($this->_link) {
                if (!is_null($tableName) && !is_bool($tableName)) {
                    if (!is_null($whereIn) && !is_bool($whereIn)) {
                        if (is_null($tableColumns)) {
                            $this->_query = "SELECT * FROM " . $tableName . " WHERE " . $whereIn;
                            $this->_result = mysqli_query($this->_link, $this->_query);

                            if ($this->_result) {
                                return ($this->_result);
                            } else {
                                return (null);
                            }
                        } else {
                            $this->_query = "SELECT " . $tableColumns . " FROM " . $tableName . " WHERE " .
                            $whereIn;
                            $this->_result = mysqli_query($this->_link, $this->_query);

                            if ($this->_result) {
                                return ($this->_result);
                            } else {
                                return (null);
                            }
                        }
                    } else {
                        return (null);
                    }
                } else {
                    return (null);
                }
            } else {
                Error::setError(Config::$errorTypes['database'], 'Please check database parameters');
                Error::stopSystem();
            }
        }

        public function whereAll($tableName = null, $whereIn = null)
        {
            if ($this->_link) {
                if (!is_null($tableName) && !is_bool($tableName)) {
                    if (!is_null($whereIn) && !is_bool($whereIn)) {
                        $this->_query = "SELECT * FROM " . $tableName . " WHERE " . $whereIn;
                        $this->_result = mysqli_query($this->_link, $this->_query);

                        if ($this->_result) {
                            return ($this->_result);
                        } else {
                            return (null);
                        }

                    } else {
                        return (null);
                    }
                } else {
                    return (null);
                }
            } else {
                Error::setError(Config::$errorTypes['database'], 'Please check database parameters');
                Error::stopSystem();
            }
        }

        public function updated($tableName = null, $setIn = null, $whereIn = null)
        {
            if ($this->_link) {
                if (!is_null($tableName) && !is_bool($tableName)) {
                    if (!is_null($setIn) && !is_bool($setIn)) {
                        if (!is_null($whereIn) && !is_bool($whereIn)) {
                            $this->_query = "UPDATE " . $tableName . " SET " . $setIn . " WHERE " . $whereIn;
                            $this->_result = mysqli_query($this->_link, $this->_query);

                            if ($this->_result) {
                                return ($this->_result);
                            } else {
                                return (null);
                            }
                        } else {
                            return (null);
                        }
                    } else {
                        return (null);
                    }
                } else {
                    return (null);
                }
            } else {
                Error::setError(Config::$errorTypes['database'], 'Please check database parameters');
                Error::stopSystem();
            }
        }

        public function deleted($tableName = null, $whereIn = null)
        {
            if ($this->_link) {
                if (!is_null($tableName) && !is_bool($tableName)) {
                    if (!is_null($whereIn) && !is_bool($whereIn)) {
                        $this->_query = "DELETE FROM " . $tableName . " WHERE " . $whereIn;
                        $this->_result = mysqli_query($this->_link, $this->_query);

                        if ($this->_result) {
                            return ($this->_result);
                        } else {
                            return (null);
                        }
                    } else {
                        return (null);
                    }
                } else {
                    return (null);
                }
            } else {
                Error::setError(Config::$errorTypes['database'], 'Please check database parameters');
                Error::stopSystem();
            }
        }

    }

}

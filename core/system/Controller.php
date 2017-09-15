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
    use Cola\System\Error as Error;

    class Controller
    {
        public $controller;

        public function __construct()
        {
            $this->controller = null;
        }

        public function loadView($viewNames = null, $data = null)
        {
            if (!is_null($viewNames) && !is_bool($viewNames)) {
                if (is_array($viewNames)) {

                    foreach ($viewNames as $view) {
                        $getFileNames = $this->getFullFileName(Config::$app['views'], $view);

                        if (is_array($getFileNames)) {
                            foreach ($getFileNames as $fileName) {
                                if (file_exists(Config::$app['views'] . $fileName)) {
                                    include (Config::$app['views'] . $fileName);
                                } else {
                                    Error::setError(Config::$errorTypes['view'], 'Please check your view names!');
                                }
                            }
                        } else {
                            if (!is_null($getFileNames)) {
                                if (file_exists(Config::$app['views'] . $getFileNames)) {
                                    include (Config::$app['views'] . $getFileNames);
                                } else {
                                    Error::setError(Config::$errorTypes['view'], 'Please check your view names!');
                                }
                            } else {
                                Error::setError(Config::$errorTypes['view'], 'Please check your view names!');
                            }
                        }
                    }
                } else {
                    $getFileNames = $this->getFullFileName(Config::$app['views'], $viewNames);

                    if (is_array($getFileNames)) {
                        foreach ($getFileNames as $fileName) {
                            if (file_exists(Config::$app['views'] . $fileName)) {
                                include (Config::$app['views'] . $fileName);
                            } else {
                                Error::setError(Config::$errorTypes['view'], 'Please check your view names!');
                            }
                        }
                    } else {
                        if (!is_null($getFileNames)) {
                            if (file_exists(Config::$app['views'] . $getFileNames)) {
                                include (Config::$app['views'] . $getFileNames);
                            } else {
                                Error::setError(Config::$errorTypes['view'], 'Please check your view names!');
                            }
                        } else {
                            Error::setError(Config::$errorTypes['view'], 'Please check your view names!');
                        }
                    }
                }
            }
        }

        public function loadLibrary($libraryNames = null)
        {
            if (!is_null($libraryNames) && !is_bool($libraryNames)) {
                if (is_array($libraryNames)) {
                    foreach ($libraryNames as $library) {
                        if (file_exists(Config::$core['libraries'] . $library . '.php')) {
                            include (Config::$core['libraries'] . $library . '.php');
                        } elseif (file_exists(Config::$app['libraries'] . $library . '.php')) {
                            include (Config::$app['libraries'] . $library . '.php');
                        } else {
                            Error::setError(Config::$errorTypes['library'], 'Please check library name!');
                            Error::stopSystem();
                        }
                    }
                } else {
                    if (file_exists(Config::$core['libraries'] . $libraryNames . '.php')) {
                        include (Config::$core['libraries'] . $libraryNames . '.php');
                    } elseif (file_exists(Config::$app['libraries'] . $libraryNames . '.php')) {
                        include (Config::$app['libraries'] . $libraryNames . '.php');
                    } else {
                        Error::setError(Config::$errorTypes['library'], 'Please check library name!');
                        Error::stopSystem();
                    }
                }
            }
        }

        public function loadHelper($helperNames = null)
        {
            if (!is_null($helperNames) && !is_bool($helperNames)) {
                if (is_array($helperNames)) {
                    foreach ($helperNames as $helper) {
                        if (file_exists(Config::$core['helpers'] . $helper . '.php')) {
                            include (Config::$core['helpers'] . $helper . '.php');
                        } else
                        if (file_exists(Config::$app['helpers'] . $helper . '.php')) {
                            include (Config::$app['helpers'] . $helper . '.php');
                        } else {
                            Error::setError(Config::$errorTypes['helper'], 'Please check helper name!');
                            Error::stopSystem();
                        }
                    }
                } else {
                    if (file_exists(Config::$core['helpers'] . $helperNames . '.php')) {
                        include (Config::$core['helpers'] . $helperNames . '.php');
                    } else
                    if (file_exists(Config::$app['helpers'] . $helperNames . '.php')) {
                        include (Config::$app['helpers'] . $helperNames . '.php');
                    } else {
                        Error::setError(Config::$errorTypes['helper'], 'Please check helper name!');
                        Error::stopSystem();
                    }
                }
            }
        }

        public function loadModel($modelNames = null)
        {
            if (!is_null($modelNames) && !is_bool($modelNames)) {
                if (is_array($modelNames)) {
                    foreach ($modelNames as $model) {
                        if (file_exists(Config::$app['models'] . $model . '.php')) {
                            include (Config::$app['models'] . $model . '.php');
                        } else {
                            Error::setError(Config::$errorTypes['model'], 'Please check model name!');
                            Error::stopSystem();
                        }
                    }
                } else {
                    if (file_exists(Config::$app['models'] . $modelNames . '.php')) {
                        include (Config::$app['models'] . $modelNames . '.php');
                    } else {
                        Error::setError(Config::$errorTypes['model'], 'Please check model name!');
                        Error::stopSystem();
                    }
                }
            }
        }

        public function loadController($controllerNames = null)
        {
            if (!is_null($controllerNames) && !is_bool($controllerNames)) {
                if (is_array($controllerNames)) {
                    foreach ($controllerNames as $controller) {
                        if (file_exists(Config::$app['controllers'] . $controller . '.php')) {
                            include (Config::$app['controllers'] . $controller . '.php');
                        } else {
                            Error::setError(Config::$errorTypes['controller'],
                                'Please check controller name!');
                            Error::stopSystem();
                        }
                    }
                } else {
                    if (file_exists(Config::$app['controllers'] . $controllerNames . '.php')) {
                        include (Config::$app['controllers'] . $controllerNames . '.php');
                    } else {
                        Error::setError(Config::$errorTypes['controller'],
                            'Please check controller name!');
                        Error::stopSystem();
                    }
                }
            }
        }

        private function getFullFileName($inTheFolder = null, $fileName = null)
        {
            if (!is_null($inTheFolder) && !is_bool($inTheFolder)) {
                if (!is_null($fileName) && !is_bool($fileName)) {
                    $fileList     = glob($inTheFolder . $fileName . '.*');

                    $fullFileName = array();

                    if (count($fileList) > 1) {
                        foreach ($fileList as $file) {
                            $fullFileName[] = $fileName . '.' . pathinfo($file, PATHINFO_EXTENSION);
                        }

                        return ($fullFileName);
                    } else
                    if (count($fileList) === 1) {
                        return ($fileName . '.' . pathinfo($fileList[0], PATHINFO_EXTENSION));
                    } else {
                        return (null);
                    }
                }
            }
        }

    }

}

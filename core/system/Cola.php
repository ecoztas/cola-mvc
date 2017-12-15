<?php

class Cola
{
    private static $_url;
    private static $_page;
    private static $_class;
    private static $_instance;
    private static $_method;
    private static $_parameters;
    private static $_unmethod;
    private static $_librarires;
    private static $_helpers;
    private static $_plugins;

    private function __construct()
    {

    }

    // startup cola-mvc
    public static function run()
    {
        if (file_exists(APP_PATH . 'config' . DIRECTORY_SEPERATOR . 'config.php')) {
            include(APP_PATH . 'config' . DIRECTORY_SEPERATOR . 'config.php');

            self::$_librarires = $autoload['libraries'];
            self::$_helpers    = $autoload['helpers'];
            self::$_plugins    = $autoload['plugins'];

            self::base();
			
			self::autoload(self::$_librarires, self::$_helpers, self::$_plugins);

            if (isset($_GET['url'])) {
                self::$_url = explode(DIRECTORY_SEPERATOR, rtrim($_GET['url'], DIRECTORY_SEPERATOR));

                self::$_page = strip_tags(ucfirst(self::$_url[0]));
                array_shift(self::$_url);

                if (file_exists(APP_PATH . 'controllers' . DIRECTORY_SEPERATOR . self::$_page . '.php')) {
                    include(APP_PATH . 'controllers' . DIRECTORY_SEPERATOR . self::$_page . '.php');

                    self::$_class = self::$_page;

                    if (class_exists(self::$_class)) {
                        self::$_instance = new self::$_class;

                        if (is_subclass_of(self::$_instance, 'Controller')) {
                            if (isset(self::$_url[0])) {
                                self::$_method = self::$_url[0];
                                array_shift(self::$_url);

                                if (isset(self::$_url[0])) {
                                    self::$_parameters = self::$_url;

                                    if (method_exists(self::$_instance, self::$_method)) {
                                        call_user_func_array([self::$_instance, self::$_method], self::$_parameters);
                                    } else {
                                        self::$_unmethod = $default['unmethod'];
                                        
                                        if (method_exists(self::$_instance, self::$_unmethod)) {
                                            self::$_instance->{self::$_unmethod}();   
                                        } else {
                                            self::error('Method not found!', self::$_method . ' is not found!', 1024);
                                        }
                                    }
                                } else { 
                                    if (method_exists(self::$_instance, self::$_method)) {
                                        self::$_instance->{self::$_method}();
                                    } else {
                                        self::$_unmethod = $default['unmethod'];
                                        
                                        if (method_exists(self::$_instance, self::$_unmethod)) {
                                            self::$_instance->{self::$_unmethod}();   
                                        } else {
                                            self::error('Method not found!', self::$_method . ' method is not found!', 1024);
                                        }
                                    }
                                }
                            } else {
                                self::$_method   = $default['method'];
                                self::$_unmethod = $default['unmethod'];

                                if (method_exists(self::$_instance, self::$_method)) {
                                    self::$_instance->{self::$_method}();
                                } else {
                                    if (method_exists(self::$_instance, self::$_unmethod)) {
                                        self::$_instance->{self::$_unmethod}();   
                                    } else {
                                        self::error('Method not found!', self::$_method . ' method is not found!', 1024);
                                    }
                                }
                            }
                        } else {
                            self::error('Controller Not extend!', self::$_class . ' class did not extend Controller class!', 1024);
                        }                    
                    } else {
                        self::error('Class not found!', self::$_class . ' class is not found!', 1024);
                    }
                } else {
                    self::error('Page not found!', self::$_page . ' page is not found!', 1024);
                }
            } else {
                self::$_page = $default['page'];

                if (file_exists(APP_PATH . 'controllers' . DIRECTORY_SEPERATOR . self::$_page . '.php')) {
                    include(APP_PATH . 'controllers' . DIRECTORY_SEPERATOR . $default['page'] . '.php');

                    self::$_class = self::$_page;
                    
                    if (class_exists(self::$_class)) {
                        self::$_instance = new self::$_class;

                        if (is_subclass_of(self::$_instance, 'Controller')) {

                            self::$_method   = $default['method'];
                            self::$_unmethod = $default['unmethod'];

                            if (method_exists(self::$_instance, self::$_method)) {
                                self::$_instance->{self::$_method}();
                            } else {
                                if (method_exists(self::$_instance, self::$_unmethod)) {
                                    self::$_instance->{self::$_unmethod}();   
                                } else {
                                    self::error('Method not found!', self::$_method . ' method is not found!', 1024);
                                }
                            }                        
                        } else {
                            self::error('Controller Not extend!', self::$_class . ' class did not extend Controller class!', 1024);
                        }
                    } else {
                        self::error('Class not found!', self::$_class . ' class is not found!', 1024);
                    }
                } else {
                    self::error('Page not found!', self::$_page . ' page is not found!', 1024);
                }
            }
        } else {
            self::error('Config Error!', 'config file is not found!', 1024);
        }
    }

    // load controller and model classess
    public static function base()
    {
        if (file_exists(CORE_PATH . 'system' . DIRECTORY_SEPERATOR . 'Controller.php')) {
            include(CORE_PATH . 'system' . DIRECTORY_SEPERATOR . 'Controller.php');
			
            if (file_exists(CORE_PATH . 'system' . DIRECTORY_SEPERATOR . 'Model.php')) {
                include(CORE_PATH . 'system' . DIRECTORY_SEPERATOR . 'Model.php');
            } else {
                self::error('Model not found!', 'Core::Model class is not found!', 1024);
            }
        } else {
            self::error('Controller not found!', 'Core::Controller class is not found!', 1024);
        }
    }

    // autoload libraries, helpers and plugins
    public static function autoload($libraries, $helpers, $plugins)
    {	
        $loadLibraries = function() use($libraries) {
			if (!empty($libraries)) {
				foreach ($libraries as $library) {
					if (file_exists(APP_PATH . 'libraries' . DIRECTORY_SEPERATOR . $library . '.php')) {
						include(APP_PATH . 'libraries' . DIRECTORY_SEPERATOR . $library . '.php');
						$localInstance = $library::getInstance();
					} else if (file_exists(CORE_PATH . 'libraries' . DIRECTORY_SEPERATOR . $library . '.php')) {
						include(CORE_PATH . 'libraries' . DIRECTORY_SEPERATOR . $library . '.php');
					} else {
						self::error('Library not found!', $library . ' library is not found!', 1024);
					}
				}
			}
        };

        $loadHelpers = function() use($helpers) {
			if (!empty($helpers)) {
				foreach ($helpers as $helper) {
					if (file_exists(APP_PATH . 'helpers' . DIRECTORY_SEPERATOR . $helper . '.php')) {
						include(APP_PATH . 'helpers' . DIRECTORY_SEPERATOR . $helper . '.php');
					} else if (file_exists(CORE_PATH . 'helpers' . DIRECTORY_SEPERATOR . $helper . '.php')) {
						include(CORE_PATH . 'helpers' . DIRECTORY_SEPERATOR . $helper . '.php');
					} else {
						self::error('Helper not found!', $helper . ' helper is not found!', 1024);
					}
				}
			}
        };

        $loadPlugins = function() use($plugins) {
			if (!empty($plugins)) {
				foreach ($plugins as $plugin) {
					if (file_exists(APP_PATH . 'plugins' . DIRECTORY_SEPERATOR . $plugin . '.php')) {
						include(APP_PATH . 'plugins' . DIRECTORY_SEPERATOR . $plugin . '.php');
					} else {
						self::error('Plugin not found!', $plugin . ' plugin is not found!', 1024);
					}
				}
			}
        };
		
		$loadLibraries();
		$loadHelpers();
		$loadPlugins();
    }

    // error handling
    public static function error($title, $description, $type)
    {
        $errorType = '';
        $message   = '';

        // Error: Notice
        if ($type == 256) {
            $errorType = 'Notice';
            $message = '<br><strong>Error:</strong>' . '<br><strong>Type:</strong> ' . $errorType . ' | ' . '<strong>Title:</strong> ' . $title . ' | ' . '<strong>Description:</strong> ' . $description;
            echo($message);

        // Error: Warning
        } else if ($type == 512) {
            $errorType = 'Warning';
            $message = '<br><strong>Error:</strong>' . '<br><strong>Type:</strong> ' . $errorType . ' | ' . '<strong>Title:</strong> ' . $title . ' | ' . '<strong>Description:</strong> ' . $description;
            echo($message);

        // Error: Fatal
        } else if ($type == 1024) {
            $errorType = 'Fatal';
            $message = 'Error Type:<br>' . $errorType . '<br><br>Title:<br>' . $title . '<br><br>Description:<br>' . $description;
            include(ERROR_PATH);
            self::stop();
        // Error: Unknown
        } else {
            $errorType = 'Unknown';
            $message = '<br><strong>Error:</strong>' . '<br><strong>Type:</strong> ' . $errorType . ' | ' . '<strong>Title:</strong> ' . $title . ' | ' . '<strong>Description:</strong> ' . $description;
            echo($message);
        }
    }

    // stop the system
    public static function stop($message = null)
    {
        if (!empty($message)) {
            exit($message);
        } else {
            exit();
        }
    }

    // get mvc version
    public static function getVersion()
    {
        return(VERSION);
    }
}
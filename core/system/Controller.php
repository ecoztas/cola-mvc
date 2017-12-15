<?php

class Controller 
{
    public function __construct()
    {

    }

    public function loadControllers($controllerNames)
    {
        
    }

    public function loadViews($viewNames, $datas = null)
    {
        if (is_array($viewNames)) {
            foreach ($viewNames as $view) {
                $getFileNames = $this->getFullFileName(APP_PATH . 'views' . DIRECTORY_SEPERATOR, $view);

                if (is_array($getFileNames)) {
                    foreach ($getFileNames as $fileName) {
                        if (file_exists(APP_PATH . 'views' . DIRECTORY_SEPERATOR . $fileName)) {
                            include (APP_PATH . 'views' . DIRECTORY_SEPERATOR . $fileName);
                        } else {
                            Cola::error($view . ' view is not found!', 'Please check your view names!', 1024);
                        }
                    }
                } else {
                    if (!is_null($getFileNames)) {
                        if (file_exists(APP_PATH . 'views' . DIRECTORY_SEPERATOR . $getFileNames)) {
                            include (APP_PATH . 'views' . DIRECTORY_SEPERATOR . $getFileNames);
                        } else {
                            Cola::error($view . ' view is not found', 'Please check your view names!', 1024);
                        }
                    } else {
                        Cola::error($view. ' view is not found!', 'Please check your view names!', 1024);
                    }
                }
            }
        } else {
            $getFileNames = $this->getFullFileName(APP_PATH . 'views'. DIRECTORY_SEPERATOR, $viewNames);

            if (is_array($getFileNames)) {
                foreach ($getFileNames as $fileName) {
                    if (file_exists(APP_PATH . 'views' . DIRECTORY_SEPERATOR . $fileName)) {
                        include (APP_PATH . 'views' . DIRECTORY_SEPERATOR . $fileName);
                    } else {
                        Cola::error($view . ' view is not found', 'Please check your view names!', 1024);
                    }
                }
            } else {
                if (!is_null($getFileNames)) {
                    if (file_exists(APP_PATH . 'views' . DIRECTORY_SEPERATOR . $getFileNames)) {
                        include (APP_PATH . 'views' . DIRECTORY_SEPERATOR . $getFileNames);
                    } else {
                        Cola::error($viewNames . ' view is not found', 'Please check your view names!', 1024);
                    }
                } else {
                    Cola::error($viewNames . ' view is not found', 'Please check your view names!', 1024);
                }
            }
        }
    }

    public function loadModels($modelNames)
    {
        
    }

    public function loadLibraries($libraryNames)
    {
        
    }
    
    public function loadHelpers($helperNames)
    {
        
    }
    
    public function loadPlugins($pluginNames)
    {
        
    }

    public function loadErrors($errorPages, $data = null)
    {
        
    }

    private function getFullFileName($inTheFolder, $fileName)
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
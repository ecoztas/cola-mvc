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
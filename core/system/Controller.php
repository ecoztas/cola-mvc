<?php

class Controller 
{
    public $controller;

    public function __construct()
    {

    }

    public static function getInstance()
    {
        if (!$this->controller instanceof self) {
            $this->controller = new self;
        }

        return($this->controller);
    }

    public function loadControllers($controllerNames)
    {
        
    }

    public function loadViews($viewNames)
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
}
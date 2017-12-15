<?php

class Model
{

    public $model;

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
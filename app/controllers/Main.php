<?php

class Main extends Controller
{
    public $controller = null;

    function __construct()
    {
        $this->controller = new Controller();
    }

    public function main()
    {
        $this->controller->loadViews('main_view');
    }
    
    public function _lost()
    {
        echo('I\'m lost! :(');
    }
}
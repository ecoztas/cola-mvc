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
        echo('Hello Cola-MVC!');
    }
    
    public function _lost()
    {
        echo('I\'m lost!');
    }
}
<?php

class Main extends Controller
{
    function __construct()
    {

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
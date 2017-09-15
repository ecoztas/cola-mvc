<?php

use Cola\System\Controller as Controller;
use Cola\Libraries\UserAgent as UserAgent;

class Main extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->controller = new parent;
    }

    public function index()
    {
        $this->controller->loadView('Main_view');
    }

}

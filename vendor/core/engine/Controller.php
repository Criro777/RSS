<?php

namespace vendor\core\engine;


abstract class Controller
{
    protected $route = [];
    public $layout;


    public function __construct($route)
    {
        $this->route = $route;
    }

    public function render($view, $data=[])
    {
        $vObj = new View($this->route, $this->layout, $view);

        $vObj->renderView($data);
    }

}
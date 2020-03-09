<?php

class Controller
{
    protected function view($view, $data = [])
    {
        $ArrayKeys = array_keys($data);
        foreach ($ArrayKeys as $ark) {
            ${$ark} = $data[$ark];
        }
        require_once 'app/view/' . $view . '.php';
    }

    protected function model($model)
    {
        require_once 'app/model/' . $model . '.php';
        return new $model;
    }
}

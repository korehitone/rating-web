<?php

class Controller {
    public function view($view, $data = []){
        require_once $_SERVER['DOCUMENT_ROOT'].'/app/views/'.$view.'.php';
    }

     public function model($model){
        require_once $_SERVER['DOCUMENT_ROOT'].'/app/core/Model.php';
        require_once $_SERVER['DOCUMENT_ROOT'].'/app/models/'.$model.'.php';
        return new $model;
    }
}
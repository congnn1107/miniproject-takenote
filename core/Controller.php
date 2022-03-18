<?php

class Controller
{

    protected $model;
    public function __construct()
    {
        //xử lý remember login qua cookies tại đây
        //check cookie có remember_token thì lấy ra user theo remember_token và gán user vào session
        // var_dump($_COOKIE);
        if(!empty($_COOKIE['token']) && empty($_SESSION['user'])){
            $this->loadModel('User');
            $user = $this->model->searchByToken($_COOKIE['token']);
            if($user){
                $_SESSION['user'] =  $user;
            }
        }
        // var_dump($_SESSION['user']);
        // die();
        

    }
    public function loadModel($model_name)
    {
        $model_path = APP_PATH . '\/model/' . $model_name . '.php';
        if (file_exists($model_path)) {
            require_once $model_path;
            $this->model =  new $model_name;
        }
    }
    public function loadView($view, $params = [])
    {
        $view_path = APP_PATH . '\/view/' . $view . '.php';
        if (file_exists($view_path)) {
            if (!empty($params)) {
                extract($params);
            }
            include_once $view_path;
        }
    }
}

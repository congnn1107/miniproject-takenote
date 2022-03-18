<?php

require_once CORE_PATH . '/Controller.php';

class HomeController extends Controller
{

    public function index()
    {
        //check để redirect không cho quay lại login
        if (isset($_SESSION['user'])) {
            header('location: index.php?controller=NoteController&action=index');
        }
        $this->loadView('home/index');
        unset($_SESSION['errors']);
    }

    public function login()
    {
        var_dump($_POST);
        // die();
        //check để redirect không cho quay lại login
        if (isset($_SESSION['user'])) {
            header('location: index.php?controller=NoteController&action=index');
        }
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            header('location: index.php');
        }
        $this->loadModel('User');
        $user = $this->model->getInfo($_POST['email'], $_POST['password']);
        if ($user) {
            //thêm user vào session
            $_SESSION['user'] = $user;
            //xử lý remember
            $token = "";
            if(!empty($_POST['remember'])){
                $expire= time() + 3600*24*30;
                $token = md5($user->email);
                setcookie('token',$token,$expire);
            }
            $this->model->setToken($token);
            //redirect
            header('location: index.php?controller=NoteController&action=index');
        } else {
            //set lỗi vào session
            $_SESSION['errors']['login'] = "Thông tin đăng nhập chưa chính xác!";
            //redirect
            header('location: index.php');
        }
    }
    public function register()
    {
        //check để redirect không cho quay lại register
        if (isset($_SESSION['user'])) {
            header('location: index.php?controller=NoteController&action=index');
        }
        $this->loadView('home/register');
        // var_dump($_SESSION['errors']);
        // var_dump($_SESSION['old']);
        unset($_SESSION['errors']);
        unset($_SESSION['old']);
    }
    public function logout()
    {
        $this->loadModel('User');
        $this->model->setToken("");
        setcookie("token","", time()-3600);
        session_destroy();
        //todo
        //xử lý remember

        header('location: index.php');
    }
    public function error()
    {
        echo __METHOD__;
    }
}

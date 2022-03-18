<?php
require_once CORE_PATH . '/Controller.php';
class UserController extends Controller
{

    public function store()
    {
        
        // echo __METHOD__;
        //kiểm tra phương thức request hoặc đã đăng nhập thì không đăng ký
        if ($_SERVER['REQUEST_METHOD']  != "POST" || empty($_POST) || !empty($_SESSION['user'])) {
            header("location: index.php");
        }

        $this->loadModel('User');


        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $retype_password = $_POST['retype_password'];
        $hasInvalid = false;
        //lưu trữ dữ liệu cũ
        $old = [
            'name' => $name,
            'email' => $email,
            'password' => $password
        ];
        // validate name
        if (trim($name) == "") {
            $errors['name'] = 'Tên không được để trống';
            $hasInvalid = true;
        } else if (strlen($name) < 5 || strlen($name) > 50) {
            $errors['name'] = 'Độ dài tên không hợp lệ!';
            $hasInvalid = true;
        } else if (preg_match('/[0-9]/', $name)) {
            $errors['name'] = "Nội dung tên không được chứa số!";
            $hasInvalid = true;
        } else {
        }
        //validate email

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Nội dung email không hợp lệ!";
            $hasInvalid = true;
        } else if ($this->model->matchEmail($email)) {
            // check trùng mail
            $errors['email'] = 'Email này đã có người sử dụng!';
            $hasInvalid = true;
        } else {
        }
        //validate password
        // var_dump(strlen($password));
        if (trim($password) == "") {
            $errors['password'] = 'Mật khẩu không được bỏ trống!';
            $hasInvalid = true;
        } else if (strlen($password) < 6) {
            $errors['password'] = 'Độ dài mật khẩu không hợp lệ, tối thiểu 6 ký tự!';
            $hasInvalid = true;
        } else if (strpos($password, ' ')) {
            $errors['password'] = 'Mật khẩu không được chứa khoảng trắng!';
            $hasInvalid = true;
        } else if ($password != $retype_password) {
            $errors['password'] = 'Xác nhận mật khẩu không khớp!';
            $hasInvalid = true;
        } else {
        }
        //end validate

        if ($hasInvalid) {
            $_SESSION['old'] = $old;
            $_SESSION['errors'] = $errors;
            header('location: index.php?controller=HomeController&action=register');
            die();
        }
        //mã hóa mật khẩu
        $encoded_password =  md5($password);
        //lưu vào db
        $result = $this->model->insert($name, $email, $encoded_password);
        if ($result) {
            //thêm thông tin user vào session
            $_SESSION['user'] = $this->model->getInfo($email, $password);
            //chuyển hướng trang note index
            header('location: index.php?controller=NoteController&action=index');
        } else {
        }
    }
}

<?php
require_once CORE_PATH . '/Controller.php';

class NoteController extends Controller
{

    public function __construct()
    {
        if (empty($_SESSION['user'])) {
            $_SESSION['errors']['login'] = "Bạn phải đăng nhập!";
            header('location: index.php');
        }
    }
    
    public function index()
    {
        $this->loadModel('Note');
        $notes = $this->model->selectAll();

        $this->loadView('note/index', ['notes' => $notes]);
        // var_dump($_SESSION['errors']);
        unset($_SESSION['errors']);
    }

    public function create()
    {
        echo __METHOD__;
        $this->loadView('note/create');
        var_dump($_SESSION['errors']);
        unset($_SESSION['errors']);
        unset($_SESSION['old']);
    }

    public function store()
    {
        echo __METHOD__;
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            header('location: index.php');
            die();
        }
        //validate độ dài title
        $title = $_POST['title'];
        $content = $_POST['content'];
        $hasInvalid =  false;
        $old = [
            'title' => $title,
            'content' => $content,
        ];
        if (strlen(trim($title)) > 50) {
            $errors['title'] = "Tiêu đề không được dài quá 50 ký tự!";
            $hasInvalid = true;
        }

        if ($hasInvalid) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = $old;
            header('location: index.php?controller=NoteController&action=create');
            die();
        }

        $this->loadModel('Note');

        $result = $this->model->insert(trim($title) == "" ? "untitled" : $title, $content);
        if ($result) {
            header('location: index.php?controller=NoteController&action=edit&id=' . $result);
        } else {
            $_SESSION['errors']['store'] = 'Có lỗi xảy ra!';
            $_SESSION['old'] = $old;
            header('location: index.php?controller=NoteController&action=create');
        }
    }

    public function edit()
    {
        // echo __METHOD__;
        $this->loadModel('Note');
        $note = $this->model->find($_GET['id']);
        // var_dump($note);

        if ($note) {
            $this->loadView('note/edit', ['note' => $note]);
            // var_dump($_SESSION['errors']);
            unset($_SESSION['errors']);
            unset($_SESSION['old']);
            unset($_SESSION['success']);

        } else {
            $_SESSION['errors']['edit'] = 'Không tìm thấy note này!';
            header('location: index.php?controller=NoteController&action=index');
        }
    }

    public function update()
    {
        // echo __METHOD__;
        // var_dump($_POST);
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            header('location: index.php');
            die();
        }

        //validate độ dài title
        $title = $_POST['title'] ?? "untitled";
        $content = $_POST['content'];
        $id = $_POST['id'];
        $hasInvalid =  false;
        $old = [
            'title' => $title,
            'content' => $content,
        ];
        if (strlen(trim($title)) > 50) {
            $errors['title'] = "Tiêu đề không được dài quá 50 ký tự!";
            $hasInvalid = true;
        }

        if ($hasInvalid) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = $old;
        } else {

            $this->loadModel('Note');

            $result = $this->model->update($id, $title, $content);
            if ($result) {
                $_SESSION['success']['update'] = 'Đã lưu!';
            } else {
                $_SESSION['errors']['store'] = 'Có lỗi xảy ra!';
                $_SESSION['old'] = $old;
            }
        }

        header('location: index.php?controller=NoteController&action=edit&id=' . $id);
    }
    public function delete()
    {
        echo __METHOD__;
        $this->loadModel('Note');
        $id = !empty($_GET['id'])?$_GET['id']:0;
        $result = $this->model->delete($id);
        if(!$result){
          $_SESSION['error']['delete'] = 'Có lỗi xảy ra, không thể xóa!';  
        }

        header('location: index.php?controller=NoteController&action=index');

    }
}

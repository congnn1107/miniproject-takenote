<?php
include_once CORE_PATH . '/Model.php';

class User extends Model
{
    protected $table;

    public function __construct()
    {
        $this->table = 'user';
    }

    public function insert($name, $email, $password)
    {

        $conn = $this->getConnection();
        $query = "insert into $this->table(name,email,password) values (:name,:email,:password)";
        $statement =  $conn->prepare($query);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':password', $password);

        return $statement->execute();
    }
    public function getInfo($email, $password)
    {
        $conn = $this->getConnection();

        $query =  "select id,name,email,password,remember_token from $this->table where email = :email and password= :password limit 1";
        $statement = $conn->prepare($query);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':password', md5($password));

        $statement->execute();

        return $statement->fetch(PDO::FETCH_OBJ);
    }
    public function matchEmail($email)
    {
        $conn = $this->getConnection();

        $query =  "select id from $this->table where email = :email limit 1";
        $statement = $conn->prepare($query);
        $statement->bindParam(':email', $email);

        $statement->execute();
        return $statement->rowCount();
    }
    public function setToken($token){
        $conn = $this->getConnection();

        $query =  "update $this->table set remember_token = :token where id = :user_id ";
        $statement = $conn->prepare($query);
        $user_id = $_SESSION['user']->id;
        $statement->bindParam(':token', $token);
        $statement->bindParam(':user_id', $user_id);

        return $statement->execute();
    }
    public function searchByToken($token){
        $conn = $this->getConnection();

        $query =  "select id,name,email,password from  $this->table where remember_token = :token ";
        $statement = $conn->prepare($query);
        $statement->bindParam(':token', $token);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_OBJ);
    }
}

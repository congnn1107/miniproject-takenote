<?php
include_once CORE_PATH . '/Model.php';
class Note extends Model
{
    protected $table;
    public function __construct()
    {
        $this->table = 'note';
    }
    public function insert($title, $content)
    {
        $conn = $this->getConnection();
        $query = "insert into $this->table(title,content,user_id) values(:title,:content,:user_id)";
        $statement = $conn->prepare($query);
        $user_id = $_SESSION['user']->id;
        $statement->bindParam(':title', $title);
        $statement->bindParam(':content', $content);
        $statement->bindParam(':user_id', $user_id);
        if ($statement->execute()) {
            return $conn->lastInsertId();
        }
        return false;
    }
    public function find($id)
    {
        $conn = $this->getConnection();
        $query = "select * from $this->table where id = :id and user_id = :user_id";
        $user_id = $_SESSION['user']->id;
        $statement = $conn->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->bindParam(':user_id', $user_id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_OBJ);
    }
    public function selectAll()
    {
        $conn = $this->getConnection();
        $query = "select * from $this->table where user_id = :user_id";
        $user_id = $_SESSION['user']->id;
        $statement = $conn->prepare($query);
        $statement->bindParam(':user_id', $user_id);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }
    public function update($id, $title, $content)
    {

        $conn = $this->getConnection();
        $query = "update $this->table set title = :title , content = :content where id = :id and user_id = :user_id";
        $statement = $conn->prepare($query);
        $user_id = $_SESSION['user']->id;
        $statement->bindParam(':title', $title);
        $statement->bindParam(':content', $content);
        $statement->bindParam(':id', $id);
        $statement->bindParam(':user_id', $user_id);
        return $statement->execute();
    }
    public function delete($id)
    {
        $conn = $this->getConnection();
        $query = "delete from $this->table where id = :id and user_id = :user_id";
        $statement = $conn->prepare($query);
        $user_id = $_SESSION['user']->id;
        $statement->bindParam(':id', $id);
        $statement->bindParam(':user_id', $user_id);
        return $statement->execute();
    }
}

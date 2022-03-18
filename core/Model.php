<?php

class Model
{

    private $connection;

    private function initConnection()
    {
        if (empty($this->connection)) {
            try {
                $this->connection = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Lỗi kết nối DB: " . $e->getMessage();
            }
        }
    }
    protected function getConnection()
    {
        $this->initConnection();
        return $this->connection;
    }
}

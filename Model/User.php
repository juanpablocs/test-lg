<?php

namespace Model;

class User {

    protected $db;

    public $user;

    function __construct($id = 0) {
        //this block code has to improve
        try {
            $this->db = new \PDO('mysql:host=' . MYSQL_SERVER . ';dbname=' . MYSQL_DATABASE, MYSQL_USER, MYSQL_PASS);
        }catch(\PDOException $e) {
            throw new Exception('Error mysql Database ' . $e->getMessage());
        }

        if($id) {
            $this->find($id);
        }
    }

    /**
     * Valid user exist
     * @return boolean
     */
    public function exist() {
        return (bool) $this->user;
    }

    /**
     * Search user by id
     * @param $id integer
     * @return void
     */
    public function find($id) {
        try {
            $query = $this->db->prepare("SELECT * FROM user WHERE id=:id LIMIT 1");
            $query->bindParam(':id', $id);
            $query->execute(); 
            $this->user = $query->fetch(\PDO::FETCH_OBJ);
            return $this->user;
        }catch(\Exception $e) {
            return null;
        }
    }

    /**
     * Create user
     * @param $name string
     * @param $password string
     * @return bool
     */
    public function create($name, $password) {
        try {
            $query = $this->db->prepare("INSERT INTO user (name, password) VALUES (:name, :password)");
            $query->bindParam(':name', $name);
            $query->bindParam(':password', $password);
            return $query->execute();
        }catch(\Exception $e) {
            return false;
        }
    }

    /**
     * Update password
     * @param $password string
     * @return bool
     */
    public function updatePassword($password) {
        try {
            $query = $this->db->prepare("UPDATE user SET password = :password WHERE id = :id");
            $query->bindParam(':id', $this->getId());
            $query->bindParam(':password', $password);
            return $query->execute();
        }catch(\Exception $e) {
            return false;
        }
    }

    /**
     * Get User Name
     * @return string
     */
    public function getName() {
        return $this->user->name;
    }

    /**
     * Get User Id
     * @return integer
     */
    public function getId() {
        return (int)$this->user->id;
    }

    /**
     * Get User Password
     * @return string
     */
    public function getPassword() {
        return $this->user->password;
    }
}
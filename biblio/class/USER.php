<?php

class User {

  private $db = NULL;
  private $id = NULL;
  private $username = NULL;
  private $password = NULL;
  private $role = NULL;

  public function __construct($db, $username, $password, $role){
     $this->db = $db;
     $this->username = $username;
     $this->password = $password;
     $this->role = $role;
  }

  private function getId() { return $this->id;}
  private function getUsername() { return $this->username;}
  private function getPassword() { return $this->password;}
  private function getRole() {
    if($this->role == 1){
      $this->role = "Administrateur";
    }
    if($this->role == 2){
      $this->role = "Client";
    }
    return $this->role;
  }

  private function setUsername($username) {
    $this->username = $username;
    return $this->username;
  }
  private function setPassword($password) {
    $this->password = $password;
    return $this->password;
  }

  public function listUser() {

    $query = $this->db->prepare
    ('SELECT id, username , password, role
      FROM users
    ');
    $query->execute();

    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if(sizeof($results)>0){
      return $results;
    }
    else{
      return false;
    }
  }
  public function addUser() {

      $query = $this->db->prepare(
        'INSERT INTO users (username, password, role) VALUES (:username, :password, :role)'
      );
      $query->bindValue(':username', $this->getUsername(), PDO::PARAM_STR);
      $query->bindValue(':password', $this->getPassword(), PDO::PARAM_STR);
      $query->bindValue(':role', $this->getRole(), PDO::PARAM_STR);
      $query->execute();
      header('location:?route=user/manage');

  }
  public function userInfo($id) {

    $query = $this->db->prepare(
      'SELECT username, password, role FROM users WHERE id = :id'
    );
    $query->bindValue(':id', $id, PDO::PARAM_INT);;
    $query->execute();
    return $query->fetch(PDO::FETCH_OBJ);
  }
  public function editUser($id) {

    $query = $this->db->prepare(
      ' UPDATE users
        SET username = :username, password = :password, role = :role
        WHERE id = :id
      ');
    $query->bindValue(':username', $this->getUsername(), PDO::PARAM_STR);
    $query->bindValue(':password', $this->getPassword(), PDO::PARAM_STR);
    $query->bindValue(':role', $this->getRole(), PDO::PARAM_STR);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    header('location:?route=user/manage');
  }
  public function deleteUser($id) {
    $query = $this->db->prepare('DELETE FROM users WHERE id = :id');
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    header('location:?route=user/manage');
  }
}

?>

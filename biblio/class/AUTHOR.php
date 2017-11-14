<?php

class Author {

  private $db = NULL;
  private $id = NULL;
  private $firstname = NULL;
  private $lastname = NULL;
  private $birth_year = NULL;
  private $country = NULL;

  public function __construct($db, $firstname, $lastname, $birth_year, $country){
     $this->db = $db;
     $this->firstname = $firstname;
     $this->lastname = $lastname;
     $this->birth_year = $birth_year;
     $this->country = $country;
  }

  private function getId() { return $this->id;}
  private function getFirstname() { return $this->firstname;}
  private function getLastname() { return $this->lastname;}
  private function getBirthYear() { return $this->birth_year;}
  private function getCountry() { return $this->country;}


  private function setFirstname($firstname) {
    $this->firstname = $firstname;
    return $this->firstname;
  }
  private function setLastname($lastname) {
    $this->lastname = $lastname;
    return $this->lastname;
  }
  private function setBirthYear($birth_year) {
    $this->birth_year = $birth_year;
    return $this->birth_year;
  }
  private function setCountry($country) {
    $this->country = $country;
    return $this->country;
  }

  public function listAuthor() {

    $query = $this->db->prepare
    ('SELECT id, firstname , lastname, birth_year, country
      FROM author
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
  public function addAuthor() {

      $query = $this->db->prepare(
        'INSERT INTO author (firstname, lastname, birth_year, country) VALUES (:firstname, :lastname, :birth_year, :country)'
      );
      $query->bindValue(':firstname', $this->getFirstname(), PDO::PARAM_STR);
      $query->bindValue(':lastname', $this->getLastname(), PDO::PARAM_STR);
      $query->bindValue(':birth_year', $this->getBirthYear(), PDO::PARAM_STR);
      $query->bindValue(':country', $this->getCountry(), PDO::PARAM_STR);
      $query->execute();
      header('location:?route=author/manage');

  }
  public function authorInfo($id) {

    $query = $this->db->prepare(
      'SELECT firstname, lastname, birth_year, country FROM author WHERE id = :id'
    );
    $query->bindValue(':id', $id, PDO::PARAM_INT);;
    $query->execute();
    return $query->fetch(PDO::FETCH_OBJ);
  }
  public function editAuthor($id) {

    $query = $this->db->prepare(
      ' UPDATE author
        SET firstname = :firstname, lastname = :lastname, birth_year = :birth_year, country = :country
        WHERE id = :id
      ');
    $query->bindValue(':firstname', $this->getFirstname(), PDO::PARAM_STR);
    $query->bindValue(':lastname', $this->getLastname(), PDO::PARAM_STR);
    $query->bindValue(':birth_year', $this->getBirthYear(), PDO::PARAM_STR);
    $query->bindValue(':country', $this->getCountry(), PDO::PARAM_STR);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    header('location:?route=author/manage');
  }
  public function deleteAuthor($id) {
    $query = $this->db->prepare('DELETE FROM author WHERE id = :id');
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    header('location:?route=author/manage');
  }
  public function getAuthorById($id) {

    $query = $this->db->prepare(
      'SELECT firstname, lastname FROM author WHERE id = :id'
    );
    $query->bindValue(':id', $id, PDO::PARAM_INT);;
    $query->execute();
    return $query->fetch(PDO::FETCH_OBJ);

  }
  public function getNbBook($id){
    $query = $this->db->prepare(
      'SELECT COUNT(*) FROM book WHERE id_author = :id_author');
    $query->execute(array(
      ':id_author' => $id
    ));
    $num = $query->fetch(PDO::FETCH_NUM);
    // fetch envoie un tableau d'un seul élément (indice 0)
    return $num[0];
  }
  public function getBook($id){
    $query = $this->db->prepare(
      'SELECT * FROM book WHERE id_author = :id_author');
    $query->execute(array(
      ':id_author' => $id
    ));
    return $query->fetchAll(PDO::FETCH_OBJ);
  }
}

?>

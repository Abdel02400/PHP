<?php

class Book {

  private $db = NULL;
  private $id = NULL;
  private $title = NULL;
  private $isbn = NULL;
  private $nb_pages = NULL;
  private $id_author = NULL;
  private $etat = NULL;

  public function __construct($db, $title, $isbn, $nb_pages, $id_author, $etat){
     $this->db = $db;
     $this->title = $title;
     $this->isbn = $isbn;
     $this->nb_pages = $nb_pages;
     $this->id_author = $id_author;
     $this->etat = $etat;
  }

  private function getId() { return $this->id;}
  private function getTitle() { return $this->title;}
  private function getIsbn() { return $this->isbn;}
  private function getNbPages() { return $this->nb_pages;}
  private function getIdAuthor() { return $this->id_author;}
  private function getEtat() {
    if($this->etat == 1){
      $this->etat = "Disponible";
    }
    if($this->etat == 2){
      $this->etat = "Indisponible";
    }
    return $this->etat;
  }


  private function setTitle($title) {
    $this->title = $title;
    return $this->title;
  }
  private function setIsbn($isbn) {
    $this->isbn = $isbn;
    return $this->isbn;
  }
  private function setNbPages($nb_pages) {
    $this->nb_pages = $nb_pages;
    return $this->nb_pages;
  }
  private function setIdAuthor($id_author) {
    $this->id_author = $id_author;
    return $this->id_author;
  }
  private function setEtat($etat) {
    $this->etat = $etat;
    return $this->etat;
  }

  public function listBook() {

    $query = $this->db->prepare
    ('SELECT id, title , isbn, nb_pages, id_author, etat
      FROM book
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
  public function addBook() {

      $query = $this->db->prepare(
        'INSERT INTO book (title, isbn, nb_pages, id_author, etat) VALUES (:title, :isbn, :nb_pages, :id_author, :etat)'
      );
      $query->bindValue(':title', $this->getTitle(), PDO::PARAM_STR);
      $query->bindValue(':isbn', $this->getIsbn(), PDO::PARAM_STR);
      $query->bindValue(':nb_pages', intval($this->getNbPages()), PDO::PARAM_INT);
      $query->bindValue(':id_author', intval($this->getIdAuthor()), PDO::PARAM_INT);
      $query->bindValue(':etat', $this->getEtat(), PDO::PARAM_STR);
      $query->execute();
      header('location:?route=book/manage');

  }
  public function bookInfo($id) {

    $query = $this->db->prepare(
      'SELECT id, title, isbn, nb_pages, id_author, etat FROM book WHERE id = :id'
    );
    $query->bindValue(':id', $id, PDO::PARAM_INT);;
    $query->execute();
    return $query->fetch(PDO::FETCH_OBJ);
  }
  public function editBook($id) {

    $query = $this->db->prepare(
      ' UPDATE book
        SET title = :title, isbn = :isbn, nb_pages = :nb_pages, id_author = :id_author, etat = :etat
        WHERE id = :id
      ');
      $query->bindValue(':title', $this->getTitle(), PDO::PARAM_STR);
      $query->bindValue(':isbn', $this->getIsbn(), PDO::PARAM_STR);
      $query->bindValue(':nb_pages', intval($this->getNbPages()), PDO::PARAM_INT);
      $query->bindValue(':id_author', intval($this->getIdAuthor()), PDO::PARAM_INT);
      $query->bindValue(':etat', $this->getEtat(), PDO::PARAM_STR);
      $query->bindValue(':id', $id, PDO::PARAM_INT);
      $query->execute();
      header('location:?route=book/manage');
  }
  public function deleteBook($id) {
    $query = $this->db->prepare('DELETE FROM book WHERE id = :id');
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    header('location:?route=book/manage');
  }
  public function getRetourById($id) {
    $query = $this->db->prepare(
      'SELECT retour FROM reservation WHERE id_book = :id'
    );
    $query->bindValue(':id', $id, PDO::PARAM_INT);;
    $query->execute();
    return $query->fetch(PDO::FETCH_OBJ);
  }
}

?>

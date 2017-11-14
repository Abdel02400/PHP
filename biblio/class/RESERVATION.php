<?php

class Reservation {

  private $db = NULL;
  private $id = NULL;
  private $id_book = NULL;
  private $id_user = NULL;
  private $retour = NULL;

  public function __construct($db, $id_book, $id_user, $retour){
     $this->db = $db;
     $this->id_book = $id_book;
     $this->id_user = $id_user;
     $this->retour = $retour;
  }

  private function getId() { return $this->id;}
  private function getIdBook() { return $this->id_book;}
  private function getIdUser() { return $this->id_user;}
  private function getRetour() { return $this->retour;}

  private function setIdBook($id_book) {
    $this->id_book = $id_book;
    return $this->id_book;
  }
  private function setIdUser($id_user) {
    $this->id_user = $id_user;
    return $this->id_user;
  }
  private function setRetour($retour) {
    $this->retour = $retour;
    return $this->retour;
  }

  public function addReservation() {

    $query = $this->db->prepare(
      'INSERT INTO reservation (id_book, id_user, retour) VALUES (:id_book, :id_user, :retour)'
    );
    $query->bindValue(':id_book', intval($this->getIdBook()), PDO::PARAM_INT);
    $query->bindValue(':id_user', intval($this->getIdUser()), PDO::PARAM_INT);
    $query->bindValue(':retour', $this->getRetour(), PDO::PARAM_STR);
    $query->execute();

    $etat = "Indisponible";
    $query2 = $this->db->prepare(
      ' UPDATE book
        SET etat = :etat
        WHERE id = :id
      ');
    $query2->bindValue(':etat', $etat, PDO::PARAM_STR);
    $query2->bindValue(':id', intval($this->getIdBook()), PDO::PARAM_INT);
    $query2->execute();
    header('location:?route=book/manage');
  }
  public function listReservation() {
    $query = $this->db->prepare
    ('SELECT id, id_book , id_user, retour
      FROM reservation
    ');
    $results = $query->execute();

    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if(sizeof($results)>0){
      return $results;
    }
    else{
      return false;
    }
  }
  public function listReservationById($id) {
    $query = $this->db->prepare
    ('SELECT id, id_book , id_user, retour
      FROM reservation
      WHERE id_user = :id
    ');
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $results = $query->execute();

    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if(sizeof($results)>0){
      return $results;
    }
    else{
      return false;
    }
  }
  public function deleteReservation($id,$id_book) {
    $query = $this->db->prepare('DELETE FROM reservation WHERE id = :id');
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();

    $etat = "Disponible";
    $query2 = $this->db->prepare(
      ' UPDATE book
        SET etat = :etat
        WHERE id = :id_book
      ');
    $query2->bindValue(':etat', $etat, PDO::PARAM_STR);
    $query2->bindValue(':id_book', $id_book, PDO::PARAM_INT);
    $query2->execute();
    header('location:?route=reservation/manage');
  }
}



?>

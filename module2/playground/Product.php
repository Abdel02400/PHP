<?php

class Product {
  //constante de classe
  const CONSTANTE_DE_CLASSE = "Je suis un constante de classe";




  private $price = 99.99;
  private $available = false;
  private $name = NULL;

  public $test = "public test product";
  protected $test2 = "protected test2 product";

  //constructeur
  public function __construct($name){
    //apelle de la mtéthode setName en interne
    $this->setName($name);
  }

  // accesseurs (getters) => accès en lecture
  public function getPrice() {
      return $this->price;
  }
  public function getAvailable() {
      return $this->available;
  }
  public function getName(){
    return $this->name;
  }

  //mutateurs (setters) => accès en écriture
  public function setPrice($price) {
    $this->price = $price;
    return $this->price;
  }

  public function setAvailable($available) {
    $this->available = $available;
    return $this->available;
  }
  public function setName($name){
    $this->name = $name;
    return $this->name;
  }


}

?>

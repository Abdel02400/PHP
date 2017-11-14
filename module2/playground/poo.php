<?php
include('Color.php'); // inclusion de la classe color
include_once('Product.php'); // inclusion de la classe Product
include_once('Book.php');
include_once('Weapon.php');

class Player {
  // propriétés
  public $firstname = "";
  public $lastname = "";
  public $team = "";
  public $age = NULL;

  // méthodes (function a l'intérieur d'une classe)
  public function getFullName(){
    return $this->firstname . " " . $this->lastname;
  }
  public function ageAfterTenYears() {
    return $this->age+10;
  }
  public function ageAfterNbYears($nbYears){
    return $this->age + $nbYears;
  }
  public function ageAfterTenYearsAlter() {
    $this->age +=10; //valeur(altérée)
    return $this->age; // retour de la nouvelle valeur
  }
}

// $player1 = new Player();
// $player2 = new Player();
// $player3 = new Player();
//
// $player1->firstname = "Andrea"; //accès en écriture
// $player1->lastname = "Pirlo";
//
$color1 = new Color("red");
$color2 = new Color("orange");
echo $color2->colorHuman;
echo $color1->colorHuman;
// echo $color1->convertToHexa();
// echo ($color2->convertToHexa()) ? 'Couleur trouvée' : 'Couleur non trouvée';
// echo $color1->convertToRgb();

// $product1 = new Product("arme blanche");
// $product1->setPrice(14.6);
// $product1->setAvailable(true);
// var_dump($product1);
// //echo $product1->CONSTANTE_DE_CLASSE; //Impossible
// echo Product::CONSTANTE_DE_CLASSE;
// // echo $product1->test;
// // // echo $product1->test2; //fatal error (propriété protégé)
// // //echo $product1->getTest2();
//
// echo '<br/>';
//
// $book1 = new Book();
// //
// // $book1->setAvailable(false);
// // $book1->setNbPages(450);
// var_dump($book1->getPrice());
// echo $book1->test;
// //echo $book1->test2; //fatal error (propriété protégé)
// echo $book1->getTest2();

//
// echo '<br/>';
//
// $weapon1 = new Weapon("Arme blanche");
// $weapon1->setPrice(1450.2);
// $weapon1->setAvailable(true);
// $weapon1->setCategory(6);
// var_dump($weapon1);



?>

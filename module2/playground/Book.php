<?php
include_once('Product.php');

class Book extends Product {

  //private innacessible a partir de l'exterieur
  //accessible seulement a l'interieur de la classe
  //Non ecrasable par une classe heritiere
  //SI la classe fille definit une propiete portant le meme Nom
  //que dans la classe mere => doublon genere

  //protected innacessible a partir de l'exterieur
  //accessible seulement a l'interieur de la classe
  //Non ecrasable par une classe heritiere
  //SI la classe fille definit une propiete portant le meme Nom
  //que dans la classe mere => Cette propriete

  //publmic accessible a partir de l'exterieur
  //accessible seulement a l'interieur de la classe
  //Non ecrasable par une classe heritiere
  //SI la classe fille definit une propiete portant le meme Nom
  //que dans la classe mere => cette propriete remplace celle provement de la classe mere


  private $nbPages = NULL;
  private $price = 14.9;
  public $test = "public test product";
  protected $test2 = "protected test2 product";

  //le constructeur de l'enfant remplace celui du ParentIterator
  //il ne peut y avoir qu'un seul constructeur par classe
  public function __construct() {

  }

  public function getTest2(){
    return $this->test2; // renvoi le contenu de la propriété protégé
  }
  public function getNbPages() {
    return $this->nbPages;
  }
  public function setNbPages($nbPages) {
    $this->nbPages = $nbPages;
    return $this->nbPages;
  }

}

?>

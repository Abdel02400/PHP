<?php

class Color {

  const COLOR_DEFAULT = 'black';

  public $colorHuman= NULL;

  private $colors = array(
    array(
      'human' => 'red',
      'hexa'  => 'FF0000',
      'rgb'   => '255, 0, 0'
    ),
    array(
      'human' => 'green',
      'hexa'  => '00FF00',
      'rgb'   => '0, 255, 0'
    ),array(
      'human' => 'black',
      'hexa'  => '000000',
      'rgb'   => '0, 0, 0'
    ),
  );

  // constructeur : function declenché automatiquement
  // lors de l'installation (new) d'un oci_fetch_object
  // permet de fournir a l'objet des données dès l'instanciation
  public function __construct($colorHuman){
    //hydratation: "alimente" les propriétes en données
    // au constructeur au moment de l'instanciation
    $this->colorHuman = $colorHuman;
    if($this->checkColor($colorHuman)){
      //couleur données a l'instanciation trouvée par la méthode checkcolor
      $this->colorHuman = $colorHuman;
    }
    else {
      $this->colorHuman = self::COLOR_DEFAULT;
    }
  }

  public function convertToHexa() {

    $colorHexa = NULL;

    foreach($this->colors as $color){

        if($color['human'] == $this->colorHuman){
          $colorHexa = $color['hexa'];
          break;
        }
    }
    return $colorHexa;
  }

  public function convertToRgb() {

    $colorRgb = NULL;

    foreach($this->colors as $color){

        if($color['human'] == $this->colorHuman){
          $colorRgb = $color['rgb'];
          break;
        }
    }
    return $colorRgb;
  }
  private function checkColor($colorStr) {
    $colorHumanFound = false;

    foreach($this->colors as $color){

        if($color['human'] == $colorStr){
          $colorHumanFound = true;
          break;
        }
    }
    return $colorHumanFound;
  }
}


?>

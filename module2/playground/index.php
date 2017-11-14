<?php
$db = new PDO('mysql:host=localhost;dbname=quizz;charset=utf8','root','1993Aruu');
//$db est un objet de type PDO, il contient des propriétés et des méthodes permettant d'intéragir avec la BDD
//var_dump($db);

//->query();
$sql = 'SELECT * FROM stagiaire';
//$db->query($sql);

// fetch
//ligne SQL transformées en tableaux PHP, a la fois associatif et num
foreach($db->query($sql,PDO::FETCH_OBJ) as $stagiaire) {

  echo '<p>' . $stagiaire->nom . '</p>';

}



?>


 <h1>Module 2</h1>

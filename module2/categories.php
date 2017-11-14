<?php

$query = $db->prepare('SELECT * FROM categories');

$query->execute();

$categories = $query->fetchAll(PDO::FETCH_OBJ);

 ?>

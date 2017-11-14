


<html>
  <head lang="fr">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style2.css">
    <title>Page de connexion</title>
  </head>
  <body>
    <div class="container">
          <form class="form-signin" action="login.php" method="post">
            <h2 class="form-signin-heading">Se connecter</h2>
            <label for="inputNom" class="sr-only">Nom</label>
            <input type="text" class="form-control" placeholder="Votre nom" name="nom" required autofocus>
            <label for="inputPassword" class="sr-only">Mot de passe</label>
            <input type="password" class="form-control" placeholder="Votre mot de passe" name="mdp" required autofocus>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Valider</button>
          </form>
    </div>
  </body>
</html>

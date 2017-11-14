<?php
include_once('./class/USER.php');
$users = new User($db,NULL,NULL,NULL);
$listusers = $users->listUser();
$result = NULL;
if(isset($_POST['submit'])){
  $username = $_POST['username'];
  $password = $_POST['password'];
  $role = $_POST['role'];
  $adduser = new User($db, $username, $password, $role);
  $cond = $_POST['role']   != "0";
  if($cond) {
    $adduser->addUser();
  }
  else {
    $result = "Veuillez choisir un rôle";
  }
}
if(isset($_GET['edit'])){
  $id_user = $_GET['id_user'];
  $edit_user = new User($db, NULL, NULL, NULL);
  $user_info = $edit_user->userInfo($id_user);
  if(isset($_POST['update'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $edit_user = new User($db, $username, $password, $role);
    $cond = $_POST['role']   != "0";
    if($cond) {
      $edit_user->editUser($id_user);
    }
    else {
      $result = "Veuillez choisir un rôle";
    }
  }
}
?>
<div class="row">

  <div class="col-md-8">
    <h2>Liste des utilisateurs</h2>
    <table class="table table-bordered table-striped">
        <tr>
          <th>#</th>
          <th>Identifiant</th>
          <th>Mot de passe</th>
          <th>Rôle</th>
          <th>Actions</th>
        </tr>
        <?php $i = 0 ?>
        <?php foreach($listusers as $user): ?>
          <tr>
            <td><?= ++$i ?></td>
            <td><?= $user->username ?></td>
            <td><?= $user->password ?></td>
            <td><?= $user->role ?></td>
            <td>
              <?php
                $urlDel = '?route=user/delete&id_user=' . $user->id;

                $urlEdit = '?route=user/manage&id_user=' . $user->id;
                $urlEdit .= '&edit=true';
              ?>
              <a
                href="<?= $urlEdit ?>"
                class="btn btn-default btn-xs">Modifier</a>
              <a
                href="<?= $urlDel ?>"
                class="btn btn-danger btn-xs">Supprimer</a>
            </td>
          </tr>
        <?php endforeach ?>
      </table>
  </div>

  <div class="col-md-4">
    <?php if(!isset($_GET['edit'])): ?>
      <h3>Ajouter un utilisateur</h3>
      <form class="well" method="POST">

        <div class="form-group">
          <label for="username">Identifiant : </label>
          <input type="text" name="username" placeholder="Identifiant" required>
        </div>

        <div class="form-group">
          <label for="password">Mot de passe : </label>
          <input type="text" name="password" placeholder="mot de passe" required>
        </div>

        <div class="form-group">
          <label for="role">Rôle de l'utilisateur : </label>
          <select name="role">
            <option value="0">Choisir le rôle du nouvel utilisateur</option>
            <option value="1">Administrateur</option>
            <option value="2">Client</option>
          </select>
        </div>
        <?php echo "<p style='color:red' >" . $result . '</p>'; ?>
        <input type="submit" name="submit" value="Enregistrer">
      </form>
    <?php else: ?>

      <h3>Modifier un utilisateur</h3>
      <form class="well" method="POST">

        <div class="form-group">
          <label for="username">Identifiant : </label>
          <input type="text" name="username" placeholder="Identifiant" value="<?= $user_info->username ?>" required>
        </div>

        <div class="form-group">
          <label for="password">Mot de passe : </label>
          <input type="text" name="password" placeholder="mot de passe" value="<?= $user_info->password ?>" required>
        </div>

        <div class="form-group">
          <label for="role">Rôle de l'utilisateur : </label>
          <select name="role">
            <option value="0">Choisir le rôle du nouvel utilisateur</option>
              <?php if($user_info->role == "Administrateur"): ?>
                <option selected value="1">Administrateur</option>
                <option value="2">Client</option>
              <?php else: ?>
                <option selected value="2">Client</option>
                <option value="1">Administrateur</option>
              <?php endif ?>
          </select>
        </div>
        <?php echo "<p style='color:red' >" . $result . '</p>'; ?>
        <input type="submit" name="update" value="Enregistrer">
      </form>

    <?php endif ?>
  </div>
</div>

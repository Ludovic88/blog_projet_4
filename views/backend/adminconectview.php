<?php $title = 'admin | connexion'; ?>

<h2>Rentrer nom d'utilisateur et mot de passe</h2>
<form action="<?= PATH_PREFIX ?>/verifypass" method="post" class="form-group">
    <label for="pseudo">Pseudo</label> : <input type="text" id="pseudo" name="pseudo" class="form-control col-md-3" placeholder="Ex : Jean" required/><br/>
    <label for="password">Mot de passe</label> :  <input type="password" name="password" id="password" class="form-control col-md-3" required/><br/>
    <input type="hidden" name="token" id="token" value="<?= $_SESSION['token'] ?>" />
    <button type="button submit" class="btn btn-outline-dark">Se connecter</button>
</form>
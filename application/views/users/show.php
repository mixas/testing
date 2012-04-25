<h1 class="page_title">User with id <?= $id ?> profile</h1>

<p class="form_labels" style="font-weight: bold;">User name: </p>
<?= $name ?>
<p class="form_labels" style="font-weight: bold;">Email: </p>
<?= $email ?>

<input type="button" class="buttons" value="Users list" onclick="document.location='<?= base_url() . 'index.php/users' ?>'" />
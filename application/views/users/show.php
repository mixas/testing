<h1 class="page_title">User <?= $id ?></h1>
<p class="form_labels" style="font-weight: bold;">User name: </p>
<?= $name ?>
<p class="form_labels" style="font-weight: bold;">Email: </p>
<?= $email ?>
<?= anchor('index.php/users','Users list', array('class' => 'buttons')) ?>
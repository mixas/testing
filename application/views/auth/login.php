<h1 class="page_title">Login</h1>
<?php echo validation_errors(); ?>
<?= form_open('/index.php/auth/login') ?>
<p class="form_labels">Email:</p>
<?= form_input(array('name' => 'email', 'class' => 'input_fields'));?>
<br />
<p class="form_labels">Password: </p>
<?= form_password(array('name' => 'password', 'class' => 'input_fields'));?>
<br />
<?= form_submit(array('name' => 'submit_data', 'class' => 'buttons', 'value' => 'login')); ?>
<?= form_close(); ?>
<? if (isset($message)){ echo $message; } ?>
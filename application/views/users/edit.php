<h1 class="page_title">Edit profile</h1>
<?php echo validation_errors(); ?>
<?= form_open('/index.php/users/edit/'.$id) ?>

    <p class="form_labels">Name: </p>
    <?= form_input(array('name' => 'name', 'value' => $name, 'class' => 'input_fields' )) ?>
    <p class="form_labels">Email: </p>
    <?= form_input(array('name' => 'email', 'value' => $email, 'class' => 'input_fields' )) ?>
    <p class="form_labels">Password: </p>
    <?= form_password(array('name' => 'password', 'class' => 'input_fields' )) ?>
    <p class="form_labels">Group: </p>
    <?= form_input(array('name' => 'group_id', 'value' => $group_id, 'class' => 'input_fields' )) ?>

<?= form_submit(array('class' => 'buttons', 'value' => 'Save user', 'class' => 'buttons')); ?>
<input type="button" class="buttons" value="Back to list" onclick="document.location='<?= base_url() . 'index.php/users' ?>'" />
<?= form_close() ?>


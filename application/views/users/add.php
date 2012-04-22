<h1 class="page_title">Add user </h1>
<?
    $CI = &get_instance();
?>

<?php echo validation_errors(); ?>
<?= form_open('/index.php/users/add') ?>

    <p class="form_labels">Name: </p>
    <?= form_input(array('name' => 'name', 'class' => 'input_fields' )) ?>
    <p class="form_labels">Email: </p>
    <?= form_input(array('name' => 'email', 'class' => 'input_fields' )) ?>
    <p class="form_labels">Password: </p>
    <?= form_password(array('name' => 'password', 'class' => 'input_fields' )) ?>
    
    <!-- drop down with groups -->
    <?
        $options = array();
        $request = $CI->db->get('groups');
        $groups = $request->result();
        foreach($groups as $each){
            $options[$each->id] = $each->name;
        }
    ?>
    <p class="form_labels">Select group:</p>
    <?= form_dropdown('group_id', $options, $options[1], 'class="selected_fields"') ?>

<?= form_submit(array('class' => 'buttons', 'value' => 'Add user', 'class' => 'buttons')); ?>
<?= form_close() ?>
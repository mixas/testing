<h1 class="page_title">Add group</h1>
<?= validation_errors(); ?>
<?= form_open('/index.php/groups/add') ?>

    <p class="form_labels">Group name: </p>
    <?= form_input(array('name' => 'name', 'class' => 'input_fields')); ?>
    
<?= form_submit(array('class' => 'buttons', 'value' => 'Add group')); ?>
<?= form_close() ?>
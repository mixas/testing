<h1 class="page_title">Add test</h1>
<?php echo validation_errors(); ?>
<?= form_open('/index.php/tests/add') ?>

    <?
        $options = array(
            'mdl_test_classic'  => 'Classic test',
            'mdl_test_adaptive'    => 'Adaptive test'
        );
    ?>
    
    <p class="form_labels">Title: </p>
    <?= form_input(array('name' => 'title', 'class' => 'input_fields' )) ?>
    
    <p class="form_labels">Description: </p>
    <?= form_input(array('name' => 'description', 'class' => 'input_fields' )) ?>
    
    <p class="form_labels">Test type: </p>
    <?= form_dropdown('type', $options, 'mdl_test_classic'); ?>
    
    <p class="form_labels">Image name (image should be in ../testing/images/): </p>
    <?= form_input(array('name' => 'image', 'class' => 'input_fields' )) ?>
    
<?= form_submit(array('class' => 'buttons', 'value' => 'Add test', 'class' => 'buttons')); ?>
<?= form_close() ?>
<h1 class="page_title">Add question</h1>
<?= validation_errors(); ?>
<?= form_open('/index.php/questions/add?test_id=' . $_GET['test_id']) ?>

    <p class="form_labels">Test id: </p>
    <!-- make select field -->
    <?= form_input(array('name' => 'test_id', 'value' => $_GET['test_id'], 'class' => 'input_fields')); ?>
    
    <p class="form_labels">Question text: </p>
    <?= form_textarea(array('name' => 'text', 'class' => 'input_areas', 'rows' => '3', 'cols' => '100')); ?>
    
    <p class="form_labels">Complexity: </p>
    <?= form_input(array('name' => 'complexity', 'class' => 'input_fields')); ?>
    
<?= form_submit(array('class' => 'buttons', 'value' => 'Add question')); ?>
<?= form_close() ?>
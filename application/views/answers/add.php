<h1 class="page_title">Add answer </h1>
<?= validation_errors(); ?>
<?= form_open('/index.php/answers/add?question_id=' . $_GET['question_id']) ?>

    <p class="form_labels">Question id: </p>
    <?= form_input(array('name' => 'question_id', 'value' => $_GET['question_id'], 'class' => 'input_fields' )) ?>
    <p class="form_labels">Answer text: </p>
    <?= form_textarea(array('name' => 'text', 'class' => 'input_areas', 'rows' => '3', 'cols' => '100')); ?>
    <p class="form_labels">Answer right?: </p>
    <?= form_checkbox(array('name' => 'right', 'value' => '1', 'class' => 'input_checks' )) ?>
    
<?= form_submit(array('class' => 'buttons', 'value' => 'Add question', 'class' => 'buttons')); ?>
<?= form_close() ?>
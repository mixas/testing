<h1 class="page_title">Edit answer <?= $id ?> </h1>
<?= validation_errors(); ?>
<?= form_open('/index.php/answers/edit/' . $id . '?question_id=' . $question_id) ?>

    <p class="form_labels">Question id: </p>
    <?= form_input(array('name' => 'question_id', 'value' => $question_id, 'class' => 'input_fields' )) ?>
    <p class="form_labels">Answer text: </p>
    <?= form_textarea(array('name' => 'text', 'value' => $text, 'class' => 'input_areas', 'rows' => '3', 'cols' => '100')); ?>
    <p class="form_labels">Answer right?: </p>
    <?= form_checkbox(array('name' => 'right', 'value' => '1', 'class' => 'input_checks', 'checked' => $right )) ?>
    
    
<?= form_submit(array('class' => 'buttons', 'value' => 'Save answer', 'class' => 'buttons')); ?>
<?= form_close() ?>
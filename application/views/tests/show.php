<h1 class="page_title">Test <?= $id ?></h1>

<?= form_open('/index.php/tests/go_first/' . $id) ?>

    <p class="form_labels" style="font-weight: bold;">Title: </p>
    <?= $title ?>
    <p class="form_labels" style="font-weight: bold;">Description: </p>
    <?= $description ?>
    
    <?= anchor('index.php/questions/add?test_id=' . $id, 'Add question', array('class' => 'buttons', 'style' => 'float:left;')) ?>

<?= form_submit(array('class' => 'buttons', 'value' => 'Pass test', 'class' => 'buttons')); ?>
<?= form_close(); ?>
<?= anchor('index.php/tests','Test list', array('class' => 'buttons', 'style' => 'float:left')) ?>
<h1 class="page_title">Edit test</h1>
<?php echo validation_errors(); ?>
<?= form_open('/index.php/tests/edit/'.$id) ?>

    <?
        $options = array(
            'mdl_test_classic'  => 'Classic test',
            'mdl_test_adaptive'    => 'Adaptive test'
        );
    ?>
    
    <p class="form_labels">Title: </p>
    <?= form_input(array('name' => 'title', 'value' => $title, 'class' => 'input_fields')) ?>
    
    <p class="form_labels">Description: </p>
    <?= form_input(array('name' => 'description', 'value' => $description, 'class' => 'input_fields')) ?>
    
    <p class="form_labels">Image: </p>
    <?= form_input(array('name' => 'image', 'value' => $image, 'class' => 'input_fields')) ?>
    
    <p class="form_labels">Test type: </p>
    <?= form_dropdown('type', $options, $type, 'class="selected_fields"'); ?>
    
    <p class="form_labels" style="font-weight: bold; text-align: center;">Questions: </p>
    <table align="center" width="100%" border="1" class="tables">
        <tr class="table_headers">
            <td>Id
            <td width="50%">Text
            <td width="20%">Complexity
            <td>Delete
        <? foreach($questions as $each): ?>
        <tr onclick="window.location = '<?= base_url() . 'index.php/questions/edit/' . $each->id; ?>'">
            <td><?= $each->id ?>
            <td><?= $each->text ?>
            <td><?= $each->complexity ?>
            <td><?= anchor('index.php/questions/delete/' . $each->id, 'delete', array('class' => 'crud_links'));?>
        </tr>
        <? endforeach ?>
    </table>

    <?= form_submit(array('class' => 'buttons', 'value' => 'Save test', 'class' => 'buttons')); ?>
<?= form_close() ?>

<?= anchor('index.php/tests/','Test list', array('class' => 'buttons', 'style' => 'float: left')) ?>
<?= anchor('index.php/questions/add?test_id=' . $id, 'Add question', array('class' => 'buttons', 'style' => 'float:left;')) ?>
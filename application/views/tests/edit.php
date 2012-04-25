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
    <?= form_textarea(array('name' => 'description', 'value' => $description, 'class' => 'input_areas', 'rows' => '3', 'cols' => '100')) ?>
    
    <p class="form_labels">Image (image should be in ): </p>
    <?= form_input(array('name' => 'image', 'value' => $image, 'class' => 'input_fields')) ?>
    
    <p class="form_labels">Test type: </p>
    <?= form_dropdown('type', $options, $type, 'class="selected_fields"'); ?>
    
    <p class="form_labels" style="font-weight: bold; text-align: center;">Questions: </p>
    
    <table align="center" width="100%" border="1" class="tables">
        <thead>
            <tr class="table_headers">
                <td>Id
                <td>Text
                <td>Complexity
                <td>Delete
            </tr>
        </thead>
        <tbody>
            <? foreach($questions as $each): ?>
            <tr onclick="window.location = '<?= base_url() . 'index.php/questions/edit/' . $each->id; ?>'">
                <td><?= $each->id ?>
                <td><?= $each->text ?>
                <td><?= $each->complexity ?>
                <td><?= anchor('index.php/questions/delete/' . $each->id, 'delete', array('class' => 'crud_links'));?>
            </tr>
            <? endforeach ?>
        </tbody>
    </table>

    <?= form_submit(array('class' => 'buttons', 'value' => 'Save test', 'class' => 'buttons')); ?>
    <input type="button" class="buttons" value="Add question" onclick="document.location='<?= base_url() . 'index.php/questions/add?test_id=' . $id ?>'" />
    <input type="button" class="buttons" value="Back to list" onclick="document.location='<?= base_url() . 'index.php/tests/' ?>'" />
    
<?= form_close() ?>
<h1 class="page_title">Edit question <?= $id ?></h1>
<?php echo validation_errors(); ?>
<?= form_open('/index.php/groups/edit/'. $id) ?>

    <p class="form_labels">Group name: </p>
    <?= form_input(array('name' => 'name', 'value' => $name, 'class' => 'input_fields')); ?>

    <br />
    
    <p class="form_labels">Users in the group:</p>
    
    <table align="center" width="100%" border="1" class="tables">
        <thead>
            <tr>
                <td>Id
                <td>Name
                <td>Email
                <td>Delete
            </tr>
        </thead>
        <tbody>
            <? foreach($users as $each): ?>
            <tr>
                <td><?= $each['id'] ?>
                <td><?= $each['name'] ?>
                <td><?= $each['email'] ?>
                <td>
                    <?=anchor('index.php/users/show_for_admin/'.$each['id'],'show results',array('class' => 'crud_links')) ?> |
                    <?=anchor('index.php/users/delete/' . $each['id'],'delete',array('class' => 'crud_links'));?>
            </tr>
            <? endforeach ?>
        </tbody>
    </table>
<?= form_submit(array('value' => 'Save group', 'class' => 'buttons')) ?>
<?= form_close() ?>

<h1></h1>
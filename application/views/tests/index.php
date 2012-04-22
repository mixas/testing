<h1 class="page_title">Test list</h1>
<table align="center" width="100%" border="1" class="tables">
    <tr>
        <td><h2>Id</h2>
        <td><h2>Title</h2>
        <td><h2>Description</h2>
        <td><h2>Delete</h2><tr>
        
<?php
$list = $this->mdl_test->getlist();
$size = count($list);?>
<?foreach ($list as $each):?>
    <tr onclick="window.location = '<?= base_url() . 'index.php/tests/edit/' . $each['id']; ?>'">
    <td> <?=$each['id'];?>
    <td> <?=anchor('index.php/tests/show/' . $each['id'], $each['title']);?>
    <td> <?=$each['description'];?>
    <td> <?=anchor('index.php/tests/delete/' . $each['id'],'delete',array('class' => 'crud_links'));?>
<?endforeach?>
</table>
<?= anchor('/index.php/tests/add', 'Add test', array('class' => 'buttons')) ?>
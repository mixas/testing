<h1 class="page_title">User list</h1>
<table align="center" width="100%" border="1" class="tables">
    <tr>
        <td><h2>Id</h2>
        <td><h2>Name</h2>
        <td><h2>Email</h2>
        <td><h2>Group</h2>
        <td><h2>Delete</h2><tr>
<?php 
$list = $this->mdl_user->getlist();
$size = count($list);
$CI = &get_instance();
?>
<?foreach ($list as $each):?>
    <tr>
    <td> <?=$each['id'];?>
    <td> <?=anchor('index.php/users/show/'.$each['id'], $each['name']);?>
    <td> <?=$each['email'];?>
    <td> <?=anchor('index.php/groups/show/'.$each['group_id'], 'group ' . $each['group_id']);?>
        
    <td>    <?=anchor('index.php/users/show/'.$each['id'],'show',array('class' => 'crud_links')) ?> |
            <?=anchor('index.php/users/edit/'.$each['id'],'edit',array('class' => 'crud_links')) ?> |
            <?=anchor('index.php/users/delete/' . $each['id'],'delete',array('class' => 'crud_links'));?>
<?endforeach?>
</table>
<?= anchor('/index.php/users/add', 'Add user', array('class' => 'buttons')) ?>
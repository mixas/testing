<h1 class="page_title">groups list</h1>
<table align="center" width="100%" border="1" class="tables">
    <tr class="table_headers">
        <td>Id
        <td width="81%">Group Name
        <td>Delete
<?php 
$list = $this->mdl_group->getlist();
$size = count($list);?>
<?foreach ($list as $each):?>
    <tr>
    <td> <?=$each['id'];?>
    <td> <?=$each['name'];?>
    <td>    
            <?=anchor('index.php/groups/edit/'.$each['id'],'edit', array('class' => 'crud_links')) ?> |
            <?=anchor('index.php/groups/delete/' . $each['id'],'delete', array('class' => 'crud_links'));?>
<?endforeach?>
</table>
<?= anchor('/index.php/groups/add', 'Add group', array('class' => 'buttons')) ?>
<h1 class="page_title">Questions list</h1>
<table align="center" width="100%" border="1" class="tables">
    <tr class="table_headers">
        <td>Id
        <td width="81%">Text
        <td>Delete
<?php 
$list = $this->mdl_question->getlist();
$size = count($list);?>
<?foreach ($list as $each):?>
    <tr>
    <td> <?=$each['id'];?>
    <td> <?=$each['text'];?>
    <td>    
            <?=anchor('index.php/questions/edit/'.$each['id'],'edit',array('class' => 'crud_links')) ?> |
            <?=anchor('index.php/questions/delete/' . $each['id'],'delete',array('class' => 'crud_links'));?>
<?endforeach?>
</table>
<?= anchor('/index.php/questions/add', 'Add question', array('class' => 'buttons')) ?>
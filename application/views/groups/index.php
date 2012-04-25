<h1 class="page_title">groups list</h1>
<table align="center" width="100%" border="1" class="tables">
    <thead>
        <tr class="table_headers">
            <td>Id
            <td width="81%">Group Name
            <td>Delete
        </tr>
    </thead>
    <?php 
    $list = $this->mdl_group->getlist();
    $size = count($list);?>
    <tbody>
        <?foreach ($list as $each):?>
            <tr onclick="document.location='<?= base_url() . 'index.php/groups/edit/' . $each['id']?>'">
            <td> <?=$each['id'];?>
            <td> <?=$each['name'];?>
            <td> <?=anchor('index.php/groups/delete/' . $each['id'],'delete', array('class' => 'crud_links'));?>
        <?endforeach?>
    </tbody>
</table>
<input type="button" class="buttons" value="Add group" onclick="document.location='<?= base_url() . 'index.php/groups/add' ?>'" />
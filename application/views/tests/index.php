<h1 class="page_title">Test list</h1>
<table align="center" width="100%" border="1" class="tables">
    <thead>
        <tr>
            <td>Id
            <td>Title
            <td>Description
            <td>Delete
        </tr>
    </thead>
    <tbody>
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
    </tbody>
</table>
<input type="button" class="buttons" value="Add test" onclick="document.location='<?= base_url() . 'index.php/tests/add' ?>'" />
<?
/**
 * show all tests and links to results about every test
 */
?>

<h1 class="page_title">Tests results</h1>
<table align="center" width="100%" border="1" class="tables">
    <thead>
        <tr>
            <td>Id
            <td>Title
            <td>Description
        </tr>
    </thead>
    <tbody>    
        <?php
        $list = $this->mdl_test->getlist();
        $size = count($list);?>
        <?foreach ($list as $each):?>
            <tr onclick="window.location = '<?= base_url() . 'index.php/tests/show_results/' . $each['id']; ?>'">
            <td> <?=$each['id'];?>
            <td> <?=$each['title'];?>
            <td> <?=$each['description'];?>
        <?endforeach?>
    </tbody>
</table>
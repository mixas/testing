<h1 class="page_title">����������</h1><br />

<table align="center" width="100%" border="0" id="test_table">

<?php
    $CI =& get_instance();
    $CI->load->model('mdl_test');
    $list = $CI->mdl_test->getlist();
    $size = count($list);
    $i = 0;
?>

<? if($CI->auth_lib->logged_in()):?>

<?foreach ($list as $each):?>
    <? $i++; ?>
    <tr class="test" onclick="window.location = '<?= base_url() . 'index.php/tests/show/' . $each['id']; ?>'">
        <td> <?= img(array('src' => 'images/start.png', 'style' => 'width: 100px')); ?>
        <td class="tests_item" style="padding-top: 35px;"> <?= $each['title']; ?>
        <td class="tests_item" style="padding-top: 35px;"> <?= $each['description']; ?>
        <? if ($each['image']): ?>
            <td> <?= img('images/' . $each['image']); ?>
        <? endif ?>
    </tr>
<?endforeach?>

<?else:?>
<div class="content_text">
    <?=anchor('index.php/users/add', '�������������')?>, ��� <?=anchor('index.php/auth/login', '������')?> � ������� �� �������� ������ ��� ����������� ����������.
</div>
<div class="content_text">
    Objective Testing - �� ������ ����� ��� ����������� ����������. 
    � ��� ������� �� ��������� ������ ���������� ��� � ���������. ��������� ���������� �� ���������� ���� 
    � ���� ������������� ��������� � ������� �����, ���� ���� �� ������ ������� ���������� ����� �������� 
    � ��������� �������� ����������. ��� ������� �������������� � ������ �� ������ ���� ��� �����������. ϳ��� ������ �� 
    �� ������� �� �������� ��������� ����������� �� ������ �� 0 �� 100 ����. ̳�������� ���������� ������� � 55 ����.
</div>
<?endif?>

</table>
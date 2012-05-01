<h1 class="page_title">Тестування</h1><br />

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
    <?=anchor('index.php/users/add', 'Зареєструйтесь')?>, або <?=anchor('index.php/auth/login', 'зайдіть')?> у систему під існуючим логіном для проходження тестування.
</div>
<div class="content_text">
    Objective Testing - це онлайн сервіс для проходження тестування. 
    У нас існують як класичний варіант тестування так і адаптиіний. Адаптивне тестування на сьогоднішній день 
    є дуже перспективним напрямком у контролі знань, адже воно має велику точність вимірювання знань порівняно 
    з класичним варіантом тестування. Вам потрібно авторизоватись у системі та обрати тест для проходження. Після відповіді на 
    всі питання ви отримаєте результат проходження за шкалою від 0 до 100 балів. Мінімальною задовільною оцінкою є 55 балів.
</div>
<?endif?>

</table>
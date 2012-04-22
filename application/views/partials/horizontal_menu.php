<ul>
    <li><? echo anchor(base_url(),'MAIN') ?></li>
    <li><? echo anchor(base_url().'index.php/pages/about','ABOUN') ?></li>
    <li><? echo anchor(base_url().'index.php/pages/contact','CONTACT') ?></li>
    
    <? if ($id): ?>
        <li><? echo anchor(base_url().'index.php/auth/logout','SIGN OUT') ?></li>
    <? else: ?>
        <li><? echo anchor(base_url().'index.php/users/add','SIGN UP') ?></li>
        <li><? echo anchor(base_url().'index.php/auth/login','SIGN IN') ?></li>
    <? endif ?>
    
    <? if ($role == 3): ?>
        <span id="admin_menu">
            <li><? echo anchor(base_url().'index.php/users/index','USER LIST') ?></li>
            <li><? echo anchor(base_url().'index.php/users/add','ADD USER') ?></li>
        </span>
    <? endif ?>
</ul>
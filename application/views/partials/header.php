<? $user = $this->auth_lib->get_userdata(); ?>
<? 
    $data['user_id'] = $this->session->userdata('user_id');
    $data['user_role'] = $this->session->userdata('user_role');
?>

<div id="top_strip">
    <?= img('images/home_01.jpg'); ?>
</div>

<div id="white_block">
	
    <div id="white_block_content">
        
        <div id="logo_block">
            
            <div id="logo">
            </div>
            
            <div id="site_name">
                Objective <font color="#b52303">Testing</font>
            </div>
    	</div>
        
            <?
                $url = $_SERVER['REQUEST_URI'];
                if($url == "/index.php"){
                    $testing = "hover";
                }
                elseif($url == "/testing/index.php/pages/about"){
                    $about = "hover";
                }
                elseif($url == "/testing/index.php/pages/contact"){
                    $contact = "hover";
                }
            ?>
        
            <ul  id="horizontal_menu">
                <li><? echo anchor(base_url(),'Testing') ?></li>
                <li><? echo anchor(base_url().'index.php/pages/about','About') ?></li>
                <li><? echo anchor(base_url().'index.php/pages/contact','Contact') ?></li>
                
                <? if ($data['user_id']): ?>
                    <li><? echo anchor(base_url().'index.php/auth/logout','sign out',array('id' => 'sign_out_button')) ?></li>
                <? else: ?>
                    <li><? echo anchor(base_url().'index.php/auth/login','Sign in') ?></li>                
                    <li><? echo anchor(base_url().'index.php/users/add','Sign up') ?></li>                    
                <? endif ?>
                
                <? if ($data['user_role'] == 3): ?>
                    <li><a href="#">Admin menu</a>
                        <ul id="admin_menu">
                            <li><? echo anchor(base_url().'index.php/tests/index', 'Tests managment') ?></li>
                            <li><? echo anchor(base_url().'index.php/users/index', 'Users managment') ?></li>
                            <li><? echo anchor(base_url().'index.php/groups/index', 'Groups managment') ?></li>
                            <li><? echo anchor(base_url().'index.php/tests/show_tests_tesults', 'View results') ?></li>
                            
                        </ul>
                    </li>
                <? endif ?>
            </ul>
     </div>
</div>

<div id="header_area">
    <?= img('images/home_07.jpg'); ?>
    <div id="main_text">
    	
    </div>
</div>

<div id="post_header">

</div>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<? $user = $this->auth_lib->get_userdata(); ?>
<? 
    $data['user_id'] = $this->session->userdata('user_id');
    $data['user_role'] = $this->session->userdata('user_role');
?>

<html>
<head>
<script type="text/javascript" src="<?=base_url()?>scripts/jquery.js"></script>
<script type="text/javascript" src="<?=base_url()?>scripts/decorate.js"></script>
<script src="<?=base_url()?>scripts/dinamic_clock.js"></script>

<title>Online testing | <?  echo isset($header)?$header:'' ?></title>
<?= link_tag('stylesheet/reset.css'); ?>
<?= link_tag('stylesheet/mainstyle.css'); ?>
<?= link_tag('stylesheet/forms.css'); ?>
<?= link_tag('stylesheet/menues.css'); ?>
</head>
<body>
    <div id="container">
        
        <div id="header">
            <? $this->load->view('partials/header', $data); ?>
        </div>
        
        <div id="content">
            
            <div id="left" class="content_block">
                <? $this->load->view($page); ?>
            </div>
            
            <div id="right" class="content_block">
                <? $this->load->view('partials/right'); ?>
            </div>
            
            <div id="clear"></div>
                        
            <div id="footer" class="content_block">
                copyright 2012 (c)
            </div>
            
        </div>   
    
    </div>
</body>
<script type="text/javascript">
    decorate();
</script>
</html>

    <div id="debug_information" style="text-align: center;">
        <hr />
        <h1>information:</h1>
        <h1>user id: <?= $data['user_id'] ?></h1>
        <h1>user role: <?= $data['user_role'] ?></h1>
        <h1>current question number: <?= $this->session->userdata('current_question_number')?> </h1>
        <h1>current testing session id: <?= $this->session->userdata('testing_id')?> </h1>
        <h1>current test id: <?= $this->session->userdata('current_test')?> </h1>
        <h1>right answers: <?= $this->session->userdata('right_answers')?> </h1>
        <h1>user level: <?= $this->session->userdata('user_level')?> </h1>
        <h1>passed questions array:<pre> <?= print_r($this->session->userdata('passed_questions')); ?> </pre></h1>
        <h1>POST: <? print_r($_POST)?></h1>
        <h1>GET: <? print_r($_GET)?></h1>
        <hr />
    </div>
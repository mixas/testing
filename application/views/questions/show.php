<h1 class="page_title">Question <?= $this->session->userdata('current_question_number') ?></h1>
<?= form_open('/index.php/tests/go') ?>
<p class="question_text"><?= $text ?></p>

<? foreach($answers as $answer): ?>
<? $data = array(
    'name' => 'answer',
    'class' => 'radio_answers',
    'value' => $answer['id'],
    'checked' => false
    );
?>
<?= form_radio($data); ?>
<?= $answer['text']; ?></br>
<?endforeach?>

<?= form_submit(array('name' => 'submit_data', 'class' => 'buttons', 'value' => 'Give answer')); ?>
<?= form_close(); ?>

<script>
    get_time();
    var timerMulti = window.setInterval("get_time();", 1000);
</script>

<div id="clock">time left:
    <span id="clock_face" style="color: #F00;>
        <b id="clock_value"></b>
    </span>
</div>
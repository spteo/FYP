<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1 align='center'>Vote an Answer</h1>

<div class="row">
    <?php
        $message = $this->Session->flash();
    if($message !=''){
        ?> 
    <div align="center">
    <span class="success alert secondary round radius label"><font size="4" color="black"><?php echo $message; ?></font></span></div>
    <?php }
    ?>
</div>
<div class='row'>
    <fieldset>
        <legend>The Question</legend>
        <?php echo $question[0]['Question']['question_body']; ?>
    </fieldset>
    <br>
    <fieldset>
        <legend>Your Preferred Answer</legend>
        <?php
        echo $this->Form->create('Question');
        $options = array('a' => 'Answer A: ' . $question[0]['Question']['answer_a'], 'b' => 'Answer B: ' . $question[0]['Question']['answer_b'], 'c' => 'Answer C: ' . $question[0]['Question']['answer_c'], 'd' => 'Answer D: I do not understand this question.');
        $attributes = array('legend' => false);
        echo $this->Form->radio('VotedAnswer', $options, array('legend' => false, 'separator' => '<br>', 'style' => 'background:#FFF'));
        echo $this->Form->input('id', array('type' => 'hidden', 'value' => $question[0]['Question']['question_id']));
        ?>
    </fieldset>
</div>
<br>
<div class='row'>
    <ul class="button-group" width='100%'>
        <?php
        echo $this->Form->button('Vote Now!', array('controller' => 'challenges', 'action' => 'vote'), array('class' => 'button alert', 'width' => '33%'));
        echo $this->Html->link('Cancel', array('controller' => 'challenges', 'action' => 'vote_answer'), array('class' => 'button', 'width' => '33%'));
        echo $this->Form->end();
        ?>
    </ul>
</div>
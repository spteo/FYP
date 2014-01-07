<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1 align='center'>Suggest A Question</h1>
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

<br>
<?php
echo $this->Form->create('Question');
?>
<?php echo $this->Form->input('raised_by', array('type' => 'hidden', 'value' => $login_id)); ?>

<div class="row">
    <fieldset>
        <?php echo $this->Form->input('question_body', array('label' => 'Your Question')); ?>
        <br>
        <div class="row collapse">
            <div class="large-2 columns">
                <span class="prefix radius">Option A</span>
            </div>
            <div class="large-10 columns">
                <span>
                    <?php echo $this->Form->input('answer_a', array('label' => FALSE)); ?>
                </span>
            </div>
        </div>
        <div class="row collapse">
            <div class="large-2 columns">
                <span class="prefix radius">Option B</span>
            </div>
            <div class="large-10 columns">
                <span>
                    <?php echo $this->Form->input('answer_b', array('label' => FALSE)); ?>
                </span>
            </div>
        </div>
        <div class="row collapse">
            <div class="large-2 columns">
                <span class="prefix radius">Option C</span>
            </div>
            <div class="large-10 columns">
                <span>
                    <?php echo $this->Form->input('answer_c', array('label' => FALSE)); ?>
                </span>
            </div>
        </div>
    </fieldset>
</div>
<br>
<div class="row collapse" algin='right'>

    <ul class="button-group" width='100%'>
            <?php
            echo $this->Form->button('Suggest Now!', array('challenges' => 'suggest'), array('class' => 'button alert', 'width' => '33%', 'align' => 'right'));
            echo $this->Form->end();
            ?>
    </ul>

</div>

<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1 align="center"> Build Your Classroom </h1>
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
        <legend>Classroom Title</legend>
        <?php
        echo $this->Form->create('Classroom', array('controller'=>'classrooms','action' => 'process_create_classroom'));
        echo $this->Form->input('title', array('type' => 'text', 'id' => 'title', 'label' => '','placeholder'=>'Give a title to your classroom'));
        ?>
        <br>
        Note: Give a name to your classroom i.e classroom is talking about soccer. Then title will be soccer.
        <br>
    </fieldset>
</div>
<br>
<div class='row' align='right'>
    <ul class="button-group" width='100%'>
        <?php
        echo $this->Form->input('category', array('type' => 'hidden', 'value' => $category));
        echo $this->Form->input('created_by', array('type' => 'hidden', 'value' => $login_id));
        echo '<li>' . $this->Form->button('Create', array('class' => 'button', 'width' => '33%')) . '</li>';
        echo $this->Html->link('Back', array('controller' => 'classrooms', 'action' => 'classroom_category'),array('class' => 'button', 'width' => '33%'));
        echo $this->Form->end();
        ?>
    </ul>
</div>

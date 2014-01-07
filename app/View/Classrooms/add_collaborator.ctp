<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1 align='center'><?php echo $title; ?></h1>

<div class='row'>
<table width='100%'>
    <thead>
    <th  colspan='2'>Collaborative Editors</th>
    </thead>
<tbody>   
<?php
    foreach ($collaborator as $temp){
        echo '<tr>';
        echo '<td width=\'30%\'>';
        echo $this->Html->image('profileImg/'.$temp.'.jpg');
        echo '</td>';
        echo '<td align=\'center\'>';
        echo $this->Html->link($temp, array('controller'=>'profiles','action'=>'viewProfile',$temp));
        echo '</td>';
        echo '</tr>';
    }
?>

</tbody>
</table>
</div>
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
<?php
    echo $this->Form->create('ClassroomCollaborator', array('url'=>array('controller'=>'Classrooms', 'action'=>'process_add_collaborator', NULL)));
    echo $this->Form->input('collaborator', array('type'=>'text', 'label'=>'Collaborator'));
    echo $this->Form->input('classroom_id', array('type'=>'hidden', 'value'=>$classroom_id));
    echo $this->Form->button('Add', array('name'=>'add', 'value'=>'yes'));
    echo $this->Form->button('Cancel', array('name'=>'cancel', 'value'=>'yes'));
    echo $this->Form->end();
?>

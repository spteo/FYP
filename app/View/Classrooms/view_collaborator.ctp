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

<div class='row'>
<?php 
    echo $this->Html->link('Add New Collaborator', array('controller'=>'classrooms','action'=>'add_collaborator', $classroom_id), array('class' => 'button'));
    //echo '&nbsp';
    echo $this->Html->link('Back', array('action'=>'little_classroom'), array('class' => 'button'));
?>    
</div>
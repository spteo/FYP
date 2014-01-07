<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1 align="center" >Little Classroom</h1>

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
<!--My Classroom-->

<div class='row'>
    <?php echo $this->Html->link('Create New Classroom', array('controller' => 'classrooms', 'action' => 'classroom_category'), array('class' => 'button')); ?>

</div>
    <div class='row' style='border-width: 2px; border-style: solid; border-color: black; '>
        <h1 align='center'><font size='6'>My Classroom</font></h1>
        <table width='100%'>
            <thead>
            <th width="60%">Classroom</th>
            <th>Action</th>
            </thead>
            <tbody>
                <?php
                if (empty($my_classroom)) {
                    echo '<td colspan="2">';
                    echo 'You do not own any classroom yet.';
                    echo '</td>';
                } else {
                    foreach ($my_classroom as $classroom):
                        echo '<tr>';
                        echo '<td>';
                        echo $classroom['classrooms']['title'];
                        echo '</td>';
                        echo '<td>';
                        echo $this->Html->link('Edit', array('controller' => 'classrooms', 'action' => 'edit', $classroom['classrooms']['classroom_id']), array('style' => 'background:#00CC00','class' => 'button'));
                        echo '&nbsp;';
                        echo $this->Html->link('Delete', array('controller' => 'classrooms', 'action' => 'delete', $classroom['classrooms']['classroom_id']), array('style' => 'background:#CC0000','class' => 'button'));
                        echo '&nbsp';
                        echo $this->Html->link('View Editors', array('controller' => 'classrooms', 'action' => 'view_collaborator', $classroom['classrooms']['classroom_id']), array('class' => 'button'));
                        echo '</td>';
                        echo '</tr>';
                    endforeach;
                }
                ?>

            </tbody>
        </table>
    </div>
    <br>
    <div class='row' style='border-width: 2px; border-style: solid; border-color: black;'>
        <!-- Other Available Classroom -->
        
        <h1 align='center'><font size='6'>My Collaborative Classroom</font></h1>
        <table width='100%'>
            <thead>
            <th width="60%">Classroom</th>
            <th>Action</th>
            </thead>
            <tbody>
                <?php
                if (empty($other_classroom)) {
                    echo '<td colspan="2">';
                    echo 'There does not have any other classroom yet.';
                    echo '</td>';
                } else {
                    foreach ($other_classroom as $classroom):
                        echo '<tr>';
                        echo '<td>';
                        echo $classroom['classrooms']['title'];
                        echo '</td>';
                        echo '<td>';
                        echo $this->Html->link('Edit', array('controller' => 'classrooms', 'action' => 'edit', $classroom['classrooms']['classroom_id']), array('style' => 'background:#00CC00','class' => 'button'));
                        echo '&nbsp;';
                        echo $this->Html->link('Delete', array('controller' => 'classrooms', 'action' => 'delete', $classroom['classrooms']['classroom_id']), array('style' => 'background:#CC0000','class' => 'button'));
                        echo '</td>';
                        echo '</tr>';
                    endforeach;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
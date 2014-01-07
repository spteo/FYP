<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1 align='center'><?php echo $title; ?></h1>
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

<div><?php
        //pr($content);die();
    if(count($content)!=4){
        for($i=(count($content));$i<=4;$i++){
            array_push($content,'');
        }
    }
?></div>
<?php
    echo $this->Form->create('Content', array('url'=>array('controller'=>'Classrooms', 'action'=>'process_save_edited_classroom')));
?>
<br>
<p>
    Introduction
</p>
<?php
    $introContent = $content[0];
    echo $this->Form->input('intro', array('type' => 'textarea', 'default'=>$content[0],'label' => false, 'placeholder' => 'Write Your Introduction Here'));
?>
<p>
    Paragraph 1
</p>
<?php
    $p1Content = $content[1];
    echo $this->Form->input('p1', array('type' => 'textarea', 'default'=>$content[1],'label' => false, 'placeholder' => 'Write Your Content for Paragraph 1 Here'));
?>    
<p>
    Paragraph 2
</p>
<?php
    $p2Content = $content[2];
    echo $this->Form->input('p2', array('type' => 'textarea', 'default'=>$content[2],'label' => false, 'placeholder' => 'Write Your Content for Paragraph 2 Here'));
?>
<p>
    Paragraph 3
</p>
<?php
    $p3Content = $content[3];
    echo $this->Form->input('p3', array('type' => 'textarea', 'default'=>$content[3],'label' => false, 'placeholder' => 'Write Your Content for Paragraph 3 Here'));
?>
<p>
    Conclusion
</p>
<?php
    $p4Content = $content[4];
    echo $this->Form->input('conclusion', array('type' => 'textarea', 'default'=>$content[4],'label' => false, 'placeholder' => 'Write Your Content for Conclusion Here'));
?>
<?php
    echo $this->Form->input('classroom_id', array('type'=>'hidden', 'value'=>$classroom_id));
    echo $this->Form->input('version_number', array('type'=>'hidden', 'value'=>$version+1));
    echo $this->Form->button('Save', array('name'=>'save', 'value'=>'yes'));
    if($published === '0'){
      echo $this->Form->button('Save & Publish', array('name'=>'publish', 'value'=>'yes'));  
    }
    echo $this->Html->link('Cancel', array('controller' => 'classrooms', 'action' => 'little_classroom'), array('class' => 'button', 'width' => '33%'));
    //echo $this->Html->link('Cancel', array(),array('name'=>'back', 'value'=>'yes','class'=>'button'));
    echo $this->Form->end();
?>
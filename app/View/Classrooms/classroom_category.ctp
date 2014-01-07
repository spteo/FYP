<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1 align="center" >Choose Your Category</h1>
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
    <ul class="small-block-grid-3">
  <li><?php echo $this->Html->image('categoryImg/english.jpg', array('url'=>array('action'=>'classroom_title', 'English')));?></li>
  <li><?php echo $this->Html->image('categoryImg/maths.jpg', array('url'=>array('action'=>'classroom_title', 'Maths')));?></li>
  <li><?php echo $this->Html->image('categoryImg/science.jpg', array('url'=>array('action'=>'classroom_title', 'Science')));?></li>
  <li><?php echo $this->Html->image('categoryImg/geography.jpg', array('url'=>array('action'=>'classroom_title', 'Geography')));?></li>
  <li><?php echo $this->Html->image('categoryImg/fashion.jpg', array('url'=>array('action'=>'classroom_title', 'Fashion')));?></li>
  <li><?php echo $this->Html->image('categoryImg/games.jpg', array('url'=>array('action'=>'classroom_title', 'Games')));?></li>
  <li><?php echo $this->Html->image('categoryImg/sports.jpg', array('url'=>array('action'=>'classroom_title', 'Sports')));?></li>
</ul>
</div>

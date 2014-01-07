<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of choose_challenge_type
 *
 * @author Zee
 */
?>
<h1 align="center" >Choose Challenge Type</h1>
<div class="row">
  <div class="large-6 columns" align='center'>
      <?php echo $this->Html->image("challengeImg/Individual.jpg", array('url' => array('controller' => 'challenges', 'action' => 'choose_difficulty')));?>
  </div>
  <div class="large-6 columns" align='center'>
      <?php echo $this->Html->image("challengeImg/collaborative.jpg", array('url' => array('controller' => 'challenges', 'action' => 'many_to_many')));?>
  </div>
</div>
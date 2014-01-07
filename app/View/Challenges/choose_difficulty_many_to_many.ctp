<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<h1 align="center" >Knowledge Challenge</h1>
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
<table width="100%">
     <tr><td align="center"><?php echo $this->Html->image('challengeImg/easy.jpg', array('url' => '/challenges/choose_target_many_to_many/easy'));?></td><td align="center"><h1 style="font-size:35px">5 Users</h1></td></tr>
    <tr><td align="center"><?php echo $this->Html->image('challengeImg/medium.jpg', array('url' => '/challenges/choose_target_many_to_many/medium'));?><td align="center"><h1 style="font-size:35px">10 Users</h1></td></tr>
    <tr><td align="center"><?php echo $this->Html->image('challengeImg/hard.jpg', array('url' => '/challenges/choose_target_many_to_many/hard'));?></td><td align="center"><h1 style="font-size:35px">15 Users</h1></td></tr>
</table>
</div>
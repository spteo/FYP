<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1 align='center'>The <?php echo $categoryType ?> Desk</h1>
<div class='row'>
    <?php echo $this->Html->link('Back', array('controller' => 'desks', 'action' => 'little_desk'), array('class' => 'button')); ?>

</div>
<div class="row">
    <?php
    $message = $this->Session->flash();
    if ($message != '') {
        ?> 
        <div align="center">
            <span class="success alert secondary round radius label"><font size="4" color="black"><?php echo $message; ?></font></span></div>
    <?php }
    ?>
</div>
<div class="row">
    <fieldset>
        <legend>Post a Question</legend>
        <?php
        echo $this->Form->create('NewDeskQuestion', array('url' => array('controller' => 'desks', 'action' => 'process_add_new_thread', $categoryType)));
        echo $this->Form->textarea('newQuestion', array('placeholder' => 'What\'s your question?', 'label' => false));
        echo $this->Form->input('askedBy', array('type' => 'hidden', 'value' => $this->Session->read('User.username')));
        echo $this->Form->button('Ask Now!', array('controller' => 'profiles', 'action' => 'process_add_new_thread', $categoryType), array('class' => 'button', 'align' => 'right', 'width' => '33%'));
        echo $this->Form->end();
        ?>
    </fieldset>
</div>
<div class="row">
    <h1 align='center'><font size='6'>All <?php echo $categoryType ?> Questions</font></h1>
    <?php if (empty($allQuestions)) { ?>
        <fieldset style='border-width: 2px; border-style: solid; border-color: black; background-color: #FFFFCC'>
            <div align='center'>There are no questions yet! Be the first one to ask! </div>
        </fieldset>
    <?php
    }
    foreach ($allQuestions as $temp) {
        $title = $temp['desk_questions']['qns_content'];
        $questionId = $temp['desk_questions']['qns_id'];
        $askedBy = $temp['desk_questions']['asked_by'];
        $askTime = $temp['desk_questions']['timestamp'];
        //pr($askTime);die();
        $lastUpdatedTime='';
        foreach($allResponse as $tempResponse){
            $responseQnsId = $tempResponse['desk_questions_replies']['qns_id'];
            if($responseQnsId==$questionId){
                $lastUpdatedTime=$tempResponse['desk_questions_replies']['timestamp'];
            }
        }
        ?>
        <fieldset style='border-width: 2px; border-style: solid; border-color: black; background-color: #FFFFCC'>
            <font size='4' color='#FF6633'><u><?php echo $this->Html->link($askedBy, array('controller' => 'profiles', 'action' => 'viewProfile', $askedBy), array('style' => 'color:#000000')); ?></u> has a Little Question...</font>
            <br>
            <br>
            <div align='center'>
                <fieldset style='border-width: 2px; border-style: solid; border-color: black;'>
    <u><?php echo $this->Html->link($title, array('controller' => 'desks', 'action' => 'viewQuestion', $questionId), array('style' => 'color:#000000')) ?></u>
                </fieldset>
            </div>
            <br>
            <br>
            <div align='right'>
                <!-- Add Condition Loop here. If no last updated. display posted on else display last updated -->
                <div align='left'><font size='4' color='#3366FF'><?php if(empty($lastUpdatedTime)){echo 'Posted on: '.$askTime;}else{ echo 'Last Updated On: '.$lastUpdatedTime;}; ?></font></div>
                &nbsp;&nbsp;
                 <font size='4' color='#CC0066'>(Number) Answers </font>
                &nbsp;&nbsp;
                 <font size='4' color='#FF6633'>(Number) Likes </font>
            </div>
        </fieldset>
    <?php }
    ?>
</div>  
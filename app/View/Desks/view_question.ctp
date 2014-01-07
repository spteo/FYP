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
$qnsId = $foundQnsArray[0]['desk_questions']['qns_id'];
$qnsAskedBy = $foundQnsArray[0]['desk_questions']['asked_by'];
$qnsPostedTime = $foundQnsArray[0]['desk_questions']['timestamp'];
$qns = $foundQnsArray[0]['desk_questions']['qns_content'];
$qnsCategory = $foundQnsArray[0]['desk_questions']['category'];
?>
<h1 align='center'>The <?php echo $qnsCategory ?> Desk</h1>
<div class='row'>
    <?php echo $this->Html->link('Back', array('controller' => 'desks', 'action' => 'category_questions', $qnsCategory), array('class' => 'button')); ?>
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
    <fieldset style='border-width: 2px; border-style: solid; border-color: black; background-color: #B0E0E6'>
        <font size='4' color='#FF6633'><u><?php echo $this->Html->link($qnsAskedBy, array('controller' => 'profiles', 'action' => 'viewProfile', $qnsAskedBy), array('style' => 'color:#000000')); ?></u> asked a Little Question...</font>
        <br>
        <br>
        <div align='center'>
            <fieldset style='border-width: 2px; border-style: solid; border-color: black;'>
                <?php echo $qns; ?>
            </fieldset>
        </div>
        <br>
        <br>
        <div align='right'>
            <!-- Add Condition Loop here. If no last updated. display posted on else display last updated -->
            <div align='left'><font size='4' color='#3366FF'>Posted on: <?php echo $qnsPostedTime ?></font></div>
            <u><?php echo $this->Html->link('Like', array('controller' => 'profiles', 'action' => 'viewProfile', $qnsAskedBy), array('style' => 'color:#FF6633')); ?></u>
        </div>
    </fieldset>
</div>
<div class="row">
    <fieldset>
        <legend>Your Answer</legend>
        <?php
        echo $this->Form->create('NewDeskReply', array('url' => array('controller' => 'desks', 'action' => 'process_add_new_reply', $qnsId)));
        echo $this->Form->textarea('newReply', array('placeholder' => 'Your answer here...', 'label' => false));
        echo $this->Form->input('repliedBy', array('type' => 'hidden', 'value' => $this->Session->read('User.username')));
        echo $this->Form->button('Reply!', array('controller' => 'desks', 'action' => 'process_add_new_reply', $qnsId), array('class' => 'button', 'align' => 'right', 'width' => '33%'));
        echo $this->Form->end();
        ?>
    </fieldset>
</div>
<div class="row">
    
        <?php if (empty($qnsReplies)) { ?>
            <fieldset style='border-width: 0px; border-style: solid; border-color: black; background-color: #D3D3D3'>
            <div align='center'>There are no answers yet! Be the first one to help! </div>
            </fieldset>
            <?php
        }
        foreach ($qnsReplies as $temp) {
            $qnsReplyId = $temp['desk_questions_replies']['qns_id'];
            $answeredBy = $temp['desk_questions_replies']['replied_by'];
            $replyContent = $temp['desk_questions_replies']['reply_content'];
            $answeredTime = $temp['desk_questions_replies']['timestamp'];
            ?>
            <fieldset align='left' style='border-width: 2px; border-style: solid; border-color: black; background-color: #D0D0D0'>
                <font size='4' color='#FF6633'><u><?php echo $this->Html->link($answeredBy, array('controller' => 'profiles', 'action' => 'viewProfile', $answeredBy), array('style' => 'color:#000000')); ?></u> has replied...</font>
                <br>
                <br>
                <div align='left'>
                    <fieldset style='border-width: 1px; border-style: solid; border-color: black;'>
                        <?php echo $replyContent; ?>
                    </fieldset>
                </div>
                <br>
                <br>
                <div align='right'>
                    <!-- Add Condition Loop here. If no last updated. display posted on else display last updated -->
                    <div align='left'><font size='4' color='#3366FF'>Posted on: <?php echo $answeredTime ?></font></div>
                    <u><?php echo $this->Html->link('Like', array('controller' => 'profiles', 'action' => 'viewProfile', $qnsAskedBy), array('style' => 'color:#FF6633')); ?></u>
                </div>
            </fieldset>
        <?php }
        ?>
</div>   

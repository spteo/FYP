<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1 align='center'>Forming Collaborative Challenge</h1>

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
<p></p>
<div class ='row'>

    <ul class="button-group" width='100%'>
        <?php
        echo $this->Html->link('Start New Challenge', array('controller' => 'challenges', 'action' => 'choose_difficulty_many_to_many'), array('class' => 'button', 'width' => '33%'));
        ?>

    </ul>
    <p></p>
</div>
<div class ='row'>
    <fieldset>
        <legend>Form Class Challenge</legend>
        <table width='100%'>
            <thead>
            <th width="60%">Challenge Title</th>
            <th width="20%">Action</th>
            <th width="20%">Remarks</th>
            </thead>
            <tbody>
                <?php
                $classCount = 0;
                if (empty($class)) {
                    echo '<td colspan="3">';
                    echo 'You do not have class challenge need to be formed.';
                    echo '</td>';
                } else {
                    foreach ($class as $temp):
                        $formed_by = $temp['form_challenges']['formed_by'];
                        $formed_by_array = explode(';', $formed_by);
                        $has_formed = false;
                        $login_id = $this->Session->read('User.id');
                        
                        //Count how many users have formed the challenge
                        $sizeOfArray = count($formed_by_array);
                        
                        //Check how many users required
                        $requiredNumUser = '';
                        $challengeDiff = $temp['form_challenges']['difficulty_level'];
                        if($challengeDiff=='easy'){
                            $requiredNumUser=5;
                        }elseif($challengeDiff=='medium'){
                            $requiredNumUser=10;
                        }else{
                            $requiredNumUser=15;
                        }
                        
                        $userNeeded = $requiredNumUser-$sizeOfArray;
                        foreach ($formed_by_array as $temp_id) {
                            if ($temp_id === $login_id) {
                                $has_formed = true;
                                break;
                            }
                        }

                        echo '<tr>';
                        echo '<td width="60%">';
                        echo $temp['form_challenges']['challenge_title'];
                        echo '</td>';
                        echo '<td width="20%" align=\'center\'>';

                        if ($has_formed) {
                            echo "Formed";
                        } else {
                            //echo $this->Html->link('Start New Challenge', array('controller' => 'challenges', 'action' => 'add_many_to_many', $temp['form_challenges']['id']), array('style' => 'background:#00CC00', 'class' => 'custom buttony'));
                            echo $this->Html->link('Form Challenge', array('action' => 'add_many_to_many', $temp['form_challenges']['id']), array('style' => 'background:#00CC00', 'class' => 'button alert'));
                        }
                        echo '</td>';
                        echo '<td width="20%">';
                        if($userNeeded==0){
                            echo 'No more collaborators required!';
                        } else {
                            echo $userNeeded.' more collaborators required!';
                        }
                        echo '</td>';
                        $classCount++;
                        echo '</tr>';
                    endforeach;
                }
                ?>
            </tbody>
        </table>
    </fieldset>
</div>
<br>
<div class='row'>
    <fieldset>
        <legend>Form School Challenge</legend>
        <table width='100%'>
            <thead>
            <th width="60%">Challenge Title</th>
            <th width="20%">Action</th>
            <th width="20%">Remarks</th>
            </thead>
            <tbody>
                <?php
                $schoolCount = 0;
                if (empty($school)) {
                    echo '<td colspan="3">';
                    echo 'You do not have school challenge need to be formed.';
                    echo '</td>';
                } else {
                    foreach ($school as $temp):
                        $formed_by = $temp['form_challenges']['formed_by'];
                        $formed_by_array = explode(';', $formed_by);
                        $has_formed = false;
                        $login_id = $this->Session->read('User.id');
                        
                        //Count how many users have formed the challenge
                        $sizeOfArray = count($formed_by_array);
                        
                        //Check how many users required
                        $requiredNumUser = '';
                        $challengeDiff = $temp['form_challenges']['difficulty_level'];
                        if($challengeDiff=='easy'){
                            $requiredNumUser=5;
                        }elseif($challengeDiff=='medium'){
                            $requiredNumUser=10;
                        }else{
                            $requiredNumUser=15;
                        }
                        
                        $userNeeded = $requiredNumUser-$sizeOfArray;
                        
                        foreach ($formed_by_array as $temp_id) {
                            if ($temp_id === $login_id) {
                                $has_formed = true;
                                break;
                            }
                        }

                        echo '<tr>';
                        echo '<td width="60%">';
                        echo $temp['form_challenges']['challenge_title'];
                        echo '</td>';
                        echo '<td width="20%" align=\'center\'>';

                        if ($has_formed) {
                            echo "Formed";
                        } else {
                            //echo $this->Html->link('Form Challenge', array('action' => 'add_many_to_many', $temp['form_challenges']['id']), array('style' => 'background:#00CC00', 'class' => 'custom buttony'));
                            echo $this->Html->link('Form Challenge', array('action' => 'add_many_to_many', $temp['form_challenges']['id']), array('style' => 'background:#00CC00', 'class' => 'button'));
                        }

                        //echo $this->Html->link('Accept Challenge', array('action' => 'accept_challenge', $challenge['Challenge']['challenge_id']), array('style' => 'background:#00CC00', 'class' => 'custom buttony'));
                        echo '</td>';
                        //echo $this->Html->link('Reject Challenge', array('action' => 'reject_challenge', $challenge['Challenge']['challenge_id']), array('style' => 'background:#CC0000', 'class' => 'custom buttony'));
                        //echo '<a style="background:#CC0000" class="custom buttony" href="#">Reject Challenge</a></td>';
                        
                        echo '<td width="20%">';
                        if($userNeeded==0){
                            echo 'No more collaborators required!';
                        } else {
                            echo $userNeeded.' more collaborators required!';
                        }
                        echo '</td>';
                        $schoolCount++;
                        echo '</tr>';
                    endforeach;
                }
                ?>
            </tbody>
        </table>
    </fieldset>
</div>
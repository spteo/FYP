<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1 align="center"> Building Your Challenge </h1>
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

    <fieldset>
        <legend>Challenge Title</legend>
        <?php
        echo $this->Form->create('Challenge', array('action' => 'send_challenge_many_to_many'));
        $default_title = $title;
        $default = $username;
        echo $this->Form->input('challenge_title', array('type' => 'text', 'default' => $default_title, 'id' => 'title', 'label' => ''));
        ?>
    </fieldset>
    <br>
    <fieldset>
        <legend>Choose Your Opponent</legend>
        <?php
        //input in the username to choose opponent
        echo $this->Form->input('username', array('type' => 'text', 'default' => $default, 'id' => 'username', 'label' => ''));
        ?>
        <p>Note: 
        <li>
            Enter Username of the person to send individual challenge i.e Michael
        </li>
        <li>
            Enter class name to send class challenge i.e P5-A
        </li>
        <li>
            Enter school name to send school challenge. i.e LittleLives Team 1
        </li>
        </p>
    </fieldset>
</div>
<br>
<div class='row'>
    <?php
    $questions_id = '';
    try {
        if (!empty($chosen_questions)) {
            ?>
            <fieldset>
                <legend>Selected Questions List</legend>
                <table width='100%'>
                    <tr>
                    <thead>
                    <th>Selected Questions</th>
                    <th>Answer A</th>
                    <th>Answer B</th>
                    <th>Answer C</th>
                    <th>Action</th></tr>
                    </thead>
                    <?php
                    foreach ($chosen_questions as $temp):
                        $questions_id = $questions_id . $temp['Question']['question_id'] . ';';
                    endforeach;
                    $questions_id = substr($questions_id, 0, -1);

                    foreach ($chosen_questions as $temp):
                        echo '<tr><td>' . $temp['Question']['question_body'] . '</td>';
                        echo '<td>' . $temp['Question']['answer_a'] . '</td>';
                        echo '<td>' . $temp['Question']['answer_b'] . '</td>';
                        echo '<td>' . $temp['Question']['answer_c'] . '</td>';
                        if (empty($username)) {
                            $username = 'NULL';
                        }
                        echo '<td>' . $this->Html->link('Remove', array('action' => 'choose_target_many_to_many', $difficulty, $questions_id, $temp['Question']['question_id'], $username, $title)) . '</td></tr>';
                    endforeach;
                }
            } catch (Exception $e) {
                
            }
            ?>
        </table>
    </fieldset>
</div>
<br>
<div class='row'>
    <ul class="button-group" width='100%'>
        <?php
        echo $this->Form->input('difficulty', array('type' => 'hidden', 'value' => $difficulty));
        echo $this->Form->input('questions', array('type' => 'hidden', 'value' => $questions_id));
        echo '<li>' . $this->Form->button('Select Questions', array('name' => 'add', 'value' => 'yes'), array('class' => 'button alert', 'width' => '33%')) . '</li>';
        echo '<li>' . $this->Form->button('Form Challenge', array('name' => 'send', 'value' => 'yes', array('class' => 'button alert', 'width' => '33%'))) . '</li>';
        echo $this->Html->link("Back", array('controller' => 'challenges', 'action' => 'choose_difficulty_many_to_many'), array('class' => 'button', 'width' => '34%'));
        echo $this->Form->end();
        ?>
    </ul>
</div>
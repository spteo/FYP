<head>
<?php echo $this->Html->script('autocomplete/select2.js'); ?>
<script>
    $(document).ready(function() {
        $("#e1").select2();
    });
</script>
</head>
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
    <br>
    <fieldset>
        <legend>Challenge Title</legend>
        <?php
        echo $this->Form->create('Challenge', array('action' => 'send_challenge'));
        $default_title = $title;
        $default = $username;
        echo $this->Form->input('challenge_title', array('type' => 'text', 'default' => $default_title, 'id' => 'title', 'label' => ''));
        ?>
    </fieldset>
    <br>
    <fieldset>
        <legend>Choose Your Opponent</legend>
        <?php
        echo $this->Form->create('Challenge', array('action' => 'send_challenge'));
        $default = $username;
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

    <br>
</div>
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
                        echo '<td>' . $this->Html->link('Remove', array('action' => 'choose_target', $difficulty, $questions_id, $temp['Question']['question_id'], $username, $title)) . '</td></tr>';
                    endforeach;
                }
            } catch (Exception $e) {
                
            }
            ?>
        </table>
    </fieldset>
</div>
<br>
<div class='row' align='right'>
    <ul class="button-group" width='100%'>
        <?php
        echo $this->Form->input('difficulty', array('type' => 'hidden', 'value' => $difficulty));
        echo $this->Form->input('questions', array('type' => 'hidden', 'value' => $questions_id));
        echo '<li>' . $this->Form->button('Select Questions', array('name' => 'add', 'value' => 'yes'), array('class' => 'button alert', 'width' => '33%')) . '</li>';
        echo '<li>' . $this->Form->button('Send Challenge', array('name' => 'send', 'value' => 'yes', array('class' => 'button alert', 'width' => '33%'))) . '</li>';
        echo $this->Html->link('Back', array('controller' => 'challenges', 'action' => 'choose_difficulty'), array('class' => 'button', 'width' => '33%'));
        echo $this->Form->end();
        ?>
    </ul>
</div>
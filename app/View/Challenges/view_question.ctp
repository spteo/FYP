<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1 align="center" >Accept Challenge</h1>
<div class="row">
    <div class="large-2 columns">
        <p>
            Challenge Difficulty Level
            <br> 
            <?php
            if ($info['difficulty'] == 'easy') {
                echo $this->Html->image('challengeImg/easy.jpg', array('height' => '10px', 'width' => '200px'));
            } elseif ($info['difficulty'] == 'medium') {
                echo $this->Html->image('challengeImg/medium.jpg', array('width' => '200px'));
            } else {
                echo $this->Html->image('challengeImg/hard.jpg', array('width' => '200px'));
            }
            ?>
        </p>

        <!-- Question Progress display -->
        <p>Question Attempted: &nbsp&nbsp <?php echo $info['current'] . '&nbsp&nbsp/&nbsp&nbsp' . $info['required']; ?></p>
    </div>
    <div class="large-10 columns">
        <fieldset>
            <legend>Your Questions</legend>

            <!-- Options display -->
            <p>
                <?php
                if ($info['current'] + 1 != $info['required']) {
                    echo $this->Form->create('Challenge', array('url' => '/challenges/view_question/' . $info['challenge_id'] . '/' . $info['questions'] . '/' . $info['difficulty'] . '/' . $info['required'] . '/' . ($info['current'] + 1) . '/' . $info['answers']));
                } else {
                    echo $this->Form->create('Challenge', array('url' => '/challenges/challenge_result/' . $info['challenge_id'] . '/' . $info['difficulty'] . '/' . $info['questions'] . '/' . $info['answers']));
                }
                ?>
                <br>
                <?php
                $options = array('a' => 'Answer: ' . $question[0]['Question']['answer_a'], 'b' => 'Answer: ' . $question[0]['Question']['answer_b'], 'c' => 'Answer: ' . $question[0]['Question']['answer_c']);
                ?>
            <table width='100%'>
                <th  colspan="2">
                    <?php
                    echo 'Question Number ' . ($info['current'] + 1) . ' : ' . $question[0]['Question']['question_body'];
                    ?>
                </th>
            </table>
            <p>
                <?php
                //echo 'Question Number ' . ($info['current'] + 1) . ' : ' . $question[0]['Question']['question_body'];
                echo $this->Form->radio('selected_answer', $options, array('legend' => false, 'separator' => '<br>', 'style' => 'background:#FFF'));
                ?>
            </p>
            <div align='right'>
                <ul class="button-group" width='100%'>
                    <?php
                    $option1 = array(
                        'label' => 'Next',
                        'class' => 'button',
                    );
                    $option2 = array(
                        'label' => 'Finish',
                        'class' => 'button',
                    );
                    if ($info['current'] + 1 != $info['required']) {
                        echo $this->Form->end($option1);
                    } else {
                        echo $this->Form->end($option2);
                    }
                    ?>
                </ul>
                </div>
        </fieldset>
    </div>
</div>




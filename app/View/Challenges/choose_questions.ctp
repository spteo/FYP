<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1 align='center'>My Questions Bank</h1>
<div class='row'>
    <div align="center">
    <?php
    $count = 0;
    $chosen_qns = explode(';', $chosen_qns);
    if (empty($questions)) {
        echo '<h2><font color="black">Please suggest a question first!</font></h2>';
    } else {
        ?> </div>
        <table width='100%'>
            <thead>
            <th>Available Questions</th>
            <th>Option A</th>
            <th>Option B</th>
            <th>Option C</th>
            <th>Choose?</th>

            </thead>
            <?php
            foreach ($questions as $question):
                ?>

                <tr>
                    <?php echo $this->Form->create('Challenge', array('action' => 'choose_questions/' . $difficulty . '/NULL/' . $username . '/' . $title)); ?>
                    <td><?php echo $question['Question']['question_body'] ?>
                    <td><?php echo $question['Question']['answer_a'] ?>
                    <td><?php echo $question['Question']['answer_b'] ?>
                    <td><?php echo $question['Question']['answer_c'] ?>
                        <?php
                        $checked = false;
                        $qn_id = $question['Question']['question_id'];
                        foreach ($chosen_qns as $temp):
                            if ($temp === $qn_id) {
                                $checked = true;
                                break;
                            }
                        endforeach;
                        ?>

                    <td><?php
                if ($checked) {
                    echo $this->form->checkbox($count, array('checked' => 'checked'));
                } else {
                    echo $this->form->checkbox($count);
                }
                        ?></td>
                </tr>

                <?php
                $count++;
            endforeach
            ?>
        </table>
    <?php }; ?>
</div>
<div class='row'>
    <ul class="button-group" width='100%'>
        <?php
//echo $this->Form->end();
        echo $this->Form->button('Add to Challenge', array('controller' => 'send_challenge'), array('class' => 'button alert', 'width' => '33%'));
        echo $this->Html->link('Back', array('controller' => 'challenges', 'action' => 'choose_difficulty'), array('class' => 'button', 'width' => '33%'));
        ?>
    </ul>
</div>
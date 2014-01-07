<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1 align='center'>Choose Your Question</h1>
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
    <table width='100%'>
        <thead>
        <th>Available Questions</th>
        <th>Option A</th>
        <th>Option B</th>
        <th>Option C</th>
        <th>Choose?</th>

        </thead>
        <?php
        $count = 0;
        $chosen_qns = explode(';', $chosen_qns);
        foreach ($questions as $question):
            ?>
            <tr>
                <?php echo $this->Form->create('Challenge', array('action' => 'add_many_to_many/' . $challenge_id)); ?>
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
</div>
<div class='row'>
    <ul class="button-group" width='100%'>
        <?php
//echo $this->Form->end();
        echo $this->Form->button('Form Challenge', array('controller' => 'challenge'), array('class' => 'button alert', 'width' => '33%'));
        echo $this->Html->link("Back", array('controller' => 'challenges', 'action' => 'many_to_many'), array('class' => 'button', 'width' => '34%'));
        ?>
    </ul>
</div>
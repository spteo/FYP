<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1 align="center" >Vote an Answer</h1>

<div class='row'>
<fieldset>
<table width='100%'>
    <thead>
        <th>Question</th>
        <th>Response A</th>
        <th>Response B</th>
        <th>Response C</th>
        <th>Response D</th>
        <th>Actions</th>
    </thead>
    <?php foreach ($question_for_vote as $qn): ?>
        <tr>
            <td><?php echo $qn['questions']['question_body'] ?></td>
            <td><?php echo $qn['questions']['answer_a'] ?></td>
            <td><?php echo $qn['questions']['answer_b'] ?></td>
            <td><?php echo $qn['questions']['answer_c'] ?></td>
            <td>I don't understand this question.</td>
            <td>
                <?php
                $voted = $this->requestAction(array('controller' => 'challenges', 'action' => 'voted', $qn['questions']['question_id']));
                if (!$voted) {
                    echo $this->Html->link('Vote', array('controller' => 'challenges', 'action' => 'vote', $qn['questions']['question_id']), array('style' => 'background:#00CC00','class' => 'button', 'width' => '50%'));
                } else {
                    echo 'Voted';
                }
                ?>
            </td>
        </tr>

    <?php endforeach; ?>

</table>
</fieldset>
</div>
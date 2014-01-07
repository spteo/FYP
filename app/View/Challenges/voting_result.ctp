<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1 align='center'>Voting Results</h1>
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
<div class="row">
<fieldset>
    <legend> Voted Question </legend>
    <?php echo $question; ?>
</fieldset>
   </div>
<br>
<div class="row">
<fieldset>
    <legend> Total Responses </legend>
    <table width="100%">
        <thead>
        <th>

        </th>
        <th>
            Answers
        </th>
        <th>
            Percentage
        </th>
        </thead>
        <tbody>
            <tr>
                <td>
                    Answer A
                </td>
                <td>
                    <?php echo $answersArray[0]['questions']['answer_a']; ?>
                </td>
                <td>
                    <?php echo $result['a']; ?>%
                </td>
            </tr>
            <tr>
                <td>
                    Answer B
                </td>
                <td>
                    <?php echo $answersArray[0]['questions']['answer_b']; ?>
                </td>
                <td>
                    <?php echo $result['b']; ?>%
                </td>
            </tr>
            <tr>
                <td>
                    Answer C
                </td>
                <td>
                    <?php echo $answersArray[0]['questions']['answer_c']; ?>
                </td>
                <td>
                    <?php echo $result['c']; ?>%
                </td>
            </tr>
            <tr>
                <td>
                    Answer D
                </td>
                <td>
                    <?php echo 'I do not understand this question.'; ?>
                </td>
                <td>
                    <?php echo $result['d']; ?>%
                </td>
            </tr>
        </tbody>
    </table>
</fieldset>
    </div>
<br>
<div class="row">
<ul class="button-group" width='100%'>
    <?php
    
    echo $this->Html->link('Back', array('controller' => 'challenges', 'action' => 'vote_answer'), array('class' => 'button', 'width' => '33%'));
    //echo $this->Html->link("Back", array('action' => 'view_questions_for_voting'), array('class' => 'button alert', 'width' => '34%'));
    ?>
</ul>
    </div>
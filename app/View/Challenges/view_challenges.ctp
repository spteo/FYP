<h1 align="center" >Knowledge Challenge Arena</h1>

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
<br>
<!--individual Challenge-->
<?php $individualCount = 0 ?>
<div class='row'>
    <fieldset>
        <br>     
        <h3 align='center'>Your Challenge</h3>
        <br>
        <table width='100%'>
            <thead>
            <th width="70%">Challenge Title</th>
            <th>Action</th>
            </thead>
            <tbody>
                <?php
                if (empty($individual)) {
                    echo '<td colspan="2">';
                    echo 'You do not have individual challenge yet.';
                    echo '</td>';
                } else {
                    foreach ($individual as $challenge):
                        echo '<tr>';
                        echo '<td>';
                        echo $challenge['Challenge']['challenge_title'];
                        echo '</td>';
                        echo '<td width="30%">';
                        echo $this->Html->link("Accept", array('action' => 'accept_challenge', $challenge['Challenge']['challenge_id']), array('style' => 'background:#00CC00', 'class' => 'button alert', 'width' => '50%'));
                        echo '&nbsp;&nbsp;';
                        echo $this->Html->link('Reject', array('controller' => 'challenges', 'action' => 'reject_challenge', $challenge['Challenge']['challenge_id']), array('style' => 'background:#CC0000', 'class' => 'button', 'width' => '50%'));
                        $individualCount++;
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
        <br>     
        <h3 align='center'>Your Class Challenge</h3>
        <br>
        <!-- Class Challenge -->
        <?php $classCount = 0 ?>
        <table width='100%'>
            <thead>
            <th width="70%">Challenge Title</th>
            <th>Action</th>
            </thead>
            <tbody>
                <?php
                if (empty($class)) {
                    echo '<td colspan="2">';
                    echo 'You do not have class challenge yet.';
                    echo '</td>';
                } else {
                    foreach ($class as $challenge):
                        echo '<tr>';
                        echo '<td>';
                        echo $challenge['Challenge']['challenge_title'];
                        echo '</td>';
                        echo '<td width="30%">';
                        echo $this->Html->link("Accept", array('action' => 'accept_challenge', $challenge['Challenge']['challenge_id']), array('style' => 'background:#00CC00', 'class' => 'button alert', 'width' => '50%'));
                        echo '&nbsp;&nbsp;';
                        echo $this->Html->link('Reject', array('controller' => 'challenges', 'action' => 'reject_challenge', $challenge['Challenge']['challenge_id']), array('style' => 'background:#CC0000', 'class' => 'button', 'width' => '50%'));
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
    <!-- School Challenge-->
    <fieldset>
        <br>     
        <h3 align='center'>Your School Challenge</h3>
        <br>
        <?php $schoolCount = 0 ?>
        <table width='100%'>
            <thead>
            <th width="70%">Challenge Title</th>
            <th>Action</th>
            </thead>
            <tbody>
                <tr>
                    <?php
                    if (empty($school)) {
                        echo '<td colspan="2">';
                        echo 'You do not have school challenge yet.';
                        echo '</td>';
                    } else {
                        foreach ($school as $challenge):
                            echo '<tr>';
                            echo '<td>';
                            echo $challenge['Challenge']['challenge_title'];
                            echo '</td>';
                            echo '<td width="30%">';
                            echo $this->Html->link("Accept", array('action' => 'accept_challenge', $challenge['Challenge']['challenge_id']), array('style' => 'background:#00CC00', 'class' => 'button alert', 'width' => '50%'));
                            echo '&nbsp;&nbsp;';
                            echo $this->Html->link('Reject', array('controller' => 'challenges', 'action' => 'reject_challenge', $challenge['Challenge']['challenge_id']), array('style' => 'background:#CC0000', 'class' => 'button', 'width' => '50%'));
                            $schoolCount++;
                            echo '</tr>';
                        endforeach;
                    }
                    ?>
                </tr>
            </tbody>
        </table>
    </fieldset>
</div>

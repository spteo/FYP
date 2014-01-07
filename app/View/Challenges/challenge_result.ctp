<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1 align="center" >Your Challenge Result</h1>
<div class='row'>
    <p align='center'>
        <?php
        $countValues = array_count_values($correct_wrong);
        $total = count($correct_wrong);
        if($countValues['Correct!!']==$total){
            echo $this->Html->image('challengeImg/wonchallenge.jpg',array('width'=>'70%','height'=>'80%'));
        } else {
            echo $this->Html->image('challengeImg/lostchallenge.jpg',array('width'=>'70%','height'=>'80%'));
        };
        ?>
    </p>
</div>
<div class="row">
    <div class="medium-3 columns">
        <p>
            Challenge Difficulty Level
            <br> 
            <?php
            if ($difficulty == 'easy') {
                echo $this->Html->image('challengeImg/easy.jpg', array('width' => '200px'));
            } elseif ($difficulty == 'medium') {
                echo $this->Html->image('challengeImg/medium.jpg', array('width' => '200px'));
            } else {
                echo $this->Html->image('challengeImg/hard.jpg', array('width' => '200px'));
            }
            ?>
        </p>
    </div>
    <div class="medium-9 columns">
        <fieldset>
            <legend>Your Result</legend>
            <table border='2' width='100%'>
                <thead>
                <th>S/N</th>
                <th>Questions</th>
                <th>Status</th>
                </thead>
                <?php
                $count = 0;
                foreach ($body as $temp) {
                    ?>
                    <tr>
                        <td width='5%'>
                            <?php echo $count + 1 ?>
                        </td>
                        <td width='80%'>
                            <?php echo $temp ?>
                        </td>
                        <td width='15%'>
                            <?php
                            if ($correct_wrong[$count] == 'Wrong!!') {
                                echo $this->Html->image('challengeImg/Wrong.JPG', array('width' => '100%', 'height' => '100%', 'align' => 'center'));
                            } else {
                                echo $this->Html->image('challengeImg/Correct.JPG', array('width' => '100%', 'height' => '100%', 'align' => 'center'));
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                    $count++;
                }
                ?>
            </table>
        </fieldset>
    </div>
</div>
<br>
<div class='row'>
    <p align='right'>
<?php echo $this->Html->link('Another Challenge?', array('controller' => 'challenges', 'action' => 'view_challenges'), array('align' => 'right', 'class' => 'button')); ?>
<?php echo $this->Html->link('Home', array('controller' => 'challenges', 'action' => 'scoreboard'), array('align' => 'right', 'class' => 'button')); ?>
    </p>
</div>
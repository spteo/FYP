<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1 align="center" >Knowledge Challenge</h1>

<div class="row">
    <?php
    $message = $this->Session->flash();
    if ($message != '') {
        ?> 
        <div align="center">
            <span class="success alert secondary round radius label"><font size="4" color="black"><?php echo $message; ?></font></span></div>
    <?php }
    ?>
</div>
<div class='row'>
    <div class="small-6 large-5 columns">
        <fieldset>
            <legend>Leading Schools</legend>
            <table width="100%">
                <thead>
                <th colspan="2">School Scoreboard</th>
                </thead>
                <tbody>
                    <tr>
                        <td width='50%'>School</td>
                        <td width='50%'>Points</td>
                    <tr>
                        <?php foreach ($school as $temp): ?>
                        <tr>
                            <td><?php echo $temp['schools']['school_name']; ?>
                            <td><?php echo $temp['schools']['score'] ?>
                        </tr>

                    <?php endforeach ?>
                    </tr>
                </tbody>
            </table>
        </fieldset>
        <br>
        <fieldset>
            <legend>Leading Class</legend>
            <table width="100%">
                <thead>
                <th colspan="3">Class Scoreboard</th>
                </thead>
                <tbody>
                    <tr>
                        <td width='33%'>Class</td>
                        <td width='33%'>School</td>
                        <td width='34%'>Points</td>
                    </tr>
                    <tr>
                        <?php foreach ($class as $temp): ?>
                        <tr>
                            <td><?php echo $temp['classes']['class_name']; ?>
                            <td><?php echo $temp['schools']['school_name']; ?>  
                            <td><?php echo $temp['classes']['score'] ?>
                        </tr>

                    <?php endforeach ?>
                    </tr>
                </tbody>
            </table>
        </fieldset>
        <br>
        <fieldset>
            <legend>Leading Individuals</legend>
            <table width="100%">
                <thead>
                <th colspan="4">Individual Scoreboard</th>
                </thead>
                <tbody>
                    <tr>
                        <td width='25%'>Username</td>
                        <td width='25%'>Class</td>
                        <td width='25%'>School</td>
                        <td width='25%'>Points</td>
                    </tr>
                    <?php foreach ($user as $temp): ?>
                        <tr>
                            <td><?php echo $temp['users']['username']; ?>
                            <td><?php echo $temp['classes']['class_name'] ?>
                            <td><?php echo $temp['schools']['school_name']; ?>
                            <td><?php echo $temp['users']['score'] ?>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </fieldset>
    </div>
    <div class="small-6 large-7 columns">
        <fieldset>
            <legend>Challenge Arena</legend>
        </fieldset>
    </div>
</div>

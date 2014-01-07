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
<h1 align='center'>My Challenges Status</h1>

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
<div class="row">
    <div class="large-6 columns">
        <fieldset>
            <legend>Challenges to Others</legend>
            <table width='100%'>
                <thead>
                <th width="40%">Challenge Title</th>
                <th width="20%">Target</th>
                <th width="20%">Challenge Difficulty</th>
                <th width="20%">Status</th>
                </thead>
                <tbody>
                    <?php
                    if (empty($challengesToOthers)) {
                        echo '<td colspan="4">';
                        echo 'You do not have any outstanding challenges.';
                        echo '</td>';
                    } else {
                        //pr($challengesToOthers);die();
                        $count = 0;
                        foreach ($challengesToOthers as $myChallenge) {

                            echo '<tr>';
                            //display challenge title
                            echo '<td>';
                            echo $challengesToOthers[$count]['challenges']['challenge_title'];
                            echo '</td>';
                            //display target user
                            echo '<td>';
                            $targetUser = $challengesToOthers[$count]['challenges']['to_individual'];
                            $targetClass = $challengesToOthers[$count]['challenges']['to_class'];
                            $targetSchool = $challengesToOthers[$count]['challenges']['to_school'];
                            //do a check condition for Individual, class, school
                            //loop through each array to find the corresponding name;
                            //display the name
                            if (!empty($targetUser)) {
                                foreach ($allUsers as $temp) {
                                    $tempUserId = $temp['users']['id'];
                                    if ($tempUserId == $targetUser) {
                                        echo $temp['users']['username'];
                                    }
                                }
                            } elseif (!empty($targetClass)) {
                                foreach ($allClasses as $temp) {
                                    //pr($temp);die();
                                    $tempClassId = $temp['classes']['class_id'];
                                    if ($tempClassId == $targetClass) {
                                        echo $temp['classes']['class_name'];
                                    }
                                }
                            } else {
                                foreach ($allSchools as $temp) {
                                    //pr($temp);die();
                                    $tempSchId = $temp['schools']['school_id'];
                                    if ($tempSchId == $targetSchool) {
                                        echo $temp['schools']['school_name'];
                                    }
                                }
                            }

                            echo '</td>';
                            //display difficulty level of the challenge
                            echo '<td>';
                            echo $challengesToOthers[$count]['challenges']['difficulty_level'];
                            echo '</td>';
                            //display status of the challenge
                            echo '<td>';
                            $challengeStatus = $challengesToOthers[$count]['challenges']['challenge_status'];
                            if ($challengeStatus == '') {
                                echo 'Pending';
                            } else {
                                if ($challengeStatus == 'win') {
                                    echo 'Challenge Lost';
                                } else {
                                    echo 'Challenge Won';
                                }
                            }
                            echo '</td>';
                            echo '</tr>';
                            $count++;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </fieldset>
    </div>
    <div class="large-6 columns">
        <fieldset>
            <legend>Challenges to Me</legend>
            <table width='100%'>
                <thead>
                <th width="80%">Challenge Title</th>
                <th>Challenge Type</th>
                <th>Challenge Difficulty</th>
                <th>Status</th>
                </thead>
                <tbody>
                    <?php
                    $counter = 0;
                    if (!empty($school)) {
                        echo '<td colspan="3">';
                        echo 'You do not have any outstanding challenges.';
                        echo '</td>';
                    } else {
                        foreach($challengesToMe as $temp){
                            //Challenge Title
                            //pr($temp);die();
                            $tempTitle = $temp['challenges']['challenge_title'];
                            //Challenge Type
                            $tempType='';
                            $tempInd = $temp['challenges']['to_individual'];
                            $tempClass = $temp['challenges']['to_class'];
                            $tempSchool = $temp['challenges']['to_school'];
                            if(!empty($tempInd)){
                                $tempType='Individual';
                            }elseif(!empty($tempClass)){
                                $tempType='Class';
                            }else{
                                $tempType='School';
                            }
                            //Challenge Difficulty
                            $tempDiff = $temp['challenges']['difficulty_level'];
                            
                            //Challenge Status
                            $tempStatus = $temp['challenges']['challenge_status'];
                            if(empty($tempStatus)){
                                $tempStatus = 'Pending';
                            }
                            
                            echo '<tr>';
                            echo '<td>';
                            echo $tempTitle;
                            echo '</td>';
                            echo '<td>';
                            echo $tempType;
                            echo '</td>';
                            echo '<td>';
                            echo $tempDiff;
                            echo '</td>';
                            echo '<td>';
                            echo $tempStatus;
                            echo '</td>';
                            echo '</tr>';
                            $counter++;
                        }
                        
                        foreach($classChallengesToMe as $temp){
                            //Challenge Title
                            //pr($temp);die();
                            $tempTitle = $temp['challenges']['challenge_title'];
                            //Challenge Type
                            $tempType='';
                            $tempInd = $temp['challenges']['to_individual'];
                            $tempClass = $temp['challenges']['to_class'];
                            $tempSchool = $temp['challenges']['to_school'];
                            if(!empty($tempInd)){
                                $tempType='Individual';
                            }elseif(!empty($tempClass)){
                                $tempType='Class';
                            }else{
                                $tempType='School';
                            }
                            //Challenge Difficulty
                            $tempDiff = $temp['challenges']['difficulty_level'];
                            
                            //Challenge Status
                            $tempStatus = $temp['challenges']['challenge_status'];
                            if(empty($tempStatus)){
                                $tempStatus = 'Pending';
                            }
                            
                            echo '<tr>';
                            echo '<td>';
                            echo $tempTitle;
                            echo '</td>';
                            echo '<td>';
                            echo $tempType;
                            echo '</td>';
                            echo '<td>';
                            echo $tempDiff;
                            echo '</td>';
                            echo '<td>';
                            echo $tempStatus;
                            echo '</td>';
                            echo '</tr>';
                            $counter++;
                        }
                        
                        foreach($schoolChallengesToMe as $temp){
                            //Challenge Title
                            //pr($temp);die();
                            $tempTitle = $temp['challenges']['challenge_title'];
                            //Challenge Type
                            $tempType='';
                            $tempInd = $temp['challenges']['to_individual'];
                            $tempClass = $temp['challenges']['to_class'];
                            $tempSchool = $temp['challenges']['to_school'];
                            if(!empty($tempInd)){
                                $tempType='Individual';
                            }elseif(!empty($tempClass)){
                                $tempType='Class';
                            }else{
                                $tempType='School';
                            }
                            //Challenge Difficulty
                            $tempDiff = $temp['challenges']['difficulty_level'];
                            
                            //Challenge Status
                            $tempStatus = $temp['challenges']['challenge_status'];
                            if(empty($tempStatus)){
                                $tempStatus = 'Pending';
                            }
                            
                            echo '<tr>';
                            echo '<td>';
                            echo $tempTitle;
                            echo '</td>';
                            echo '<td>';
                            echo $tempType;
                            echo '</td>';
                            echo '<td>';
                            echo $tempDiff;
                            echo '</td>';
                            echo '<td>';
                            echo $tempStatus;
                            echo '</td>';
                            echo '</tr>';
                            $counter++;
                        }
                        //echo '<td>';
                        //echo $challengesToOthers[$count]['challenges']['difficulty_level'];
                        //echo '</td>';
                        //pr('individual');
                        //pr($challengesToMe);
                        //pr('class');
                        //pr($classChallengesToMe);
                        //pr('school');
                        //pr($schoolChallengesToMe);
                        //die();
                    }
                    ?>
                </tbody>
            </table>
        </fieldset>
    </div>
</div>
<br>

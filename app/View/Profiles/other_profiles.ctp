<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
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
    <table width="100%" border='0' class='search-box'>
        <tr>
            <?php
            echo $this->Form->create('SearchFriends', array('url' => array('controller' => 'profiles', 'action' => 'findFriends')));
            ?> <th width ="70%"><?php
                echo $this->Form->input('enterFriends', array('placeholder' => 'Enter a username...', 'label' => 'Search User'));
                ?> 
            </th><th width="30%">
                <?php
                $userName = $this->Session->read('User.username');
                echo $this->Form->button('Search', array('controller' => 'profiles', 'action' => 'findFriends'), array('class' => 'button', 'align' => 'right', 'width' => '33%'));
                echo $this->Form->end();
                ?>
            </th>
        </tr>
    </table>
</div>
<div class="row">
    <div class="large-12" align="center">
        <div class="profile-cover">
            <?php echo $this->Html->image('profileCover/defaultCover.jpg'); ?>
        </div>
    </div>
</div>
<div class='row'>
    <div class ="large-3 columns">
        <div class="row">
            <br>
            <div class="large-5 columns">
                <?php echo $this->Html->image('profileImg/' . $username . '.jpg', array('height' => '100%', 'width' => '100%'), array('url' => array('controller' => 'recipes', 'action' => 'view'))); ?>
            </div>
            <div class="large-7 columns">
                <?php
                echo $this->Html->link($username, array('controller' => 'profiles', 'action' => 'viewProfile', $username));
                ?>
                <br>
                Level: <?php
                echo $userArray[0]['users']['rank'];
                ?>
                Points: <?php echo $userArray[0]['users']['score']; ?>
                <br>
                <br>
                <?php 
                    $isFriend = false;
                    $currentUserId = $this->Session->read('User.id');
                    foreach($allMyFriends as $tempFriend){
                        $tempFriendId = $tempFriend['friends']['friend_id'];
                        if($tempFriendId == $currentUserId){
                            $isFriend = true;
                            break;
                        }
                    }
                ?>
               <?php 
                    if($isFriend){
                        echo $this->Html->link(' Delete Friend', array('controller'=>'profiles','action'=>'deleteFriend', $username),array('class'=>'fi-x-circle','label'=>false));
                    }else{
                        echo $this->Html->link(' Add Friend',array('controller'=>'profiles','action'=>'addFriend', $username),array('class'=>'fi-plus','label'=>FALSE));
                    }?>
            </div>
        </div>
        <div class="row">
            <ul class="side-nav">
                <label class="fi-like"><b> My Interests</b></label>
                <li><a href="#">Basketball</a></li>
                <li><a href="#">Soccer</a></li>
                <li class="divider"></li>
                <label class="fi-torsos-all"><b> Groups</b></label>
                <li><a href="#">Science Project Group</a></li>
                <li><a href="#">Math Project Group</a></li>
                <li class="divider"></li>
                <label class="fi-results-demographics"><b> My Friends</b></label>
                <li><a href="#">My Buddies</a></li>
                <li><a href="#">My Schoolmates</a></li>
                <li><a href="#">My Classmates</a></li>
                <li class="divider"></li>
            </ul>
        </div>


    </div>

    <div class ="large-9 columns">
        <div class="myPost">
            <fieldset>
                <legend>Write on <?php echo $username?>'s Wall</legend>
                <?php
                echo $this->Form->create('NewWallPost', array('url' => array('controller' => 'profiles', 'action' => 'addNewsFeed')));
                echo $this->Form->textarea('newPost', array('placeholder' => 'Say Something...', 'label' => false));
                echo $this->Form->input('wallOwner', array('type' => 'hidden','value'=>$username));
                echo $this->Form->input('location', array('type' => 'hidden','value'=>2));
                echo $this->Form->button('Post', array('controller' => 'profiles', 'action' => 'addNewsFeed'), array('class' => 'button', 'align' => 'right', 'width' => '33%'));
                echo $this->Form->end();
                ?>
            </fieldset>
        </div>
        <div class="friendsUpdates" width='100%'>
            <dl class="tabs" data-tab width='100%'>
                <dd class="active"><a href="#panel2-1"><?php echo $username?>'s Wall</a></dd>
                <dd><a href="#panel2-2"><?php echo $username?>'s Activities</a></dd>
                <dd><a href="#panel2-3"><?php echo $username?>'s Connections</a></dd>
            </dl>
            <div class="tabs-content" width='100%'>
                <div class="content active" id="panel2-1" width='100%'>

                        <h1 align='center'><font size='6'><?php echo $username?>'s Wall</font></h1>
                        <?php
                        if(empty($notificationArray)){
                            echo 'No Update from '.$username.' yet!';
                        }
                        //pr($notificationArray); die();
                        foreach ($notificationArray as $notification) {
                            //pr($notification);die();
                            $posted_by = $notification['posts']['posted_by'];
                            $posted_by_name = '';

                            foreach ($otherUsers as $user) {
                                //pr($user);die();
                                $tempID = $user['users']['id'];
                                if ($tempID == $posted_by) {
                                    $posted_by_name = $user['users']['username'];
                                }
                            }
                            $posted_content = $notification['posts']['post_content'];
                            $posted_timing = $notification['posts']['timestamp'];
                            ?>

                            <div class="post-container">
                                <p class="large-2 columns">
                                    <?php echo $this->Html->image('profileImg/' . $posted_by_name . '.jpg', array('height' => '117px', 'width' => '88px'), array('url' => array('controller' => 'recipes', 'action' => 'view'))); ?>
                                </p>
                                <p class="large-10 columns">
                                    <?php if ($posted_by_name == $username) { ?>
                                        <b><?php echo $posted_by_name; ?></b> has posted <?php } else {
                                        ?>
                                        <b><?php echo $this->Html->link($posted_by_name, array('controller'=>'profiles','action'=>'viewProfile', $posted_by_name))?></b> posted on <?php echo $username ?>'s Wall <?php
                                    }
                                    ?>

                                <fieldset width="80%">
                                    <?php echo $posted_content; ?>

                                </fieldset>
                                <br>
                                <span align="right">&nbsp; Posted on <?php echo $posted_timing; ?></span>
                                </p>
                            </div>
                            <br>
                        <?php }
                        ?>
                </div>
                <div class="content" id="panel2-2">
                    <h1 align='center'><font size='6'><?php echo $username?>'s Challenges to Others</font></h1>
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
                                    echo $username.' do not have any outstanding challenges.';
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
                                            foreach ($otherUsers as $temp) {
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
                <div class="content" id="panel2-3">
                    <h1 align='center'><font size='6'><?php echo $username?>'s Friends</font></h1>
                    <table>
                        <?php
                        if(empty($allMyFriends)){
                            echo 'Please add friends!';
                        }
                        foreach ($allMyFriends as $temp) {
                            echo '<tr>';
                            $friendID = $temp['friends']['friend_id'];
                            $friendName = '';
                            foreach ($otherUsers as $tempUser) {
                                $tempUserId = $tempUser['users']['id'];
                                if ($tempUserId == $friendID) {
                                    $friendName = $tempUser['users']['username'];
                                    break;
                                }
                            }
                            ?>
                                <td width='50%'><?php echo $this->Html->image('profileImg/' . $friendName . '.jpg', array('height' => '35%', 'width' => '35%','align'=>'center'), array('url' => array('controller' => 'profiles', 'action' => 'otherProfiles',$friendName))); ?></td>
                                <td width='50'><?php echo $this->Html->link($friendName, array('controller' => 'profiles', 'action' => 'viewProfile',$friendName)); ?></td>
                            <?php
                            echo '<tr>';
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

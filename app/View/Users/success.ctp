<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class ="large-3 columns">
    <div class="row">
        <br>
        <div class="large-5 columns">
            <?php echo $this->Html->image('profileImg/' . $this->Session->read('User.username') . '.jpg', array('height' => '100%', 'width' => '100%'), array('url' => array('controller' => 'recipes', 'action' => 'view'))); ?>
        </div>
        <div class="large-7 columns">
            <?php
            echo $this->Html->link($this->Session->read('User.username'), array('controller' => 'profiles', 'action' => 'viewProfile',$this->Session->read('User.username')));
            ?>
            <br>
            <?php
            echo $this->Html->link(' Edit Profile', array('controller' => 'pages', 'action' => 'maintenance'), array('class' => 'fi-pencil', 'id' => 'editProfile'));
            ?>
            <br>
            Level: <?php 
                $id = $this->Session->read('User.id'); 
                echo $userArray[$id-1]['users']['rank'];?>
            Points: <?php echo $userArray[$this->Session->read('User.id')]['users']['score'];?>
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
    <div id = "content">
        <div class="myPost">
            <fieldset>
                <legend>My Thoughts...</legend>
                <?php
                echo $this->Form->create('NewWallPost', array('url' => array('controller' => 'profiles', 'action' => 'addNewsFeed')));
                echo $this->Form->textarea('newPost', array('placeholder' => 'What\'s your thought?', 'label' => false));
                echo $this->Form->input('wallOwner', array('type' => 'hidden','value'=>$this->Session->read('User.username')));
                echo $this->Form->input('location', array('type' => 'hidden','value'=>0));
                echo $this->Form->button('Post', array('controller' => 'profiles', 'action' => 'addNewsFeed'), array('class' => 'button', 'align' => 'right', 'width' => '33%'));
                echo $this->Form->end();
                ?>
            </fieldset>
        </div>
        <div class="friendsUpdates">
            <fieldset>
                <legend>My News Feed</legend>
                <?php
                if(empty($notificationArray)){
                    echo 'No updates yet!';
                }
                //pr($notificationArray); die();
                foreach ($notificationArray as $notification) {
                    $posted_by = $notification['posts']['posted_by'];
                    $posted_by_name = '';
                    foreach ($userArray as $user) {
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
                        <p class="small-2 columns">
                            <?php echo $this->Html->image('profileImg/' . $posted_by_name . '.jpg', array('height' => '117px', 'width' => '88px'), array('url' => array('controller' => 'recipes', 'action' => 'view'))); ?>
                        </p>
                        <p class="small-10 columns">
                            <b><?php echo $this->Html->link($posted_by_name, array('controller'=>'profiles','action'=>'viewProfile', $posted_by_name))?></b> has posted some thoughts
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
            </fieldset>
        </div>

    </div>
</div>

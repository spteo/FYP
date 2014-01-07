<!DOCTYPE html>
<?php echo $this->Html->charset(); ?> 
<head>
    <?php
    echo $this->Html->meta(
            'viewport', 'width=device-width');
    ?>

    <title>Knowledge Challenge</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->webroot; ?>img/favicon.ico">
    <?php echo $this->Html->css('foundation.css'); ?>
    <?php echo $this->Html->css('style.css'); ?>
    <?php echo $this->Html->css('sidebar/demo.css'); ?>
    <?php echo $this->Html->css('sidebar/icons.css'); ?>
    <?php echo $this->Html->css('sidebar/sideBarNormalize.css'); ?>
    <?php echo $this->Html->css('sidebar/style3.css'); ?>
    <?php echo $this->Html->css('foundation-icons/foundation-icons.css'); ?>
    <?php echo $this->Html->css('autocompletecss/select2.css'); ?>
    
    <style type="text/css">
        body {
            background: white no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            color: black;
            font-family: mingler-bold;
        }
        h3 {
            line-height: 0;
            font-size: 20px;
            font-family: mingler-bold;
        }
        h1,h2,h4 {
            font-family: mingler-bold;
        }
        table tr.even, table tr.alt, table tr:nth-of-type(even) {
        }
        table thead tr th,
        table thead tr td,
        table tfoot tr th,
        table tfoot tr td {
            background-color: gainsboro;
        }
        table tr th, table tr td {
            background: #F5ECCE;
            font-size: 16px;
        }
    </style>
    <?php echo $this->Html->script('http://code.jquery.com/ui/1.10.3/jquery-ui.js'); ?>
    <?php echo $this->Html->script('sidebar/modernizr.custom.js'); ?>
    
</head>
<body>
    <nav class="top-bar" data-topbar>
        <ul class="title-area">
            <li class="name">
                <a href=""><?php echo $this->Html->image('logo_1.png', array('width' => 80, 'url' => array('controller' => 'users', 'action' => 'success'))); ?> </a>
            </li>
        </ul>

        <section class="top-bar-section">
            <!-- Left Nav Section -->
            <ul class="left">
                <li>
                    <?php
                    echo $this->Html->link(' Knowledge Challenge', array('controller' => 'challenges', 'action' => 'scoreboard'), array('class' => 'fi-crown', 'id' => 'knowledgechallenge'));
                    ?>
                </li>
                <li>
                     <?php
                    echo $this->Html->link(' Little Classroom', array('controller' => 'classrooms', 'action' => 'little_classroom'), array('class' => 'fi-clipboard-pencil', 'id' => 'littleclassroom'));
                    ?>
                </li>
                <li class="has-dropdown">
                    <?php
                    echo $this->Html->link(' Little Desk', array('controller' => 'desks', 'action' => 'little_desk'), array('id' => 'littledesk'));
                    ?>
                    <ul class="dropdown">
                        <li>
                            <?php
                    echo $this->Html->link(' My Questions', array('controller' => 'desks', 'action' => 'my_desk'), array('id' => 'littledesk'));
                    ?>
                        </li>
                        <li><?php
                    echo $this->Html->link(' My Tutees Questions', array('controller' => 'desks', 'action' => 'my_tutee_desk'), array('id' => 'littledesk'));
                    ?></li>
                        <li><?php
                    echo $this->Html->link(' See All', array('controller' => 'desks', 'action' => 'display_all'), array( 'id' => 'littledesk'));
                    ?></li>
                    </ul>
                </li>
            </ul>

            <!-- Right Nav Section -->
            <ul class="right">
                <li><a class="fi-web" id="notifications" href="#"></a></li>
                <li><a class="fi-torsos-female-male" id="friendrequest" href="#"></a></li>
                <li><a class="fi-info" id="opentour" href="#"></a></li>

                <li class = "has-dropdown"><a href = "#"><?php echo $this->Session->read('User.username'); ?></a>
                    <ul class = "dropdown">
                        <li>
                            <?php
                            echo $this->Html->link('Search Friends', array('controller' => 'profiles', 'action' => 'viewProfile',$this->Session->read('User.username')));
                            ?>
                        </li>
                        <li><a id = "settings" href = "#">Account Settings</a></li>
                        <li>   <?php
                            echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'process_logout'));
                            ?></li>
                    </ul>
                </li>
            </ul>

        </section>
    </nav>
    <!--Main Content Section-->
    <!--This has been source ordered to come first in the markup (and on small devices) but to be to the right of the nav on larger screens-->
        
    <div class ="large-12 columns">
        
        <div id = "content">
            <?php echo $content_for_layout;
            ?>
            
        </div>
    </div>

    <footer>
        <div class="large-12 columns">
            <hr />
            <p>&copy; LitteLives Inc. Powered by LittleTeam.</p>
<nav id="bt-menu" class="bt-menu">
            <a href="#" class="bt-menu-trigger"><span>Menu</span></a>
            <ul>
                <li><?php
                    echo $this->Html->link('Scoreboard', array('controller' => 'challenges', 'action' => 'scoreboard'), array('class' => 'fi-clipboard-pencil', 'id' => 'knowledgechallenge'));
                    ?></li>
                <li><?php
                    echo $this->Html->link('Challenge Status', array('controller' => 'challenges', 'action' => 'view_outstanding_challenges'), array('class' => '.fi-info', 'id' => 'knowledgechallenge'));
                    ?></li>
                <li><?php
                    echo $this->Html->link('Send Challenge', array('controller' => 'challenges', 'action' => 'chooseChallengeType'), array('class' => 'fi-flag', 'id' => 'knowledgechallenge'));
                    ?></li>
                <li><?php
                    echo $this->Html->link('Accept Challenge', array('controller' => 'challenges', 'action' => 'view_challenges'), array('class' => 'fi-target 21', 'id' => 'knowledgechallenge'));
                    ?></li>
                <li><?php
                    echo $this->Html->link('Suggest Question', array('controller' => 'challenges', 'action' => 'suggest_question'), array('class' => 'fi-comment-quotes', 'id' => 'knowledgechallenge'));
                    ?></li>
                <li><?php
                    echo $this->Html->link('Vote Answer', array('controller' => 'challenges', 'action' => 'vote_answer'), array('class' => 'fi-magnifying-glass', 'id' => 'knowledgechallenge'));
                    ?></li>
            </ul>
        </nav>
        </div> 
    </footer> 

    <!-- Other JS plugins can be included here -->
    <?php echo $this->Html->script('jquery.js'); ?>
    <?php echo $this->Html->script('foundation/foundation.js'); ?>
    <?php echo $this->Html->script('foundation/foundation.abide.js'); ?>
    <?php echo $this->Html->script('foundation/foundation.accordion.js'); ?>
    <?php echo $this->Html->script('foundation/foundation.alert.js'); ?>
    <?php echo $this->Html->script('foundation/foundation.clearing.js'); ?>
    <?php echo $this->Html->script('foundation/foundation.dropdown.js'); ?>
    <?php echo $this->Html->script('foundation/foundation.interchange.js'); ?>
    <?php echo $this->Html->script('foundation/foundation.joyride.js'); ?>
    <?php echo $this->Html->script('foundation/foundation.magellan.js'); ?>
    <?php echo $this->Html->script('foundation/foundation.offcanvas.js'); ?>
    <?php echo $this->Html->script('foundation/foundation.orbit.js'); ?>
    <?php echo $this->Html->script('foundation/foundation.reveal.js'); ?>
    <?php echo $this->Html->script('foundation/foundation.tab.js'); ?>
    <?php echo $this->Html->script('foundation/foundation.tooltip.js'); ?>
    <?php echo $this->Html->script('foundation/foundation.topbar.js'); ?>
    <?php echo $this->Html->script('foundation/jquery.cookie.js'); ?>
    <?php echo $this->Html->script('sidebar/modernizr.custom.js'); ?>
    <?php echo $this->Html->script('sidebar/classie.js'); ?>
    <?php echo $this->Html->script('sidebar/borderMenu.js'); ?>
    <script>
        $(document).foundation();
    </script>
</body>
</html>
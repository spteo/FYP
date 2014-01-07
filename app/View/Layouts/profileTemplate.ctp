<!DOCTYPE html>
<?php echo $this->Html->charset(); ?> 
<head>
    <?php
    echo $this->Html->meta(
            'viewport', 'width=device-width');
    ?>

    <title>Learning Network</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->webroot; ?>img/favicon.ico">
    <?php echo $this->Html->css('foundation.css'); ?>
    <?php echo $this->Html->css('style.css'); ?>
    <?php echo $this->Html->css('profile.css'); ?>
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
        .post-container{
            background-color: #E0FFFF;
            width:100%;
            height:100%;
            border-style:solid;
            border-width:2px;
        }
        .search-box{
            background-color: #FFFFFF;
            width:100%;
            height:100%;
        }
    </style>

    <?php echo $this->Html->script('http://code.jquery.com/ui/1.10.3/jquery-ui.js'); ?>
    
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
    <br>
    <div class='row'>
        <!--<select id="e2_2">
            <option value="AL">Alabama</option>
            <option value="WY">Wyoming</option>
        </select>-->
    </div>
    
    <div class="row">
        <div class ="large-12 columns">
            <div id = "content">
                <?php echo $content_for_layout;
                ?>
            </div>
        </div>
    </div>

    <footer>
        <div class="large-12 columns">
            <hr />
            <p>&copy; LitteLives Inc. Powered by LittleTeam.</p>

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
    <script>
        $(document).foundation();
    </script>
    <?php echo $this->Html->script('autocomplete/select2.js'); ?>
    <script>
        $("#e2_2").select2({
            placeholder: "Select a State"
        });
    </script>
</body>
</html>
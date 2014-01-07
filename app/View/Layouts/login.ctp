
<html class="no-js" lang="en" >
    <head>
        <?php echo $this->Html->charset(); ?>
        <?php
        echo $this->Html->meta(
                'viewport', 'width=device-width'
        );
        ?>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->webroot; ?>img/favicon.ico" />
        <title>SMU LittleTeam</title>

        <?php echo $this->Html->css('foundation.css'); ?>
        <?php echo $this->Html->css('style.css'); ?>

        <style type="text/css">

            body {
                background: url(<?php echo $this->webroot; ?>img/cartoon-natural-landscape.jpg) no-repeat center center fixed; 
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }
            h3 {
                line-height: 0;
                font-size: 20px;
                font-family: mingler-bold;
            }
            h1,h2,h4 {
                font-family: mingler-bold;
            }
            img {
                max-width: 33%;
            }
            .orbit-container {
                width: 100%;
            }
            .wrapper-body{
                font-family: mingler-bold;
                background-color: #FFFFFF;
            }
            .forget-password-wrapper{
                font-family: mingler-bold;
                color: #FFA500;
            }
            .error-message{
                font-family: mingler-bold;
                color: #980000;
            }

        </style>
    </head>
    <body class="row">
        <!-- Main Content -->
        <div class="large-12 columns">
            <div class="row">    
                <!-- Login Form -->
                <div class="large-12 columns">
                    <p>&nbsp;&nbsp;&nbsp;<?php echo $this->Html->image('logo.png'); ?></p>
                </div>
                <div class="large-6 columns">
                    <div class="content">
                        <?php echo $content_for_layout;
                        ?>
                    </div>
                </div>
                <!-- Orbit Pictures -->
                <div class="large-6 columns">
                    <ul data-orbit>
                        <li>
                            <?php echo $this->Html->image('homepageImg/knowledgechallenge.jpg'); ?>

                        </li>
                        <li>
                            <?php echo $this->Html->image('homepageImg/learningnetwork.jpg'); ?>

                        </li>
                        <li>
                            <?php echo $this->Html->image('homepageImg/littleclassroom.jpg'); ?>

                        </li>
                        <li>
                            <?php echo $this->Html->image('homepageImg/littledesk.jpg'); ?>

                        </li>
                    </ul>    
                </div>
                <div class="large-2 columns"></div>
            </div>

            <!-- Footer -->
            <footer class="row">
                <div class="large-12 columns">
                    <hr />
                    <div class="row">
                        <div class="large-6 columns">
                            <p>&copy; LitteLives Inc. Powered by LittleTeam.</p>
                        </div>
                    </div>
                </div> 
            </footer> 
            <!-- The JavaScript -->
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
    </body>
</html>
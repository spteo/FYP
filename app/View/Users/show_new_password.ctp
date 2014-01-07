<div class="form_wrapper">
    <div class="wrapper-body">
        <h3>Forgot your password?</h3>
        <div class="error-message" align="center">
            <?php
            $successMsg = $this->Session->flash();
            if ($successMsg != '') {
                ?>
                <span class="success label"><?php echo $successMsg ?></span>
            <?php }
            ?>
        </div>
        <div>

            <p>Dear <?php echo $this->Session->read('resetUsername'); ?>,</p>
            <p align="center">Your new password is <font color="red"><?php echo $this->Session->read('resetPassword'); ?> </font>! Please change them upon logging in.</p>
            <p align="right">Regards, SMU LittleTeam</p>
        </div>
        <div class="bottom">
            <div class="clear"></div>
            <div class="forget-password-wrapper" align="center">
                <?php
                echo $this->Html->link('Click here to login!', array(
                    'controller' => 'users',
                    'action' => 'index'
                        )
                );
                ?>
            </div>
        </div>
        <div class="clear"></div>

    </div>
</div>
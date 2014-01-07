<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="form_wrapper">
    <div class="wrapper-body">
        <h3>Welcome!</h3>
        <div class="error-message" align="center">
            <?php
            $errorMsg = $this->Session->flash();
            if ($errorMsg != '') {
                ?>
                <span class="round alert label"><?php echo $errorMsg ?></span>
            <?php }
            ?>

        </div>
        <div>

            <?php echo $this->Form->create('User', array('action' => 'process_login')); ?>
        </div>
        <div>
            <?php echo $this->Form->input('username'); ?>
        </div>
        <div>

            <?php echo $this->Form->input('password'); ?>

        </div>
        <div class="bottom">
            <div class="remember"><input type="checkbox" /><span>Keep me logged in</span></div>
            <input id="submit" type="submit" value="Login" />
            <div class="clear"></div>
            <div class="forget-password-wrapper">
                <?php
                echo $this->Html->link('Forget Password?', array(
                    'controller' => 'users',
                    'action' => 'forgetPassword'
                        )
                );
                ?>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>

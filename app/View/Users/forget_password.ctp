<div class="form_wrapper">
    <div class="wrapper-body">
        <h3>Forgot your password?</h3>
        <div class="error-message" align="center">
            <?php
            $errorMsg = $this->Session->flash();
            if ($errorMsg != '') {
                ?>
                <span class="round alert label"><?php echo $errorMsg ?></span>
            <?php }
            ?>
        </div>
         <p align="center">Fret not! Just enter your email or username associated with your LittleLives account.</p>
        <div>
             <?php echo $this->Form->create('User', array('action' => 'process_forgetPassword')); ?>
        </div>
        <div>
            <?php echo $this->Form->input('Enter your Username',array('id'=>'username')); ?>
        </div>
          <div>
            <?php echo $this->Form->input('Enter your ID Number',array('id'=>'userNRIC')); ?>
        </div>
        <div class="bottom">
            <input id="submit" type="submit" value="Reset My Password!" />
            <div class="clear"></div>
            <div class="forget-password-wrapper">
                <?php
            echo $this->Html->link('Suddenly remembered?', array(
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
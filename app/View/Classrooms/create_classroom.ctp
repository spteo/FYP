<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1 align='Center'>
    <?php echo $title ?>    
</h1>

<?php
    echo $this->Form->create('Content', array('url' => array('controller' => 'Classrooms', 'action' => 'process_save_new_classroom')));
?>
<br>
<p>
    Introduction
</p>
<?php
    echo $this->Form->input('intro', array('type' => 'textarea', 'label' => false, 'placeholder' => 'Write Your Introduction Here'));
?>
<p>
    Paragraph 1
</p>
<?php
    echo $this->Form->input('p1', array('type' => 'textarea', 'label' => false, 'placeholder' => 'Write Your Content for Paragraph 1 Here'));
?>    
<p>
    Paragraph 2
</p>
<?php
    echo $this->Form->input('p2', array('type' => 'textarea', 'label' => false, 'placeholder' => 'Write Your Content for Paragraph 2 Here'));
?>
<p>
    Paragraph 3
</p>
<?php
    echo $this->Form->input('p3', array('type' => 'textarea', 'label' => false, 'placeholder' => 'Write Your Content for Paragraph 3 Here'));
?>
<p>
    Conclusion
</p>
<?php
    echo $this->Form->input('conclusion', array('type' => 'textarea', 'label' => false, 'placeholder' => 'Write Your Content for Paragraph 3 Here'));
?>
<?php
    echo $this->Form->input('classroom_id', array('type' => 'hidden', 'value' => $classroom_id));
    echo $this->Form->button('Save', array('name' => 'save', 'value' => 'yes'));
    echo $this->Form->button('Save & Publish', array('name' => 'publish', 'value' => 'yes'));
    echo $this->Form->button('Cancel', array('name' => 'back', 'value' => 'yes'));
    echo $this->Form->end();
?>
<div class="row">
    <?php
        $message = $this->Session->flash();
    if($message !=''){
        ?> 
    <div align="center">
    <span class="success alert secondary round radius label"><font size="4" color="black"><?php echo $message; ?></font></span></div>
    <?php }
    ?>
</div>
<div class='row'>
    <h1 align='center'> Little Desk </h1>
    <fieldset style='border-width: 2px; border-style: solid; border-color: black;'>
    <legend align='center'>Choose a Category</legend>
    <ul class="small-block-grid-3">
  <li><?php echo $this->Html->image('categoryImg/english.jpg', array('url'=>array('controller'=>'desks','action'=>'category_questions', 'English')));?></li>
  <li><?php echo $this->Html->image('categoryImg/maths.jpg', array('url'=>array('controller'=>'desks','action'=>'category_questions', 'Maths')));?></li>
  <li><?php echo $this->Html->image('categoryImg/science.jpg', array('url'=>array('controller'=>'desks','action'=>'category_questions', 'Science')));?></li>
  <li><?php echo $this->Html->image('categoryImg/geography.jpg', array('url'=>array('controller'=>'desks','action'=>'category_questions', 'Geography')));?></li>
  <li><?php echo $this->Html->image('categoryImg/fashion.jpg', array('url'=>array('controller'=>'desks','action'=>'category_questions', 'Fashion')));?></li>
  <li><?php echo $this->Html->image('categoryImg/games.jpg', array('url'=>array('controller'=>'desks','action'=>'category_questions', 'Games')));?></li>
  <li><?php echo $this->Html->image('categoryImg/sports.jpg', array('url'=>array('controller'=>'desks','action'=>'category_questions', 'Sports')));?></li>
</ul>
    </fieldset>
</div>
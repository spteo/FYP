<?php

class Question extends AppModel{
    var $name = 'Question';
    
    var $validate = array(
        'question_body'=>array(
            'body_must_not_be_blank'=>array(
                'rule'=>'notEmpty',
                'message'=>'Missing question body!'
            )
        ),
        'answer_a'=>array(
            'answer_a_must_not_be_blank'=>array(
                'rule'=>'notEmpty',
                'message'=>'Missing answer A!'
            )
        ),
        'answer_b'=>array(
            'answer_b_must_not_be_blank'=>array(
                'rule'=>'notEmpty',
                'message'=>'Missing answer B!'
            )
        ),
        'answer_c'=>array(
            'answer_c_must_not_be_blank'=>array(
                'rule'=>'notEmpty',
                'message'=>'Missing answer C!'
            )
        )
    );
}
?>

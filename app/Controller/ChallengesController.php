<?php

App::uses('AppController', 'Controller');

class ChallengesController extends AppController {

    Function scoreboard() {
        $this->loadModel('User');
        $this->set('user', $this->User->Query('select * from users, classes, schools where users.class_id = classes.class_id and users.school_id=schools.school_id order by users.score DESC limit 3'));
        $this->loadModel('Class');
        $this->set('class', $this->Class->Query('select * from classes, schools where classes.school_id = schools.school_id order by classes.score DESC limit 3'));
        $this->loadModel('School');
        $this->set('school', $this->School->Query('select * from schools order by score DESC limit 3'));
        $this->layout = 'challengeTemplate';
    }

    Function choose_difficulty() {
        $this->layout = 'challengeTemplate';
    }

    Function view_challenges() {
        $this->layout = 'challengeTemplate';
        $login_id = $this->Session->read('User.id');
        $this->loadModel('User');
        $login_user = $this->User->read(NULL, $login_id);
        $login_class = $login_user['User']['class_id'];
        $login_school = $login_user['User']['school_id'];

        $this->loadModel('Challenge');
        //$a = $this->Challenge->query('select * from challenges left outer join accept_challenges on challenges.challenge_id = accept_challenges.challenge_id and accept_challenges.answer_by=1');
        $to_individual = $this->Challenge->find('all', array('conditions' => array('challenge_status' => NULL, 'to_individual' => $login_id)));
        $to_class = $this->Challenge->find('all', array('conditions' => array('challenge_status' => NULL, 'to_class' => $login_class)));
        $to_school = $this->Challenge->find('all', array('conditions' => array('challenge_status' => NULL, 'to_school' => $login_school)));

        $this->loadModel('AcceptChallenge');
        $answered = $this->AcceptChallenge->find('all', array('conditions' => array('answer_by' => $login_id)));

        foreach ($to_class as $key => $temp):
            $id = $temp['Challenge']['challenge_id'];
            foreach ($answered as $key_answered => $temp_answered):
                if ($temp_answered['AcceptChallenge']['challenge_id'] === $id) {
                    unset($to_class[$key]);
                    unset($answered[$key_answered]);
                    break;
                }
            endforeach;
        endforeach;


        foreach ($to_school as $key_school => $temp):
            $id = $temp['Challenge']['challenge_id'];
            foreach ($answered as $key_school_answered => $temp_answered):
                if ($temp_answered['AcceptChallenge']['challenge_id'] === $id) {
                    unset($to_school[$key_school]);
                    unset($answered[$key_school_answered]);
                    break;
                }
            endforeach;
        endforeach;


        $this->set('individual', $to_individual);
        $this->set('class', $to_class);
        $this->set('school', $to_school);
    }

    Function suggest_question() {
        $this->layout = 'challengeTemplate';
        //have to set the login user id
        $this->set('login_id', $this->Session->read('User.id'));
        $this->loadModel('Question');
        if (!empty($this->data)) {
            if ($this->Question->save($this->data)) {

                $this->Session->setFlash('The question was successfully added!');
                $this->redirect(array('controller' => 'challenges', 'action' => 'suggest_question'));
            } else {
                $this->Session->setFlash('The question was not saved, please try again');
            }
        }
        
    }

    Function vote_answer() {
        $this->layout = 'challengeTemplate';
        $login_id = $this->Session->read('User.id');
        $this->loadModel('Question');
       $this->set('question_for_vote', $this->Question->Query('select * from questions where status="pending" and raised_by <>' .$login_id));
    }

    Function view_outstanding_challenges() {
        $this->layout = 'challengeTemplate';
        //pass array of challenges to the view
        $this->loadModel('Challenge');
        $challengesToOthers=$this->Challenge->Query('SELECT * FROM challenges WHERE formed_by="'.$this->Session->read('User.id').'"');
        $this->set('challengesToOthers',$challengesToOthers);
        
        //pass array of users to view
        $this->loadModel('User');
        $allUsers = $this->User->Query('SELECT * FROM users');
        $this->set('allUsers',$allUsers);
        
        //pass array of school to view
        $this->loadModel('School');
        $allSchools = $this->School->Query('SELECT * FROM schools');
        $this->set('allSchools',$allSchools);
        
        //pass array of class to view
        $this->loadModel('Class');
        $allClasses = $this->Class->Query('SELECT * FROM classes');
        $this->set('allClasses',$allClasses);
        //pr($allChallenges);die();
        
        //Challenges sent to me
        $challengesToMe = $this->Challenge->Query('SELECT * FROM challenges WHERE to_individual="'.$this->Session->read('User.id').'"');
        $myClassId = $this->User->Query('SELECT class_id FROM users WHERE id="'.$this->Session->read('User.id').'"');
        $mySchoolId = $this->User->Query('SELECT school_id FROM users WHERE id="'.$this->Session->read('User.id').'"');
        $classChallengesToMe = $this->Challenge->Query('SELECT * FROM challenges WHERE to_class="'.$myClassId[0]['users']['class_id'].'"');
        $schoolChallengesToMe = $this->Challenge->Query('SELECT * FROM challenges WHERE to_school="'.$mySchoolId[0]['users']['school_id'].'"');
        $this->set('challengesToMe',$challengesToMe);
        $this->set('classChallengesToMe',$classChallengesToMe);
        $this->set('schoolChallengesToMe',$schoolChallengesToMe);
    }

    Function choose_target($difficulty=NULL, $questions=NULL, $remove=NULL, $username='', $title=''){
        $this->layout='challengeTemplate';
        $this->set('difficulty', $difficulty);
        if($username === 'NULL'){
            $username = '';
        }
        $this->set('username', $username);
        $this->set('title', $title);
         
        if(!empty($questions) && $questions != 'NULL'){
            $questions_array = explode(';', $questions);
            $questions_details = array();
            foreach($questions_array as $qn_id):
                $this->loadModel('Question');
                $qn = $this->Question->find('all', array('conditions'=>array('question_id'=>$qn_id)));
                $questions_details[] = $qn[0];
            endforeach;

            if(!empty($remove) && $remove != 'NULL'){
                foreach($questions_details as $key=>$temp){
                    if($temp['Question']['question_id'] === $remove){
                        unset($questions_details[$key]);
                        break;
                    }
                }
            }
            $this->set('chosen_questions', $questions_details);
        }
        $userArray = $this->getUserArray();
        $this->set('userArray',$userArray);
    }
    
    Function getUserArray(){
        $this->loadModel('User');
        $login_username = $this->Session->read('User.username');
       return $userArray = $this->User->Query('SELECT username FROM users WHERE username <>'.'"'.$login_username.'"');
        
    }

    Function choose_questions($difficulty = NULL, $chosen_qns = NULL, $username = '', $title='') {
        //login user
        $login_id = $this->Session->read('User.id');
        $this->loadModel('Question');
        $questions = $this->Question->find('all', array('conditions' => array('raised_by' => $login_id, 'status' => 'accept')));
        $this->layout = 'challengeTemplate';
        if (empty($this->data)) {
            $this->set('questions', $questions);
            $this->set('difficulty', $difficulty);
            if ($chosen_qns === 'NULL') {
                $chosen_qns = NULL;
            }
            $this->set('chosen_qns', $chosen_qns);
            $this->set('username', $username);
            $this->set('title', $title);
        } else {
            $questions_id = '';
            $count = 0;
            foreach ($this->data as $temp) {

                if ($temp === '1') {
                    $qn = $questions[$count];
                    $questions_id = $questions_id . $qn['Question']['question_id'] . ';';
                }
                $count++;
            }
            $questions_id = substr($questions_id, 0, -1);
            if(empty($questions_id)){
                $questions_id = 'NULL';
            }
            $this->redirect(array('action' => 'choose_target', $difficulty, $questions_id, 'NULL', $username, $title));
        }
    }

    Function send_challenge() {
        if (!empty($this->data)) {
            $questions = $this->data['Challenge']['questions'];
            $difficulty = $this->data['Challenge']['difficulty'];
            $username = $this->data['Challenge']['username'];
            if (empty($questions)) {
                $questions = 'NULL';
            }
            if(empty($username)){
                $username = 'NULL';
            }
            $title = $this->data['Challenge']['challenge_title'];
            if ($this->data['add'] === 'yes') {
                $this->redirect(array('action' => 'choose_questions', $difficulty, $questions, $username, $title));
            } else if ($this->data['send'] === 'yes') {
                if ($questions === 'NULL') {
                    $this->Session->setFlash('Please choose your questions before sending out a challenge!');
                    $this->redirect(array('action' => 'choose_target', $difficulty, 'NULL', 'NULL', $username, $title));
                } else if(empty($title)){
                    $this->Session->setFlash('Please choose your questions before sending out a challenge!');
                    $this->redirect(array('action' => 'choose_target', $difficulty, 'NULL', 'NULL', $username, $title));
                }
                    
                    else{
                    $qns_array = explode(';', $questions);
                    if ($difficulty === 'easy') {
                        if (count($qns_array) != 3) {
                            //$this->send_challenge($difficulty, $questions );
                            $this->Session->setFlash('You need to choose 3 questions to send a easy challenge!');
                            $this->redirect(array('action' => 'choose_target', $difficulty, $questions, 'NULL', $username, $title));
                        }
                    } else if ($difficulty === 'medium') {
                        if (count($qns_array) != 6) {
                            $this->Session->setFlash('You need to choose 6 questions to send a medium challenge!');
                            $this->redirect(array('action' => 'choose_target', $difficulty, $questions, 'NULL', $username, $title));
                        }
                    } else if ($difficulty === 'hard') {
                        if (count($qns_array) != 9) {
                            $this->Session->setFlash('You need to choose 9 questions to send a hard challenge!');
                            $this->redirect(array('action' => 'choose_target', $difficulty, $questions, 'NULL', $username, $title));
                        }
                    }
                    $this->loadModel('User');
                    $to_user = $this->User->find('all', array('conditions' => array('username' => $username)));
                    $this->loadModel('Class');
                    $to_class = $this->Class->find('all', array('conditions' => array('class_name' => $username)));
                    $this->loadModel('School');
                    $to_school = $this->School->find('all', array('conditions' => array('school_name' => $username)));
                    //Login user
                    $login_id = $this->Session->read('User.id');

                    if (empty($to_user) && empty($to_class) && empty($to_school)) {
                        $this->Session->setFlash('Please enter a valid opponent!');
                        $this->redirect(array('action' => 'choose_target', $difficulty, $questions, 'NULL', $username, $title));
                    } else {
                        if (!empty($to_user)) {
                            $user_id = $to_user[0]['User']['id'];
                            if ('' . $user_id === '' . $login_id) {

                                $this->Session->setFlash('Sorry, you cannot send a challenge to yourself!');
                                $this->redirect(array('action' => 'choose_target', $difficulty, $questions, 'NULL', $username, $title));
                            } else {
                                $this->Challenge->Query('insert into challenges (difficulty_level, questions, formed_by, to_individual, challenge_title) values ("' . $difficulty . '","' . $questions . '",' . $login_id . ',' . $user_id .',"'.$title. '")');
                                $this->Session->setFlash('You have successfully sent a challenge');
                                $this->redirect(array('action' => 'choose_difficulty'));
                            }
                        } else if (!empty($to_class)) {
                            $user = $this->User->find('all', array('conditions' => array('id' => $login_id)));
                            $class_id = $to_class[0]['Class']['class_id'];
                            if ($user[0]['User']['class_id'] === $class_id) {
                                $this->Session->setFlash('Sorry, you cannot send a challenge to your own class!');
                                $this->redirect(array('action' => 'choose_target', $difficulty, $questions, 'NULL', $username, $title));
                            } else {
                                $this->Challenge->Query('insert into challenges (difficulty_level, questions, formed_by, to_class, challenge_title) values ("' . $difficulty . '","' . $questions . '",' . $login_id . ',' . $class_id . ',"'.$title.'")');
                                $this->Session->setFlash('You have successfully sent a challenge');
                                $this->redirect(array('action' => 'choose_difficulty'));
                            }
                        } else if (!empty($to_school)) {
                            $user = $this->User->find('all', array('conditions' => array('id' => $login_id)));
                            $school_id = $to_school[0]['School']['school_id'];
                            if ($user[0]['User']['school_id'] === $school_id) {
                                $this->Session->setFlash('Sorry, you cannot send a challenge to your own school!');
                                $this->redirect(array('action' => 'choose_target', $difficulty, $questions, 'NULL', $username, $title));
                            } else {
                                $this->Challenge->Query('insert into challenges (difficulty_level, questions, formed_by, to_school, challenge_title) values ("' . $difficulty . '","' . $questions . '",' . $login_id . ',' . $school_id . ',"'.$title.'")');
                                $this->Session->setFlash('You have successfully sent a challenge');
                                $this->redirect(array('action' => 'choose_difficulty'));
                            }
                        }
                    }
                }
            }
        }
    }
    
    Function reject_challenge($id = NULL){
        $this->Challenge->Query('update challenges set challenge_status="lose" where challenge_id = '.$id);
        $this->Session->setFlash('You have lost a challenge!');
        $this->redirect(array('action'=>'view_challenges', $id, $challenge[0]['Challenge']['questions'], $difficulty, $required , 0, ''));
    }
    
    Function accept_challenge($id = NULL) {
        $challenge = $this->Challenge->find('all', array('conditions' => array('challenge_id' => $id)));
        $difficulty = $challenge[0]['Challenge']['difficulty_level'];
        if ($difficulty === 'easy') {
            $required = 3;
        } else if ($difficulty === 'medium') {
            $required = 6;
        } else {
            $required = 9;
        }

        $this->redirect(array('action' => 'view_question', $id, $challenge[0]['Challenge']['questions'], $difficulty, $required, 0, ''));
    }

    Function view_question($challenge_id = NULL, $questions = NULL, $difficulty = NULL, $required = NULL, $current = NULL, $answers = NULL) {
        $this->layout = 'challengeTemplate';
        if (!empty($this->data)) {
            $ans = $this->data['Challenge']['selected_answer'];
            $answers = $answers . $ans . ';';
        }
        $this->set('info', array('challenge_id' => $challenge_id, 'questions' => $questions, 'difficulty' => $difficulty, 'required' => $required, 'current' => $current, 'answers' => $answers));
        $qn = explode(';', $questions);
        $qn_id = $qn[$current];
        $this->loadModel('Question');
        //pr($this->Question->find('all', array('conditions'=>array('question_id'=>$qn_id))));
        $this->set('question', $this->Question->find('all', array('conditions' => array('question_id' => $qn_id))));
    }

    Function challenge_result($challenge_id = NULL, $difficulty = NULL, $questions = NULL, $answers = NULL) {
        $this->layout = 'challengeTemplate';

        $ans = $this->data['Challenge']['selected_answer'];
        $answers = $answers . $ans;

        $qns_id = explode(';', $questions);
        $correct_answer = '';
        $question_body = '';
        foreach ($qns_id as $qn_id) {
            $result = $this->Challenge->Query('select correct_answer, question_body from questions where question_id=' . $qn_id);
            $correct_answer = $correct_answer . $result[0]['questions']['correct_answer'] . ';';
            $question_body = $question_body . $result[0]['questions']['question_body'] . ';';
        }
        $correct_answer = substr($correct_answer, 0, -1);
        $question_body = substr($question_body, 0, -1);

        if ($answers === $correct_answer) {
            $correct = 'true';
        } else {
            $correct = 'false';
        }

        //login user
        $login_id = $this->Session->read('User.id');
        ;
        $this->Challenge->Query('Insert into accept_challenges (challenge_id, answer, answer_by, correct_response) values (' . $challenge_id . ', "' . $answers . '", ' . $login_id . ', "' . $correct . '")');

        $this->enough_response($challenge_id);

        $answers = explode(';', $answers);
        $correct_answer = explode(';', $correct_answer);
        $correct_wrong = '';
        $count = 0;
        foreach ($answers as $answer) {
            if ($answer === $correct_answer[$count]) {
                $correct_wrong = $correct_wrong . 'Correct!!;';
            } else {
                $correct_wrong = $correct_wrong . 'Wrong!!;';
            }
            $count++;
        }

        $correct_wrong = substr($correct_wrong, 0, -1);
        $this->set('body', explode(';', $question_body));
        $this->set('correct_wrong', explode(';', $correct_wrong));
        $this->set('difficulty', $difficulty);
    }
    
    Function enough_response($challenge_id = NULL){
        
        //login user
        $login_id = $this->Session->read('User.id');
        
        $challenge = $this->Challenge->find('all', array('conditions'=>array('challenge_id'=>$challenge_id)));
        
        $challenge = $challenge[0]['Challenge'];
        
        if($challenge['to_individual'] != NULL){
            $status = $this->Challenge->Query('select correct_response from accept_challenges where challenge_id='.$challenge_id.' and answer_by='.$login_id);
            $status = $status[0]['accept_challenges']['correct_response'];
            if($status === 'true'){
                $challenge_status = 'win';
            } else {
                $challenge_status = 'lose';
            }
            
            $this->Challenge->Query('update challenges set challenge_status="'.$challenge_status.'" where challenge_id='.$challenge_id);
        } else if($challenge['to_class'] != null){
            $class_count = $this->Challenge->Query('select count(*) from users where class_id='.$challenge['to_class']);
            $class_count = $class_count[0][0]['count(*)'];
            
            $response = $this->Challenge->Query('select correct_response from accept_challenges, users where accept_challenges.answer_by = users.id and accept_challenges.challenge_id='.$challenge_id.' and users.class_id='.$challenge['to_class']);
            
            $correct = 0;
            $wrong = 0;
            foreach($response as $temp){
                if($temp['accept_challenges']['correct_response'] === 'true'){
                    $correct++;
                } else {
                    $wrong++;
                }
            }
            
            $total = $correct + $wrong;
            
            if($total/$class_count >= 0.5){
                if($correct/$total >= 0.5){
                    $status = 'win';
                } else {
                    $status = 'lose';
                }
                $this->Challenge->Query('update challenges set challenge_status="'.$status.'" where challenge_id='.$challenge_id);
            }
        } else {
            $school_count = $this->Challenge->Query('select count(*) from users where school_id='.$challenge['to_school']);
            $school_count = $school_count[0][0]['count(*)'];
            
            $response = $this->Challenge->Query('select correct_response from accept_challenges, users where accept_challenges.answer_by = users.id and accept_challenges.challenge_id='.$challenge_id.' and users.school_id='.$challenge['to_school']);
            
            $correct = 0;
            $wrong = 0;
            foreach($response as $temp){
                if($temp['accept_challenges']['correct_response'] === 'true'){
                    $correct++;
                } else {
                    $wrong++;
                }
            }
            
            $total = $correct + $wrong;
            if($total/$school_count >= 0.3){
                if($correct/$total >= 0.5){
                    $status = 'win';
                } else {
                    $status = 'lose';
                }
                $this->Challenge->Query('update challenges set challenge_status="'.$status.'" where challenge_id='.$challenge_id);
            }
        }
    }
    
     //check if the login user has voted for this question
    Function voted($question_id = NULL) {
        $login_id = $this->Session->read('User.id');

        $this->loadModel('Vote');
        $voted = $this->Vote->Query('select * from votes where question_id=' . $question_id . ' and voted_by=' . $login_id);
        if (empty($voted)) {
            return false;
        } else {
            return true;
        }
    }

    //vote the question
    Function vote($question_id = NULL) {
        $this->layout='challengeTemplate';
        $this->loadModel('Vote');
        $this->loadModel('Question');
        if (empty($this->data)) {
            $this->set('question', $this->Question->find('all', array('conditions' => array('question_id = ' => $question_id))));
        } else {
            
            $id = $this->data['Question']['id'];

            //set the login user id
            $voted_by = $this->Session->read('User.id');;

            $answer = $this->data['Question']['VotedAnswer'];
            if($answer ==''){
                $this->Session->setFlash('Please select a vote!');
                $this->redirect(array('action' => 'vote', $id));
            }
            $insertQuery = ("INSERT INTO `votes` (question_id, voted_by, voted_answer) VALUES ('{$id}', '{$voted_by}', '{$answer}')");
            $this->Question->query($insertQuery);
            $this->Session->setFlash('Your vote has been captured!');
            $this->redirect(array('action' => 'voting_result', $id));
        }
    }

    Function voting_result($question_id = NULL) {
        $this->layout='challengeTemplate';
        $this->loadModel('Vote');
        $this->loadModel('Question');
        $questionVoted = $this->Question->Query('select question_body from questions where question_id=' . $question_id);
        $questionName = $questionVoted[0]['questions']['question_body'];
        
        $questionResponse = $this->Question->Query('select answer_a, answer_b, answer_c from questions where question_id=' . $question_id);
        
        $this->loadModel('Vote');
        $answer_a = $this->Vote->Query('select count(*) as count from votes where question_id=' . $question_id . ' and voted_answer = "a"');
        $answer_b = $this->Vote->Query('select count(*) as count from votes where question_id=' . $question_id . ' and voted_answer = "b"');
        $answer_c = $this->Vote->Query('select count(*) as count from votes where question_id=' . $question_id . ' and voted_answer = "c"');
        $answer_d = $this->Vote->Query('select count(*) as count from votes where question_id=' . $question_id . ' and voted_answer = "d"');

        $a = $answer_a[0][0]['count'];
        $b = $answer_b[0][0]['count'];
        $c = $answer_c[0][0]['count'];
        $d = $answer_d[0][0]['count'];
        $total = $a + $b + $c + $d;

        $a_percentage = round(($a / $total) * 100, 2);
        $b_percentage = round(($b / $total) * 100, 2);
        $c_percentage = round(($c / $total) * 100, 2);
        $d_percentage = round(($d / $total) * 100, 2);

        //this question cannot be voted anymore.
        if ($total === 2) {
            $correct = 'd';
            if ($d_percentage < 20) {
                $max = $a;
                $correct = 'a';
                if ($max < $b) {
                    $max = $b;
                    $correct = 'b';
                }
                if ($max < $c) {
                    $max = $c;
                    $correct = 'c';
                }
                if ($max < $d) {
                    $max = $d;
                    $correct = 'd';
                }

                //check tie
                if ($max === $a && ($a === $b || $a === $c || $a === $d)) {
                    $correct = 'd';
                } else if ($max === $b && ($b === $a || $b === $c || $b === $d)) {
                    $correct = 'd';
                } else if ($max === $c && ($c === $a || $c === $b || $c === $d)) {
                    $correct = 'd';
                }
            }

            if ($correct === 'd') {
                $this->Vote->Query('Update questions set status="reject", end_timestamp= CURRENT_TIMESTAMP where question_id=' . $question_id);
            } else {
                $this->Vote->Query('Update questions set status="accept", correct_answer="' . $correct . '", end_timestamp= CURRENT_TIMESTAMP where question_id=' . $question_id);
            }
        }
        $this->set('answersArray',$questionResponse);
        $this->set('question',$questionName);
        $this->set('result', array('a' => $a_percentage, 'b' => $b_percentage, 'c' => $c_percentage, 'd' => $d_percentage));
    }

    Function chooseChallengeType(){
        $this->layout='challengeTemplate';
    }
    
    Function choose_difficulty_many_to_many(){
        $this->layout='challengeTemplate';
    }
    
    Function choose_target_many_to_many($difficulty=NULL, $questions=NULL, $remove=NULL, $username='', $title=''){
        $this->layout='challengeTemplate';
        $this->set('difficulty', $difficulty);
        if($username === 'NULL'){
            $username = '';
        }
        $this->set('username', $username);
        $this->set('title', $title);
         
        if(!empty($questions) && $questions != 'NULL'){
            $questions_array = explode(';', $questions);
            $questions_details = array();
            foreach($questions_array as $qn_id):
                $this->loadModel('Question');
                $qn = $this->Question->find('all', array('conditions'=>array('question_id'=>$qn_id)));
                $questions_details[] = $qn[0];
            endforeach;

            if(!empty($remove) && $remove != 'NULL'){
                foreach($questions_details as $key=>$temp){
                    if($temp['Question']['question_id'] === $remove){
                        unset($questions_details[$key]);
                        break;
                    }
                }
            }
            $this->set('chosen_questions', $questions_details);
        }
    }
    
    Function send_challenge_many_to_many(){
        $this->layout='challengeTemplate';
        if(!empty($this->data)){
            $questions = $this->data['Challenge']['questions'];
            $difficulty = $this->data['Challenge']['difficulty'];
            $username = $this->data['Challenge']['username'];
            $title = $this->data['Challenge']['challenge_title'];
            
            if(empty($username)){
                $username = 'NULL';
            }
            
            if(empty($questions)){
                $questions = 'NULL';
            }
            
            if($this->data['add'] === 'yes'){
                if(empty($questions)){
                    $questions = 'NULL';
                }
                $this->redirect(array('action'=>'choose_questions_many_to_many', $difficulty, $questions, $username, $title));
            } else if($this->data['send'] === 'yes'){
                
                if(empty($title)){
                    $this->Session->setFlash('Please put in a challenge title before forming a challenge!');
                    $this->redirect(array('action'=>'choose_target_many_to_many', $difficulty, $questions, 'NULL', $username, $title));
                } else if($username === 'NULL'){
                    $this->Session->setFlash('Please choose an opponent before forming a challenge!');
                    $this->redirect(array('action'=>'choose_target_many_to_many', $difficulty, $questions, 'NULL', $username, $title));
                } else if($questions === 'NULL'){
                    $this->Session->setFlash('Please choose your questions before forming a challenge!');
                    $this->redirect(array('action'=>'choose_target_many_to_many', $difficulty, $questions, 'NULL', $username, $title));
                
                } else{
                    
                    $this->loadModel('Class');
                    $to_class = $this->Class->find('all', array('conditions'=>array('class_name'=>$username)));
                    $this->loadModel('School');
                    $to_school = $this->School->find('all', array('conditions'=>array('school_name'=>$username)));
                    //Login user
                    $login_id = $this->Session->read('User.id');
                    
                    $qns_array = explode(';', $questions);
                    
                    if(empty($to_class) && empty($to_school)){
                        $this->Session->setFlash('Please enter a valid class name or school name as opponent!');
                        $this->redirect(array('action'=>'choose_target_many_to_many', $difficulty, $questions, 'NULL', $username, $title));
                    } else {
                        $this->loadModel('User');
                        if(!empty($to_class)){
                            $user = $this->User->find('all', array('conditions'=>array('id'=>$login_id)));
                            $class_id = $to_class[0]['Class']['class_id'];
                            if($user[0]['User']['class_id'] === $class_id){
                                $this->Session->setFlash('Sorry, you cannot form a challenge to your own class!');
                                $this->redirect(array('action'=>'choose_target_many_to_many', $difficulty, $questions, 'NULL', $username, $title));
                            } else {
                                if(count($qns_array) != 1){
                                    //$this->send_challenge($difficulty, $questions );
                                    $this->Session->setFlash('You need to choose 1 question to form part of a class challenge!');
                                    $this->redirect(array('action'=>'choose_target_many_to_many', $difficulty, $questions, 'NULL', $username, $title));
                                }
                                
                                $this->Challenge->Query('insert into form_challenges (difficulty_level, questions, formed_by, to_class, challenge_title) values ("'.$difficulty.'","'.$questions.'",'.$login_id.','.$class_id.',"'.$title.'")');
                                
                                $this->loadModel('User');
                                $user = $this->User->find('all', array('conditions' => array('id = ' => $login_id)));
                                $score = $user[0]['User']['score'] + 5;
                                $this->loadModel('Question');
                                $this->Question->Query('update users set score = '.$score.' where id = '.$login_id);
                                
                                $this->Session->setFlash('You have successfully formed part of a class challenge');
                                $this->redirect(array('action'=>'many_to_many'));
                            }
                        }else if(!empty($to_school)){
                            $user = $this->User->find('all', array('conditions'=>array('id'=>$login_id)));
                            $school_id = $to_school[0]['School']['school_id'];
                            if($user[0]['User']['school_id'] === $school_id){
                                $this->Session->setFlash('Sorry, you cannot form a challenge to your own school!');
                                $this->redirect(array('action'=>'choose_target_many_to_many', $difficulty, $questions, 'NULL', $username));
                            } else {
                                if(count($qns_array) != 1){
                                    //$this->send_challenge($difficulty, $questions );
                                    $this->Session->setFlash('You need to choose 1 question to form part of a school challenge!');
                                    $this->redirect(array('action'=>'choose_target_many_to_many', $difficulty, $questions, 'NULL', $username, $title));
                                }
                                
                                $this->Challenge->Query('insert into form_challenges (difficulty_level, questions, formed_by, to_school, challenge_title) values ("'.$difficulty.'","'.$questions.'",'.$login_id.','.$school_id.',"'.$title.'")');
                                
                                $this->loadModel('User');
                                $user = $this->User->find('all', array('conditions' => array('id = ' => $login_id)));
                                $score = $user[0]['User']['score'] + 5;
                                $this->loadModel('Question');
                                $this->Question->Query('update users set score = '.$score.' where id = '.$login_id);
                                
                                $this->Session->setFlash('You have successfully formed part of a school challenge');
                                $this->redirect(array('action'=>'many_to_many'));
                            }
                        }
                    }
                }
            }
        }
    }
    
    Function choose_questions_many_to_many($difficulty = NULL, $chosen_qns = NULL, $username='', $title=''){
        $this->layout='challengeTemplate';
        //login user
        $login_id = $this->Session->read('User.id');
        $this->loadModel('Question');
        $questions = $this->Question->find('all', array('conditions'=>array('raised_by'=>$login_id, 'status'=>'accept')));
        
        if(empty($this->data)){
            $this->set('questions', $questions);
            $this->set('difficulty', $difficulty);
            if($chosen_qns === 'NULL'){$chosen_qns = NULL;}
            $this->set('chosen_qns', $chosen_qns);
            $this->set('username', $username);
            $this->set('title', $title);
        } else {
            $questions_id = '';
            $count = 0;  
            foreach($this->data as $temp){
            
                if($temp === '1'){
                    $qn = $questions[$count];
                    $questions_id = $questions_id.$qn['Question']['question_id'].';';
                }
                $count++;   
            }
            $questions_id = substr($questions_id, 0, -1);
            $this->redirect(array('action'=>'choose_target_many_to_many', $difficulty, $questions_id, 'NULL', $username, $title));
        }
        
    }
    
    Function many_to_many(){
        $this->layout='challengeTemplate';
        $login_id = $this->Session->read('User.id');
        
        $this->loadModel('User');
        $login_user = $this->User->find('all', array('conditions'=>array('id'=>$login_id)));
        
        $school = $login_user[0]['User']['school_id'];
        $class = $login_user[0]['User']['class_id'];
        
        $this->loadModel('FormChallenge');
        $class_challenge = $this->FormChallenge->Query('select * from form_challenges where to_school=0');
        $school_challenge = $this->FormChallenge->Query('select * from form_challenges where to_class=0');
        foreach($class_challenge as $key=>$temp){
            $formed_by = explode(';', $temp['form_challenges']['formed_by']);
            $formed_user = $this->User->find('all', array('conditions'=>array('id'=>$formed_by[0])));
            $formed_class = $formed_user[0]['User']['class_id'];
            if($formed_class != $class){
                unset($class_challenge[$key]);
            }
        }
        
        foreach($school_challenge as $key=>$temp){
            $formed_by = explode(';', $temp['form_challenges']['formed_by']);
            $formed_user = $this->User->find('all', array('conditions'=>array('id'=>$formed_by[0])));
            $formed_school = $formed_user[0]['User']['school_id'];
            if($formed_school != $school){
                unset($school_challenge[$key]);
            }
        }
        
        //$numCollaborators = $this->FormChallenge->Query('select * from form_challenges where to_school=0');
        //$qns_array = explode(';', $questions);
        $this->set('class', $class_challenge);
        $this->set('school', $school_challenge);
    }
    
    Function add_many_to_many($id = NULL, $chosen_qns=NULL){
        $this->layout='challengeTemplate';
        $login_id = $this->Session->read('User.id');
        $this->loadModel('Question');
        $questions = $this->Question->find('all', array('conditions'=>array('raised_by'=>$login_id, 'status'=>'accept')));
        
        if(empty($this->data)){
            $this->set('questions', $questions);
            $this->set('challenge_id', $id);
            $this->set('chosen_qns', $chosen_qns);
        } else {
            $questions_id = '';
            $count = 0;  
            foreach($this->data as $temp){
            
                if($temp === '1'){
                    $qn = $questions[$count];
                    $questions_id = $questions_id.$qn['Question']['question_id'].';';
                }
                $count++;   
            }
            $questions_id = substr($questions_id, 0, -1);
            $qns_array = explode(';', $questions_id);
            if(count($qns_array) === 1){
                $this->redirect(array('action'=>'form_challenge', $id, $questions_id));
            } else {
                $this->Session->setFlash('Please select one questions to form part of the challenge!');
                $this->redirect(array('action'=>'add_many_to_many', $id, $questions_id));
            }
        }
    }
    
    Function form_challenge($challenge_id = NULL, $chosen_qns = NULL){
        $this->layout='challengeTemplate';
        $login_id = $this->Session->read('User.id');
        
        //retrieve the challenge need to be formed
        $this->loadModel('FormChallenge');
        
        $challenge = $this->FormChallenge->Query('select * from form_challenges where id = '.$challenge_id);
        $challenge = $challenge[0]['form_challenges'];
        
        $difficulty = $challenge['difficulty_level'];
        
        $formed_by = $challenge['formed_by'];
        $formed_by_array = explode(';', $formed_by);
        $count = count($formed_by_array);
        $formed_by_final = $formed_by.';'.$login_id;
        
        $questions_final = $challenge['questions'].';'.$chosen_qns;
        
        $new_challenge = false;
        
        if($difficulty === 'easy'){
            if($count === 4){
                $new_challenge = true;
            }
        } else if($difficulty === 'medium'){
            if($count === 9){
                $new_challenge = true;
            }
        } else {
            if($count === 14){
                $new_challenge = true;
            }
        }
        
        
        if($new_challenge){
            $challenge_title = $challenge['challenge_title'];
            $to_school = $challenge['to_school'];
            $to_class = $challenge['to_class'];
            
            if($to_school === NULL){
                $this->Challenge->Query('insert into challenges (difficulty_level, questions, formed_by, challenge_title, to_class) 
                    values ("'.$difficulty.'","'.$questions_final.'","'.$formed_by_final.'","'.$challenge_title.'","'.$to_class.'")');
            } else if($to_class === NULL){
                $this->Challenge->Query('insert into challenges (difficulty_level, questions, formed_by, challenge_title, to_school) 
                    values ("'.$difficulty.'","'.$questions_final.'","'.$formed_by_final.'","'.$challenge_title.'","'.$to_school.'")');
            }
            
            $this->Challenge->Query('delete from form_challenges where id='.$challenge_id);
        } else {
            $this->loadModel('FormChallenge');
            $this->FormChallenge->Query('update form_challenges set questions="'.$questions_final.'", formed_by="'.$formed_by_final.'" where id='.$challenge_id);
        } 
        
        $this->loadModel('User');
        $user = $this->User->find('all', array('conditions' => array('id = ' => $login_id)));
        $score = $user[0]['User']['score'] + 5;
        $this->loadModel('Question');
        $this->Question->Query('update users set score = '.$score.' where id = '.$login_id);
        
        $this->Session->setFlash('You have successfully formed a challenge!');
        $this->redirect(array('action'=>'many_to_many'));
    }
 }

?>
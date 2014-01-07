<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php

App::uses('AppController', 'Controller');

class DesksController extends AppController {
    
    Function  little_desk(){
        $this->layout=('deskTemplate');
    }
    
    Function  my_desk(){
        $this->layout=('deskTemplate');
    }
    
    Function  my_tutee_desk(){
        $this->layout=('deskTemplate');
    }
    
    Function display_all() {
        $this->layout=('navigation');
        $this->loadModel('LittleDeskQuestion');
        $this->set('displayall', $this->LittleDeskQuestion->find('all'));
    }
    
    Function category_questions($categoryType =''){
        $this->layout=('deskTemplate');
        $this->set('categoryType',$categoryType);
        
        //Retrieve all question related to category from database
        $this->loadModel('DeskQuestion');
        $allQuestions = $this->DeskQuestion->Query('SELECT * from desk_questions WHERE category="'.$categoryType.'"');
        $this->loadModel('DeskQuestionsReplies');
        $allResponse = $this->DeskQuestionsReplies->Query('SELECT * FROM desk_questions_replies');
        $this->set('allQuestions',$allQuestions);
        $this->set('allResponse',$allResponse);
        //pr($allQuestions);die();
    }
    
    Function process_add_new_thread($categoryType=''){
        $questionData = $this->request->data;
        $question_content = $questionData['NewDeskQuestion']['newQuestion'];
        $asked_by_user = $questionData['NewDeskQuestion']['askedBy'];
        $this->loadModel('DeskQuestion');
        $this->DeskQuestion->Query('INSERT INTO desk_questions (asked_by, qns_content, category) VALUES ("'.$asked_by_user.'","'.$question_content.'","'.$categoryType.'")');
        $this->Session->setFlash('You have successfully posted a question!');
        $this->redirect(array('controller'=>'desks','action'=>'category_questions',$categoryType));
    }
    
    Function viewQuestion($qnsId=''){
        $this->layout=('deskTemplate');
        $this->loadModel('DeskQuestion');
        $foundQnsArray=$this->DeskQuestion->Query('SELECT * FROM desk_questions WHERE qns_id="'.$qnsId.'"');
        $this->set('foundQnsArray',$foundQnsArray);
        //pr($foundQnsArray);die();
        $this->loadModel('DeskQuestionsReplies');
        $qnsReplies = $this->DeskQuestionsReplies->Query('SELECT * FROM desk_questions_replies WHERE qns_id="'.$qnsId.'" ORDER BY timestamp DESC');
        $this->set('qnsReplies',$qnsReplies);
    }
    
    Function process_add_new_reply($qnsId=''){
        $replyData = $this->request->data;
        $repliedBy = $replyData['NewDeskReply']['repliedBy'];
        $replyContent = $replyData['NewDeskReply']['newReply'];
        $this->loadModel('DeskQuestionsReplies');
        $this->DeskQuestionsReplies->Query('INSERT INTO desk_questions_replies (qns_id, replied_by, reply_content) VALUES("'.$qnsId.'","'.$repliedBy.'","'.$replyContent.'")');
        $this->Session->setFlash('Replied successfully! Thank you!');
        $this->redirect(array('controller'=>'desks','action'=>'viewQuestion',$qnsId));
        pr($replyData);die();
        
    }
    
    Function post_question() {

        if (!empty($this->data)) {
            $this->loadModel('LittleDeskQuestion');
            if ($this->LittleDeskQuestion->save($this->data)) {
                $this->loadModel('LittleDeskQuestion');
                $lastPost = $this->LittleDeskQuestion->Query('SELECT MAX(desk_id) AS lastNum FROM little_desk_questions');
                $tempLast = $lastPost[0][0]['lastNum'];

                $this->loadModel('User');
                $maxId = $this->User->Query('SELECT MAX(id) AS HighestNum FROM users');
                $minId = $this->User->Query('SELECT MIN(id) AS LowestNum FROM users');
                $randomNumber1 = rand($maxId[0][0]['HighestNum'], $minId[0][0]['LowestNum']);
                $findAllId = $this->User->find('all');
                $temp = 0;

                $getRandomCollaborator1 = $this->generate($randomNumber1);
                $tempCollaborator1 = $getRandomCollaborator1;
                while ($tempCollaborator1 == 0) {

                    $getRandomCollaborator1 = $this->generate($randomNumber1);
                }
                $randomNumber2 = rand($maxId[0][0]['HighestNum'], $minId[0][0]['LowestNum']);
                $getRandomCollaborator2 = $this->generate($randomNumber2);
                $tempCollaborator2 = $getRandomCollaborator2;
                while ($tempCollaborator2 == 0 || $randomNumber1 == $randomNumber2) {
                    $randomNumber2 = rand($maxId[0][0]['HighestNum'], $minId[0][0]['LowestNum']);
                    $getRandomCollaborator2 = $this->generate($randomNumber2);
                }
                $this->loadModel('DeskCollaborator');

                $retriveUserName1 = $this->LittleDeskQuestion->Query('SELECT username from users where id = ' . $randomNumber1);
                $retriveUserName2 = $this->LittleDeskQuestion->Query('SELECT username from users where id = ' . $randomNumber2);

                $saveCollaborators = array('DeskCollaborator' => array('desk_id' => $tempLast, 'requested_by' => 'Michael', 'collaborator1' => $retriveUserName1[0]['users']['username'], 'collaborator2' => $retriveUserName2[0]['users']['username']));

                $this->DeskCollaborator->save($saveCollaborators);
            } else {

                $this->Session->setFlash('The question was not saved, please try again');
            }
        }
    }

    Function generate($random) {
        $temp = 0;
        $count = 0;
        $this->loadModel('User');
        $maxId = $this->User->Query('SELECT MAX(id) AS HighestNum FROM users');
        $minId = $this->User->Query('SELECT MIN(id) AS LowestNum FROM users');
        $randomNumber = rand($maxId[0][0]['HighestNum'], $minId[0][0]['LowestNum']);
        $findAllId = $this->User->find('all');


        foreach ($findAllId as $getIdValue) {

            if ($getIdValue['User']['id'] == $random) {
                $temp++;
            }
            $count++;
        }
        return $temp;
    }

    function reply_post($desk_id = NULL) {
        //$this->loadModel('LittleDeskQuestion');
        //$this->Post->setSource('vote');
        if (empty($this->data)) {
            $this->loadModel('LittleDeskQuestion');
            //$this->set('turtle', $this->LittleDeskQuestion->read(NULL, $desk_id));
            //$this->data = $this->LittleDeskQuestion->read(NULL, $desk_id);
            $result = $this->LittleDeskQuestion->Query('SELECT * from little_desk_questions where desk_id = ' . $desk_id);
            $retrieveQuestion = $result[0]['little_desk_questions']['question'];
            //$this->set('id', $this->LittleDeskQuestion->read(NULL, $result));

            $this->set('retrieveQuestion', $retrieveQuestion);
        } else {
            $this->loadModel('LittleDeskReplie');
            //$this->LittleDeskQuestion->save($this->data);
            $id = $desk_id;
            $replied_by = 'John';
            $replied_body = $this->data['LittleDeskReplie']['reply_body'];

            $datas = array('LittleDeskReplie' => array('reply_id' => '', 'desk_id' => $id, 'replied_by' => $replied_by, 'timestamp' => '', 'reply_body' => $replied_body));

            $this->LittleDeskReplie->save($datas);

            $this->Session->setFlash('The post has been updated.');

            $this->redirect(array('controller' => 'HelpDesk', 'action' => 'display_all'));
        }
    }

    Function rate_questions($difficulty = NULL, $chosen_qns = NULL, $username = '') {
        //login user
        $login_id = $this->Session->read('User.id');
        $this->loadModel('Question');
        $questions = $this->Question->find('all', array('conditions' => array('raised_by' => $login_id, 'status' => 'accept')));

        if (empty($this->data)) {
            $this->set('questions', $questions);
            $this->set('difficulty', $difficulty);
            if ($chosen_qns === 'NULL') {
                $chosen_qns = NULL;
            }
            $this->set('chosen_qns', $chosen_qns);
            $this->set('username', $username);
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
            $this->redirect(array('action' => 'choose_target', $difficulty, $questions_id, 'NULL', $username));
        }
    }

    Function questions_reply() {

        $this->loadModel('LittleDeskQuestion');
        $this->set('displayallquestion', $this->LittleDeskQuestion->find('all'));

        $this->loadModel('LittleDeskReplie');
        $this->set('displayallreplies', $this->LittleDeskReplie->find('all'));
    }

    Function rate_replie($reply_id = NULL) {

        $this->loadModel('LittleDeskReplie');
        if (empty($this->data)) {
            $this->set('reply', $this->LittleDeskReplie->find('all', array('conditions' => array('reply_id = ' => $reply_id))));
        } else {
            $this->loadModel('Rate');
            $retriveVoteValue = $this->data['Rate']['VotedReply'];
            $this->Session->setFlash($reply_id);


            $replied_by = '1';


            $datas = array('Rate' => array('reply_id' => $reply_id, 'rated_by' => $replied_by, 'rate' => $retriveVoteValue, 'timestamp' => ''));

            $this->Rate->save($datas);

            $this->redirect(array('controller' => 'HelpDesk', 'action' => 'questions_reply'));
        }
    }

}

?>
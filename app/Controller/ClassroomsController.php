<?php

App::uses('AppController', 'Controller');

class ClassroomsController extends AppController {

    //Homepage of little classroom
    Function little_classroom() {
        $this->layout='classroomTemplate';
        $login_id = $this->Session->read('User.id');
        $my_classroom = $this->Classroom->Query('select * from classrooms, classroom_collaborators where classrooms.classroom_id = classroom_collaborators.classroom_id and collaborator = ' . $login_id);
        $this->set('my_classroom', $my_classroom);
        $other_published_classroom = $this->Classroom->Query('select * from classrooms where published = 1 and classroom_id not in(select classroom_id from classroom_collaborators where collaborator = ' . $login_id . ')');
        $this->set('other_classroom', $other_published_classroom);
    }

    //create new classroom
    Function classroom_category() {
        $this->layout='classroomTemplate';
    }

    Function classroom_title($category = NULL) {
         $this->layout='classroomTemplate';
        $this->set('category', $category);
        $this->set('login_id', $this->Session->read('User.id'));
    }

    Function process_create_classroom() {
        if (empty($this->data['Classroom']['title'])) {
            $this->Session->setFlash('Please enter a title for the classroom!');
            $this->redirect(array('action' => 'classroom_title', $this->data['Classroom']['category']));
        } else {
            $this->Classroom->save($this->data);
            $classroom = $this->Classroom->find('all', array('conditions' => array('title' => $this->data['Classroom']['title'])));
            $classroom_id = $classroom[0]['Classroom']['classroom_id'];
            $login_id = $this->Session->read('User.id');
            $this->Classroom->Query('insert into classroom_collaborators (classroom_id, collaborator) values (' . $classroom_id . ',' . $login_id . ')');
            $this->redirect(array('action' => 'create_classroom', $this->data['Classroom']['title'], $classroom_id));
        }
    }

    Function create_classroom($title = NULL, $classroom_id = NULL) {
        $this->layout='classroomTemplate';
        $this->set('title', $title);
        $this->set('classroom_id', $classroom_id);
    }
    
    Function process_paragraph_conversion(){
        $contentData = $this->request->data;
        pr($contentData);die();
    }
    //$content should be an array
    Function process_save_new_classroom() {
        //there should be an array passing in (the content should be stored according to it position
        $contentData = $this->request->data;
        $content = array($contentData['Content']['intro'], $contentData['Content']['p1'], $contentData['Content']['p2'],$contentData['Content']['p3'],$contentData['Content']['conclusion']);

        if (array_key_exists('back', $this->data)) {
            $this->redirect(array('action' => 'little_classroom'));
        }

        $login_id = $this->Session->read('User.id');
        $classroom_id = $this->data['Content']['classroom_id'];
        $this->loadModel('Content');
        $this->Content->Query('insert into history (classroom_id, edited_by, version_number) values (' . $classroom_id . ',' . $login_id . ',1)');
        $count = 1;
        foreach ($content as $temp) {
            $this->Content->Query('insert into contents (classroom_id, version_number, content, position) values (' . $classroom_id . ',1,"' . $temp . '",' . $count . ')');
            $count++;
        }

        if (array_key_exists('publish', $this->data)) {
            $this->Classroom->Query('update classrooms set published=1 where classroom_id = ' . $classroom_id);
            $this->Session->setFlash('You have successfully save and publish your classroom!');
        } else {
            $this->Session->setFlash('You have successfully save your classroom!');
        }
        $this->redirect(array('controller'=>'classrooms','action' => 'little_classroom'));
        //$this->redirect(array('action' => 'edit', $classroom_id));
    }

    Function edit($classroom_id) {
        $this->layout='classroomTemplate';
        $version = $this->Classroom->Query('select max(version_number) from history where classroom_id=' . $classroom_id);
        $version = $version[0][0]['max(version_number)'];
        $content_array = array();
        if (empty($version)) {
            $version = 0;
        } else {
            $content = $this->Classroom->Query('select * from contents where classroom_id=' . $classroom_id . ' and version_number=' . $version . ' order by position');
            foreach ($content as $temp) {
                $content_array[$temp['contents']['position'] - 1] = $temp['contents']['content'];
            }
        }

        $classroom = $this->Classroom->find('all', array('conditions' => array('classroom_id' => $classroom_id)));

        $this->set('title', $classroom[0]['Classroom']['title']);
        $this->set('version', $version);
        $this->set('content', $content_array);
        $this->set('classroom_id', $classroom_id);

        $this->set('published', $classroom[0]['Classroom']['published']);
    }

    Function process_save_edited_classroom() {

        //supposed to pass in the edited content
        //$this->request->data;
        
        $contentData = $this->request->data;
        $content = array($contentData['Content']['intro'], $contentData['Content']['p1'], $contentData['Content']['p2'],$contentData['Content']['p3'],$contentData['Content']['conclusion']);
        //pr($content);die();
        if (array_key_exists('back', $this->data)) {
            $this->redirect(array('action' => 'edit', $this->data['Content']['classroom_id']));
        }

        $login_id = $this->Session->read('User.id');
        $classroom_id = $this->data['Content']['classroom_id'];
        $this->loadModel('Content');
        $this->Content->Query('insert into history (classroom_id, edited_by, version_number) values (' . $classroom_id . ',' . $login_id . ',' . $this->data['Content']['version_number'] . ')');
        $count = 1;
        foreach ($content as $temp) {
            $this->Content->Query('insert into contents (classroom_id, version_number, content, position) values (' . $classroom_id . ',' . $this->data['Content']['version_number'] . ',"' . $temp . '",' . $count . ')');
            $count++;
        }

        if (array_key_exists('publish', $this->data)) {
            $this->Classroom->Query('update classrooms set published=1 where classroom_id = ' . $classroom_id);
            $this->Session->setFlash('You have successfully save and publish your classroom!');
        } else {
            $this->Session->setFlash('You have successfully save your classroom!');
        }

        $this->redirect(array('controller'=>'classrooms','action' => 'little_classroom'));
    }

    Function delete($classroom_id = NULL) {
        $this->Classroom->Query('delete from classrooms where classroom_id=' . $classroom_id);
        $this->Classroom->Query('delete from classroom_collaborators where classroom_id=' . $classroom_id);
        $this->Classroom->Query('delete from history where classroom_id=' . $classroom_id);
        $this->Classroom->Query('delete from contents where classroom_id=' . $classroom_id);
        $this->redirect(array('action' => 'little_classroom'));
    }

    Function view_collaborator($classroom_id) {
        $this->layout='classroomTemplate';
        $collaborator_id = $this->Classroom->Query('select collaborator from classroom_collaborators where classroom_id=' . $classroom_id);
        $collaborator = array();
        $this->loadModel('User');
        $count = 0;
        foreach ($collaborator_id as $temp) {
            $user = $this->User->find('all', array('conditions' => array('id' => $temp['classroom_collaborators']['collaborator'])));
            $collaborator[$count] = $user[0]['User']['username'];
            $count++;
        }

        $this->set('collaborator', $collaborator);

        $classroom = $this->Classroom->find('all', array('conditions' => array('classroom_id' => $classroom_id)));
        $title = $classroom[0]['Classroom']['title'];
        $this->set('classroom_id', $classroom_id);
        $this->set('title', $title);
    }

    Function add_collaborator($classroom_id = NULL) {
        $this->layout='classroomTemplate';
        $classroom = $this->Classroom->find('all', array('conditions' => array('classroom_id' => $classroom_id)));
        $title = $classroom[0]['Classroom']['title'];
        $this->set('classroom_id', $classroom_id);
        $this->set('title', $title);

        $collaborator_id = $this->Classroom->Query('select collaborator from classroom_collaborators where classroom_id=' . $classroom_id);
        $collaborator = array();
        $this->loadModel('User');
        $count = 0;
        foreach ($collaborator_id as $temp) {
            $user = $this->User->find('all', array('conditions' => array('id' => $temp['classroom_collaborators']['collaborator'])));
            $collaborator[$count] = $user[0]['User']['username'];
            $count++;
        }

        $this->set('collaborator', $collaborator);
    }

    Function process_add_collaborator() {
        $classroom_id = $this->data['ClassroomCollaborator']['classroom_id'];

        if (array_key_exists('cancel', $this->data)) {
            $this->redirect(array('action' => 'view_collaborator', $classroom_id));
        }

        $this->loadModel('User');
        if (array_key_exists('add', $this->data)) {
            $user = $this->User->find('all', array('conditions' => array('username' => $this->data['ClassroomCollaborator']['collaborator'])));
            if (empty($user)) {
                $this->Session->setFlash('Please enter a valid username!');
                $this->redirect(array('action' => 'add_collaborator', $classroom_id));
            } else {
                $user_id = $user[0]['User']['id'];
                $this->loadModel('ClassroomCollaborator');
                $existing = $this->ClassroomCollaborator->find('all', array('conditions' => array('classroom_id' => $classroom_id)));
                $not_exist = true;

                foreach ($existing as $temp) {
                    if ($user_id === $temp['ClassroomCollaborator']['collaborator']) {
                        $not_exist = false;
                        break;
                    }
                }

                if (!$not_exist) {
                    $this->Session->setFlash($this->data['ClassroomCollaborator']['collaborator'] . ' is an existing collaborator!');
                    $this->redirect(array('action' => 'add_collaborator', $classroom_id));
                }

                $this->ClassroomCollaborator->Query('insert into classroom_collaborators (classroom_id, collaborator) values (' . $this->data['ClassroomCollaborator']['classroom_id'] . ',' . $user_id . ')');
                $this->Session->setFlash($this->data['ClassroomCollaborator']['collaborator'] . ' has been successfully added!');
                $this->redirect(array('controller'=>'classrooms','action' => 'add_collaborator', $classroom_id));
            }
        }
    }

}

?>

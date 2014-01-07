<?php

App::uses('AppController', 'Controller');

class ProfilesController extends AppController {

    Function index() {
        $this->layout = 'profileTemplate';
    }

    Function addNewsFeed() {
        $statusFeed = $this->request->data;
        $userID = $this->Session->read('User.id');
        $userGroupID = 0;
        ;
        $this->loadModel('Post');
        $wallOwner = $statusFeed['NewWallPost']['wallOwner'];
        $this->loadModel('User');
        $selectedUser = $this->User->Query('SELECT id FROM users WHERE username="' . $wallOwner . '"');
        $newPostFeed = $statusFeed['NewWallPost']['newPost'];
        //pr($selectedUser[0]['users']['id']);die();
        $this->Post->Query('Insert into posts (posted_by, to_who, group_id, post_content) values ("' . $userID . '", "' . $selectedUser[0]['users']['id'] . '", "' . $userGroupID . '","' . $newPostFeed . '")');
        $location = $statusFeed['NewWallPost']['location'];
        if ($location == 0) {
            $this->redirect(array('controller' => 'users', 'action' => 'success'));
        } else {
            $this->redirect(array('controller' => 'profiles', 'action' => 'viewProfile', $wallOwner));
        }
    }

    Function viewProfile($username = '') {
        $currentUsername = $this->Session->read('User.username');
        if ($currentUsername == $username) {
            $this->redirect(array('controller' => 'profiles', 'action' => 'myProfile', $username));
        } else {
            $this->redirect(array('controller' => 'profiles', 'action' => 'otherProfiles', $username));
        }
    }

    Function myProfile($username = '') {
        $this->layout = 'profileTemplate';
        $this->loadModel('User');
        $userArray = $this->User->Query('SELECT * FROM users WHERE id="' . $this->Session->read('User.id') . '"');
        $this->set('userArray', $userArray);
        $otherUsers = $this->User->Query('SELECT * FROM users');
        $this->set('otherUsers', $otherUsers);

        $this->loadModel('Post');
        $userId = $this->Session->read('User.id');
        $notificationArray = $this->Post->Query('SELECT * FROM posts WHERE to_who="' . $userId . '" ORDER BY timestamp DESC');
        $this->set('notificationArray', $notificationArray);

        $this->loadModel('Challenge');
        $challengesToOthers = $this->Challenge->Query('SELECT * FROM challenges WHERE formed_by="' . $this->Session->read('User.id') . '"');
        $this->set('challengesToOthers', $challengesToOthers);

        $this->loadModel('School');
        $allSchools = $this->User->Query('SELECT * FROM schools');
        $this->set('allSchools', $allSchools);

        //pass array of class to view
        $this->loadModel('Class');
        $allClasses = $this->User->Query('SELECT * FROM classes');
        $this->set('allClasses', $allClasses);

        $this->loadModel('Friend');
        $allMyFriends = $this->Friend->Query('SELECT * FROM friends WHERE owner_id="' . $userId . '"');
        $this->set('allMyFriends', $allMyFriends);
    }

    Function otherProfiles($username = '') {
        $this->layout = 'profileTemplate';
        $this->set('username', $username);
        $this->loadModel('User');
        $userArray = $this->User->Query('SELECT * FROM users WHERE username="' . $username . '"');
        $this->set('userArray', $userArray);

        $otherUsers = $this->User->Query('SELECT * FROM users');
        $this->set('otherUsers', $otherUsers);

        $this->loadModel('Post');
        $userFound = $this->User->Query('SELECT id FROM users WHERE username="' . $username . '"');
        $userId = $userFound[0]['users']['id'];
        $notificationArray = $this->Post->Query('SELECT * FROM posts WHERE to_who="' . $userId . '" ORDER BY timestamp DESC');
        $this->set('notificationArray', $notificationArray);

        $this->loadModel('Challenge');
        $challengesToOthers = $this->Challenge->Query('SELECT * FROM challenges WHERE formed_by="' . $userId . '"');
        $this->set('challengesToOthers', $challengesToOthers);

        $this->loadModel('School');
        $allSchools = $this->User->Query('SELECT * FROM schools');
        $this->set('allSchools', $allSchools);

        //pass array of class to view
        $this->loadModel('Class');
        $allClasses = $this->User->Query('SELECT * FROM classes');
        $this->set('allClasses', $allClasses);

        $this->loadModel('Friend');
        $allMyFriends = $this->Friend->Query('SELECT * FROM friends WHERE owner_id="' . $userId . '"');
        $this->set('allMyFriends', $allMyFriends);
    }

    Function findFriends() {
        $searchData = $this->request->data;
        $targetUser = $searchData['SearchFriends']['enterFriends'];

        $currentUser = $this->Session->read('User.username');
        if ($currentUser == $targetUser) {
            $this->redirect(array('controller' => 'profiles', 'action' => 'myProfile', $currentUser));
        } else {
            $this->loadModel('User');
            $userArray = $this->User->Query('SELECT * FROM users WHERE username="' . $targetUser . '"');
            if (empty($userArray)) {
                $this->Session->setFlash('No such user found! Please try again.');
                $this->redirect(array('controller' => 'profiles', 'action' => 'myProfile', $currentUser));
            } else {
                $this->redirect(array('controller' => 'profiles', 'action' => 'otherProfiles', $targetUser));
                //pr($userArray);die();
            }
        }
    }

    Function addFriend($username = '') {
        $this->loadModel('Friend');
        $currentUser = $this->Session->read('User.id');
        $this->loadModel('User');
        $potentialFriend = $this->User->Query('SELECT id FROM users WHERE username ="' . $username . '"');
        $potentialFriendId =  $potentialFriend[0]['users']['id'];
        $this->Friend->Query('INSERT INTO friends (owner_id, friend_id) VALUES ("' . $currentUser . '","' . $potentialFriendId . '")');
        $this->Friend->Query('INSERT INTO friends (owner_id, friend_id) VALUES ("' . $potentialFriendId . '","' . $currentUser . '")');
        $content = $this->Session->read('User.username').' has just added '.$username.' as friends!';
        $this->loadModel('Post');
        $this->Post->Query('INSERT INTO posts (posted_by, to_who, post_content) VALUES ("' . $currentUser . '","' . $potentialFriendId . '","'.$content .'")');
        $this->Post->Query('INSERT INTO posts (posted_by, to_who, post_content) VALUES ("' . $potentialFriendId . '","' . $currentUser . '","'.$content .'")');
        $this->Session->setFlash('You have successfully added ' . $username);
        $this->redirect(array('controller'=>'profiles','action' => 'viewProfile', $username));
    }

    Function deleteFriend($username = '') {
        $this->loadModel('Friend');
        $currentUser = $this->Session->read("User.id");
        $this->loadModel('User');
        $currentFriend = $this->User->Query('SELECT id FROM users WHERE username ="' . $username . '"');
        $currentFriendId =  $currentFriend[0]['users']['id'];
        $this->Friend->Query('Delete from friends where owner_id=' . $currentUser . ' and friend_id=' . $currentFriendId);
        $this->Friend->Query('Delete from friends where owner_id=' . $currentFriendId . ' and friend_id=' . $currentUser);

        $this->Session->setFlash('You have just unfriend ' . $username);
        $this->redirect(array('controller'=>'profiles','action' => 'viewProfile', $username));
    }

}

?>

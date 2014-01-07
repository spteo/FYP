<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController{
    
    //Display the login page. Default route comes to here.
    public function index(){
        $this->layout='login';
    }
    
    function success(){
        $this->layout='navigation';
        $this->loadModel('Post');
        $notificationArray = $this->Post->Query('SELECT * FROM posts ORDER BY timestamp DESC');
        $this->set('notificationArray',$notificationArray);
        
        $this->loadModel('User');
        $userArray = $this->User->Query('SELECT * FROM users');
        $this->set('userArray',$userArray);
    }
    
    //Function: To perform validation of login. And writing the valid user to the session object. 
    function process_login(){
      if($this->Session->read('resetPassword')!=''){
        $this->Session->delete('resetPassword');
      }
      if($this->Session->read('resetUsername')!=''){
        $this->Session->delete('resetUsername');
      }
       $userData = $this->request->data;
       $this->loadmodel('User');
       $foundUser = $this->User->Query('select * from users where username="'.$userData['User']['username'].'"');
       //pr($foundUser);die();
       //Condition 1: Check if the there is such user by querying the database. If not found, login fails.
       if(empty($foundUser)){
            $this->Session->setFlash('Please enter a valid username / password! ');
            $this->redirect(array('action' => 'index'));
        }
        
        //Condition 2: Check if the user password matches the one in the database. If match, redirect to the scoreboard page.
        elseif ($userData['User']['password']==$foundUser[0]['users']['password']) {
            $this->Session->write('User.username', $foundUser[0]['users']['username']);
            $this->Session->write('User.id', $foundUser[0]['users']['id']);
            //To be change after styling of the homepage (scoreboard)
            $this->redirect(array('action' => 'success'));
        } 
        
        //Condition 3: If password don't match, return back to the login page. 
        else {
            $this->Session->setFlash('Invalid username/password. Please try again!');
            $this->redirect(array('action' => 'index'));
        }
    }
    
    //Display the layout to the user to let the user retrieve the password
    function forgetPassword(){
        //pr("Here"); die();
        $this->layout='login';
    }
   
    //Function: Logic to reset and retrieve user password.
    function process_forgetPassword(){
        $userData = $this->request->data;
        //pr($userData);die();
        $enteredUsername = $userData['User']['Enter your Username']; //pr($enteredUsername);
        $enteredNRIC = $userData['User']['Enter your ID Number']; //pr($enteredNRIC); die();
        //Condition 1: Check for empty fields!
        if(empty($enteredUsername)|| empty($enteredNRIC)){
            if(empty($enteredUsername)){
                $this->Session->setFlash('Please entered an username! ');
                $this->redirect(array('action' => 'forgetPassword'));
            }
            else{
                $this->Session->setFlash('Please enter your ID!');
                $this->redirect(array('action' => 'forgetPassword'));
            }
        }
        $foundUser = $this->User->Query('select * from users where username="'.$enteredUsername.'"');
        $foundUserIC = $foundUser[0]['users']['nric'];
        //Condition 1: No such user.
        if(empty($foundUser)){
            $this->Session->setFlash('You have entered an invalid username / ID !');
            $this->redirect(array('action' => 'forgetPassword'));
        } 
        //Condition 2: IC number is wrong
        elseif($enteredNRIC != $foundUserIC){
            $this->Session->setFlash('You have entered an invalid username / ID !');
            $this->redirect(array('action' => 'forgetPassword'));
        }
        //Condition 3: Performing Password Reset.
        else{
           $randomWords = array(1=>"excited",2=>"happy",3=>"proactive",4=>"enthusiastic",5=>"elated");
           $randomChosenWord = $randomWords[rand(1,5)];
           $random3Numbers = rand(100,1000);
           $newPassword = $randomChosenWord.$random3Numbers;
           $this->Session->write('resetPassword',$newPassword);
           $this->User->Query("UPDATE users SET password='".$newPassword."'WHERE nric='".$foundUserIC."'");
           $this->Session->write('resetUsername',$foundUser[0]['users']['username']);
           $this->redirect(array('action' => 'showNewPassword'));
        }
        
    }
    
    function showNewPassword(){
        $this->Session->setFlash('Success! Password resetted!');
        $this->layout='login';
    }
    
    function process_logout(){
        $this->Session->destroy();
        $this->redirect(array('action' => 'index'));
    }
}
?>

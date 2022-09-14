<?php

class UsersController extends AppController {

  public function index(){
    
  }

  public function beforeFilter() {
    parent::beforeFilter();
    date_default_timezone_set('Asia/Manila');
    $this->Auth->allow('register', 'login', 'thankyou');
  }

  public function login() {
    if($this->Session->check('Auth.User')){
			$this->redirect(array('action' => 'index'));
		}
    
    if ($this->request->is('post')) {
      if ($this->Auth->login()) {
        $user = $this->Session->read("Auth.User");
        $this->User->id = $user['id'];
        $this->User->saveField('last_login', date('Y-m-d H:i:s'));

        $this->Flash->success(__('Successfully login'));
        return $this->redirect($this->Auth->redirectUrl());
      }
      $this->Flash->error(
        __('Email or password is incorrect')
      );
    }
  }

  public function logout(){
    $this->Flash->success(__('Successfully logout'));
    $this->redirect($this->Auth->logout());
  }

  public function register(){
    if($this->request->is('post')){
      $this->User->create();
      if($this->User->save($this->request->data)) {
        $this->Flash->success(__('The user has been saved'));
        return $this->redirect(array('action' => 'thankyou'));
      }
      $this->Flash->error(
        __('The user could not be saved. Please, try again.')
    );
    }
  }

  public function thankyou(){
    if($this->Session->check('Auth.User')){
			$this->redirect(array('action' => 'index'));
		}
  }

  public function profile(){
    $user = $this->User->findById(AuthComponent::user('id'));
		$this->set(compact('user'));
  }

  public function edit(){
    $user = $this->User->findById(AuthComponent::user('id'));
    
    if ($this->request->is('post') || $this->request->is('put')) {
      $frmData = $this->request->data['User'];
      $tmp = $frmData['Upload']['tmp_name'];
      
      $hash = rand();
      $date = date("Ymd"); 
      $image = $date.$hash."-".$frmData['Upload']['name'];

      $target = WWW_ROOT.'img'.DS;
      $target = $target.basename($image);

      move_uploaded_file($tmp, $target);
      $this->request->data['User']['profile_picture'] = $image;

      if ($this->User->save($this->request->data)) {
        $this->Flash->success(__('The user has been updated'));
        $this->redirect(array('action' => 'profile'));
      } else{
        $this->Flash->error(__('Unable to update user'));
      }
    }
  
    if (!$this->request->data) {
      $this->request->data = $user;
    }
  }

  public function settings(){
    $user = $this->User->findById(AuthComponent::user('id'));
      
    if ($this->request->is('post') || $this->request->is('put')) {
      $storedHash = $user['User']['password'];
      $newHash = Security::hash($this->request->data['User']['old_password'], 'blowfish', $storedHash);

      if($newHash == $storedHash){
        if ($this->request->data['User']['new_password'] == $this->request->data['User']['password_confirm']){
          $this->User->read('id', $this->Auth->user('id'));
          $this->User->saveField('email', $this->request->data['User']['email']);
          $this->User->saveField('password', $this->request->data['User']['new_password']);

          $this->Flash->success(__('The user has been updated'));
          $this->redirect(array('action' => 'profile'));
        } else {
          $this->Flash->error(__('New Password dont match'));
        }
      } else {
        $this->Flash->error(__('Incorrect Old Password'));
      }
    }

    if (!$this->request->data) {
			$this->request->data = $user;
		}
  }

}
<?php

class MessageController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        date_default_timezone_set('Asia/Manila');
      }

    public function index(){
        $messages = $this->Message->find('all', array('recursive' => 2));
        $this->set(compact('messages'));
    }

    public function create(){
        if ($this->request->is('post')) {
            $this->Message->create();
            
            $this->request->data['Message']['user_id'] = $this->Auth->user('id');
            if ($this->Message->save($this->request->data)) {
                return $this->redirect(array('action' => 'index'));
                $this->Flash->success(__('Your post has been saved.'));
            }
            $this->Flash->error(__('Unable to add your post.'));
        }
    }

    public function view($id){
        if (!$id) {
            throw new NotFoundException(__('Invalid message'));
        }

        $message = $this->Message->findById($id);
        if (!$message) {
            throw new NotFoundException(__('Invalid message'));
        }
        $this->set('message', $message);
    }

    public function edit($id){

        if (!$id) {
            throw new NotFoundException(__('Invalid message'));
        }
    
        $message = $this->Message->findById($id);
        if (!$message) {
            throw new NotFoundException(__('Invalid message'));
        }

        if ($this->Auth->user('id') == $message['Message']['user_id']){
            if ($this->request->is('post') || $this->request->is('put')) {
                $this->request->data['Message']['user_id'] = $this->Auth->user('id');
                if ($this->Message->save($this->request->data)) {
                    $this->Message->saveField('updated_at', date('Y-m-d H:i:s'));

                    $this->Flash->success(__('The message has been updated'));
                    $this->redirect(array('action' => 'index'));
                } else{
                    $this->Flash->error(__('Unable to update message'));
                }
            }

            if (!$this->request->data) {
                $this->request->data = $message;
            }
        } else {
            throw new NotFoundException(__('Not Authorize'));
        }
        
    }

    public function delete($id){
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        $message = $this->Message->findById($id);
        if ($this->Auth->user('id') == $message['Message']['user_id']){
            if ($this->Message->delete($id)) {
                $this->Flash->success(
                    __('The post with id: %s has been deleted.', h($id))
                );
            } else {
                $this->Flash->error(
                    __('The post with id: %s could not be deleted.', h($id))
                );
            }
            return $this->redirect(array('action' => 'index'));
        }
    }
}
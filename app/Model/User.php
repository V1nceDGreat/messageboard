<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel
    {
        public $validate = array(
            'name' => array(
                'required' => array(
                    'rule' => array('notBlank'),
                    'message' => 'Name is required'
                ),
                'between' => array(
                    'rule' => array('lengthBetween', 5, 20),
                    'message' => 'Name must be between 5 and 15 characters long.'
                ),
            ),
            'email' => array(
                'email' => array(
                    'rule' => array('email', true),
                    'message' => 'Please supply a valid email address.'
                ),
                'unique' => array(
                    'rule' => array('isUnique', array('email'), false),
                    'message' => 'This email has already been used.'
                ),
                'required' => array(
                    'rule' => array('notBlank'),
                    'message' => 'Name is required'
                )
            ),
            'password' => array(
                'required' => array(
                    'rule' => array('notBlank'),
                    'message' => 'Password is required'
                ),
                'minLength' => array(
                    'rule' => array('minLength', 8),
                    'message' => 'Password minimum length is 8 characters'
                )
            ),
            'password_confirm' => array(
                'required' => array(
                    'rule' => array('notBlank'),
                    'message' => 'Password is required'
                ),
                'minLength' => array(
                    'rule' => array('minLength', 8),
                    'message' => 'Password minimum length is 8 characters'
                ),
                'confirm' => array(
                    'rule'=>array('password_confirm'),
                    'message'=>'Password did not match'
                )
            ),
            'new_password' => array(
                'required' => array(
                    'rule' => array('notBlank'),
                    'message' => 'Password is required'
                ),
                'minLength' => array(
                    'rule' => array('minLength', 8),
                    'message' => 'Password minimum length is 8 characters'
                )
            ),
            'old_password' => array(
                'required' => array(
                    'rule' => array('notBlank'),
                    'message' => 'Password is required'
                ),
                'minLength' => array(
                    'rule' => array('minLength', 8),
                    'message' => 'Password minimum length is 8 characters'
                )
            )
        );

        public function password_confirm(){ 
            if ($this->data['User']['password'] !== $this->data['User']['password_confirm']){
                return false;       
            }
            return true;
        }

        public function beforeSave($options = array()) {
            if (isset($this->data[$this->alias]['password'])) {
                $passwordHasher = new BlowfishPasswordHasher();
                $this->data[$this->alias]['password'] = $passwordHasher->hash(
                    $this->data[$this->alias]['password']
                );
            }
            return true;
        }

        public $hasMany = array(
            'Message' => array(
                'className' => 'Message',
                'foreignKey' => 'user_id'
            ),
        );
    }
?>
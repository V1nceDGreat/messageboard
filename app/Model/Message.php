<?php

class Message extends AppModel {
    public $validate = array(
        'body' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'Field is required'
            ),
        ),
    );

    public $belongsTo = array(
        'Sender' => array(
            'className' => 'User',
            'foreignKey' => 'user_id'
        ),
        'Recipient' => array(
            'className' => 'User',
            'foreignKey' => 'recipient'
        )
    );

    public $hasMany = array(
        'Reply' => array(
            'className' => 'Reply',
            'foreignKey' => 'message_id'
        ),
    );
}
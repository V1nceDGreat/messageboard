<?php

class Reply extends AppModel {
    public $validate = array(
        'body' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'Field is required'
            ),
        ),
    );

    public $belongsTo = array(
        'message' => array(
            'className' => 'Message',
            'foreignKey' => 'message_id'
        ),
    );
}
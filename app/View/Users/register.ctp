<?php 

    echo $this->Form->create('User');
    echo $this->Form->input('name');
    echo $this->Form->input('email');
    echo $this->Form->input('password');
    echo $this->Form->input('password_confirm', array('type' => 'password'));
    echo $this->Form->end('Register');

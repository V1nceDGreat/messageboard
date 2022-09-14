<div style="margin-bottom: 10px;"><?php echo $this->Html->link('My Profile', array('controller' => 'users', 'action' => 'profile')); ?></div>

<?php echo $this->Form->create('User'); ?>
<?php
    echo $this->Form->input('email');
    echo $this->Form->input('old_password', array('type' => 'password'));
    echo $this->Form->input('new_password', array('type' => 'password'));
    echo $this->Form->input('password_confirm', array('type' => 'password'));
?>
<?php
    echo $this->Form->submit('Update');
?>

<?php echo $this->Form->end(); ?>
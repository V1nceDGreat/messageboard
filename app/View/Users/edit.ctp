<div style="margin-bottom: 10px;"><?php echo $this->Html->link('My Profile', array('controller' => 'users', 'action' => 'profile')); ?></div>

<?php echo $this->Form->create('User',['type' => 'file']); ?>

    <!-- hidden userID -->
    <?php echo $this->Form->hidden('id', array('value' => $this->data['User']['id'])); ?>

    <!-- Picture -->
    <?php echo $this->data['User']['profile_picture'] ? $this->Html->image($this->data['User']['profile_picture'], array('height' => '250', 'width' => '250', 'fullBase' => true, 'plugin' => false)) : '' ; ?>

    <!-- Details -->
    <?php echo $this->Form->input('Upload',['type'=>'file']); ?>
    <?php
        echo $this->Form->input('name');

        echo $this->Form->input('age');
        
        $options = array('Male' => 'Male', 'Female' => 'Female');
            echo $this->Form->radio('gender', $options);
            
        echo $this->Html->tag('span', 'Birthday');
        echo $this->Form->date('birthdate');
    ?>

    <!-- Hobby -->
    <?php echo $this->Html->tag('span', 'Hobby'); ?>
    <?php echo $this->Form->textarea('hobby'); ?>

    <!-- Edit Profile Button -->
    <?php
        echo $this->Form->submit('Update');
    ?>

<?php echo $this->Form->end(); ?>
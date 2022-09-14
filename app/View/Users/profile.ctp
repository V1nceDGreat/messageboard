<div style="margin-bottom: 10px;">
    <?php echo $this->Html->link('Home', array('controller' => 'users', 'action' => 'index')); ?>
</div>

<h3>User Profile</h3>
<?php 
    echo $user['User']['profile_picture'] ? $this->Html->image($user['User']['profile_picture'], array('height' => '250', 'width' => '250', 'fullBase' => true, 'plugin' => false)) : ''; 
?>

<div>
    <h3>
        <?php echo $user['User']['name'] ?>
        <?php echo $user['User']['age'] ? $user['User']['age'] : ''; ?>
    </h3>
    
</div>
<div>
    <?php 
        echo $this->Html->tag('span', 'Gender:');
        echo $user['User']['gender'] ? $user['User']['gender'] : '';
    ?>
</div>
<div>
    <?php 
        echo $this->Html->tag('span', 'Birthdate:'); 
        echo $user['User']['birthdate'] ? date('F d, Y',strtotime($user['User']['birthdate'])) : '';
    ?>
</div>
<div>
    <?php 
        echo $this->Html->tag('span', 'Joined:');  
        echo date('F d, Y ha',strtotime($user['User']['join_date']));
    ?>
</div>
<div>
    <?php 
        echo $this->Html->tag('span', 'Last Login:');
        echo date('F d, Y ha',strtotime($user['User']['last_login']));
    ?>
</div>
<div>
    <?php 
        echo $this->Html->tag('span', 'Hobby:');  
        echo $user['User']['hobby'] ? $this->Html->tag('p', $user['User']['hobby']) : '';
    ?>
</div>

<div style="margin-top: 10px;">
    <?php 
        echo $this->Html->link('Edit', array('controller' => 'users', 'action' => 'edit')); 
    ?>
</div>
<div style="margin-top: 10px;">
    <?php 
        echo $this->Html->link('Settings', array('controller' => 'users', 'action' => 'settings')); 
    ?>
</div>
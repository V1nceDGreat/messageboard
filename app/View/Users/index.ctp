<h3>
  <?php 
    if($this->Session->check('Auth.User')) { 
      echo $this->Html->link('Home', array('controller' => 'users', 'action' => 'index')); 
    }
  ?>
</h3>

<div>
  <?php 
    if($this->Session->check('Auth.User')) {
      echo $this->Html->link('Message List', array('controller' => 'message', 'action' => 'index'));
      echo $this->Html->link('Profile', array('controller' => 'users', 'action' => 'profile'));
      echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout'));
    } else {
      echo $this->Html->link('Login', array('controller' => 'users', 'action' => 'login'));
    }
  ?>
</div>

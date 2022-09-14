<?php 

    echo $this->Form->create('Message');
    echo $this->Html->tag('span', 'Message');
    echo $this->Form->textarea('body');
    echo $this->Form->end('Update Message');

<div>
    <?php echo $message['Message']['body']; ?>
</div>

<div>
    <?php
        echo $this->Form->create('Reply');
        echo $this->Html->tag('span', 'Reply');
        echo $this->Form->textarea('body');
        echo $this->Form->end('Reply Message');
    ?>
</div>

<div>
    <!-- <?php foreach ($messages as $message): ?>

    <?php endforeach; ?> -->
</div>
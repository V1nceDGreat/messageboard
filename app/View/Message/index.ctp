<div>
    <?php echo $this->Html->link('Home', array('controller' => 'users', 'action' => 'index')); ?>
</div>
<h3>Message List</h3>
<p><?php echo $this->Html->link('Create Message', array('action' => 'create')); ?></p>
<div>
    <input type="text" name="" id="" placeholder="Search...">
</div>
<table>
    <tr>
        <th>List</th>
    </tr>

    <?php foreach ($messages as $message): ?>
    <tr>
        <td>
            <div>
                <?php
                    echo $message['Sender']['profile_picture'] ? $this->Html->image($message['Sender']['profile_picture'], array('height' => '100', 'width' => '100', 'fullBase' => true, 'plugin' => false)) : '';
                ?>
            </div>
            <div>
                <?php echo $message['Sender']['name']; ?>
            </div>
            <div>
                <?php echo $message['Message']['body']; ?>
            </div>
            <div>
                <?php echo $message['Message']['created_at']; ?>
            </div>
            <?php if(AuthComponent::user('id') == $message['Message']['user_id']): ?>
                <div>
                    <?php
                        echo $this->Form->postLink(
                            'Delete',
                            array('action' => 'delete', $message['Message']['id']),
                            array('confirm' => 'Are you sure?')
                        );
                    ?>
                    <?php
                        echo $this->Html->link(
                            'Edit', array('action' => 'edit', $message['Message']['id'])
                        );
                    ?>
                </div>
            <? endif; ?>
            <div>
                <?php
                    echo $this->Html->link(
                        'add reply',
                        array('action' => 'view', $message['Message']['id'])
                    );
                ?>
            </div>
        </td>
    </tr>
    <?php endforeach; ?>

</table>
<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Votes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Entries'), ['controller' => 'Entries', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Entry'), ['controller' => 'Entries', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="votes form large-9 medium-8 columns content">
    <?= $this->Form->create($vote) ?>
    <fieldset>
        <legend><?= __('Add Vote') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('entry_id', ['options' => $entries]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

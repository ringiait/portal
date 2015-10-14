<div class="message error">
    <?php if (is_array($message)): ?>
        <?php foreach ($message as $kMsg => $vMsg): ?>
            <?php $msgError = array_values($vMsg)?>
            <?= h($kMsg) . ":" . h($msgError[0]) ?>
            <br>
        <?php endforeach ?>
    <?php else: ?>
        <?= h($message) ?>
    <?php endif ?>
</div>

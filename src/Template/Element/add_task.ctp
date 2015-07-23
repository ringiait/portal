<fieldset class="fsStyle">
    <legend class="legendStyle">
        <?= __('Add task to release') ?>
    </legend>
    <textarea id="redmine_id"  cols="66" name="listTask" hidden="hidden"> </textarea>
    <input type="hidden" name="oldTaskRelease" value="<?= implode(',', $arrTaskId) ?>">
    <div class="form-group text">
        <label class="col-md-2 control-label " for="redmine_id"><?= __('Choose task id') ?></label>
        <div class="col-md-6" id="redmineID">
            <?php if(! empty($arrReleaseTask)): ?>
            <?php foreach($arrReleaseTask as $kReleaseTask => $vReleaseTask): ?>
                <?= $vReleaseTask->redmine_id ?>
                <?php
                    $check = false;
                    if (in_array($vReleaseTask->redmine_id, $arrTaskId)) {
                        $check = true;
                    }
                ?>
                <?= $this->Form->checkbox($vReleaseTask->redmine_id, array('name' => '', 'value' => $vReleaseTask->redmine_id, 'class' => 'checkRedmineId', 'checked' => $check)) ?>
            <?php endforeach ?>
            <?php endif ?>
        </div>
    </div>
</fieldset>

<script type="text/javascript">
    $(".checkRedmineId").change(function() {
        var listRedmine = [];
        $('#redmineID input:checked').each(function() {
            listRedmine.push(this.value);
        });
        $("textarea#redmine_id").val(listRedmine.toString());
    });

</script>
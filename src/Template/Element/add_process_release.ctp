<div id="releaseModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><?= __("Add release process") ?></h4>
            </div>
            <div class="modal-body">
                <?= $this->Form->create(null, array('id' => 'frmCreateReleaseProcess', 'name' => 'frmCreateReleaseProcess', 'horizontal' => true)); ?>
                    <?= $this->Form->input('todo', array('label' => __('To do'), 'name' => 'todo', 'value'=> '')) ?>
                    <?= $this->Form->input('time', array('label' => __('Time'), 'name' => 'time', 'value'=> '', 'id' => 'timeDo')) ?>
                    <?= $this->Form->input('member_do', array('options' => $arrUserId, 'label' => __('Member do'), 'name' => 'memberDo', 'value'=> '')) ?>
                    <?= $this->Form->input('member_review', array('options' => $arrUserId, 'label' => __('Member review'), 'name' => 'memberReview', 'value'=> '')) ?>
                    <?= $this->Form->input('status', array('options' => $statusProcessRelease, 'label' => __('Status'), 'name' => 'status', 'value'=> '')) ?>
                    <?= $this->Form->input('note', array('label' => __('Note'), 'name' => 'note', 'value'=> '', 'type' => 'textarea')) ?>
                <?= $this->Form->end(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="addReleaseProcess" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
<?= $this->Form->input('', array('id' => 'processID', 'type' => 'hidden', 'value' => 0)); ?>

<div id="dialog-confirm" class="dialog-confirm" title="Are you delele?">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>These release process will be permanently deleted. Are you sure?</p>
</div>
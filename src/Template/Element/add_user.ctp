<div id="memberModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><?= __("Add new user") ?></h4>
            </div>
            <div class="modal-body">
                <?= $this->Form->create(null, array('id' => 'frmCreateTask', 'name' => 'frmCreateTask', 'horizontal' => true)); ?>
                    <?= $this->Form->input(__('username'), array('label' =>__('Username'),'id' => 'username', 'type' => 'text', 'value' => '' , 'maxlength' => 20, 'class'=>'inputText')); ?>
                    <?= $this->Form->input(__('fullname'), array('label' =>__('Fullname'),'id' => 'fullname', 'type' => 'text', 'value' => '' , 'maxlength' => 20, 'class'=>'inputText')); ?>
                    <?= $this->Form->input('office_id', array('options' => $listPosition, 'id' => 'office_id', 'label' => __('Position'), 'empty' => __('Position')));?>
                    <?= $this->Form->input(__('email'), array('label' =>__('Email'),'id' => 'email', 'type' => 'text', 'value' => '' , 'maxlength' => 20, 'class'=>'inputText')); ?>
                    <?= $this->Form->input(__('phone'), array('label' =>__('Mobile number'),'id' => 'phone', 'type' => 'text', 'value' => '' , 'maxlength' => 20, 'class'=>'inputText')); ?>
                    <?= $this->Form->input(__('skype'), array('label' =>__('Skype'),'id' => 'skype', 'type' => 'text', 'value' => '' , 'maxlength' => 20, 'class'=>'inputText')); ?>
                    <?= $this->Form->input(__('address'), array('label' =>__('Address'),'id' => 'address', 'type' => 'text', 'value' => '' , 'maxlength' => 20, 'class'=>'inputText')); ?>
                    <div class="form-group text">
                        <label class="col-md-2 control-label"><?= __("Choose color style") ?></label>
                        <div class="col-md-6">
                            <select id="style" class="form-control ">
                                <?php if(!empty($listStyle)): ?>
                                    <?php foreach($listStyle as $kStyle => $vStyle): ?>
                                        <option class="<?= $kStyle ?>"><?= $kStyle ?></option>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </select>
                        </div>
                    </div>
                    <?= $this->Form->input('', array('id' => 'userId', 'type' => 'hidden', 'value' => 0)); ?>
                <?= $this->Form->end(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="addUser" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<div id="dialog-confirm" class="dialog-confirm" title="Are you delele?">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>These user will be permanently deleted. Are you sure?</p>
</div>
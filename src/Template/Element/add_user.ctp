<div id="memberModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><?= __("Add new user") ?></h4>
            </div>
            <div class="modal-body">
                <?= $this->Form->create(null, array('id' => 'frmCreateTask', 'name' => 'frmCreateTask')); ?>
                    <?= $this->Form->input(__('username'), array('label' =>__('Username'),'id' => 'username', 'type' => 'text', 'value' => '' , 'maxlength' => 20, 'class'=>'inputText')); ?>
                    <?= $this->Form->input(__('fullname'), array('label' =>__('Fullname'),'id' => 'fullname', 'type' => 'text', 'value' => '' , 'maxlength' => 20, 'class'=>'inputText')); ?>
                    <?= $this->Form->input(__('office_id'), array('label' =>__('Position'),'id' => 'office_id', 'type' => 'text', 'value' => '' , 'maxlength' => 20, 'class'=>'inputText')); ?>
                    <?= $this->Form->input(__('email'), array('label' =>__('Email'),'id' => 'email', 'type' => 'text', 'value' => '' , 'maxlength' => 20, 'class'=>'inputText')); ?>
                    <?= $this->Form->input(__('phone'), array('label' =>__('Mobile number'),'id' => 'phone', 'type' => 'text', 'value' => '' , 'maxlength' => 20, 'class'=>'inputText')); ?>
                    <?= $this->Form->input(__('skype'), array('label' =>__('Skype'),'id' => 'skype', 'type' => 'text', 'value' => '' , 'maxlength' => 20, 'class'=>'inputText')); ?>
                    <?= $this->Form->input(__('address'), array('label' =>__('Address'),'id' => 'address', 'type' => 'text', 'value' => '' , 'maxlength' => 20, 'class'=>'inputText')); ?>
                    <?= $this->Form->input(__('style'), array('label' =>__('Style'),'id' => 'style', 'type' => 'text', 'value' => '' , 'maxlength' => 20, 'class'=>'inputText')); ?>
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
<div id="memberModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" style= "color: red";><strong><?= __("Add new user") ?></strong></h3>
            </div>
            
            <div class="modal-body form-group">
            
                <?= $this->Form->create(null, array('id' => 'frmCreateTask', 'name' => 'frmCreateTask', 'horizontal' => true)); ?>

                    
                    <?= $this->Form->input(__('tms_username'), array('label' =>__('Tms_username'),'id' => 'tms_username', 'type' => 'text', 'value' => '' , 'maxlength' => 30, 'class'=>'inputText', 'placeholder'=>'Username', 'required')); ?>

                    
                    <div class="invalid-msg"></div>
                  
                   
                       
                    <?= $this->Form->input(__('full_name'), array('label' =>__('Full_name'),'id' => 'full_name', 'type' => 'text', 'value' => '' , 'maxlength' => 30, 'class'=>'inputText', 'placeholder'=>'Họ và tên', 'required')); ?>
                   
                    <div class="invalid-msg"></div>

                    <div class="form-group text ">
                        <label class="col-md-2 control-label"><?= __("Position") ?></label>
                          <div class="col-md-6">
                            <select  id = "office_id" class="form-control alo1">
                            <option value = "0">Position</option>
                              <?php foreach($listPosition as $key => $value) { ?>
                                <option value = "<?= $key ?>"><?= $value?></option>
                              <?php } ?>
                            </select>
                          </div>
                    </div>
                    <div class="invalid-msg"></div>

                    
                    
                    <?= $this->Form->input(__('email'), array('label' =>__('Email'),'id' => 'email', 'type' => 'text', 'value' => '' , 'maxlength' => 30, 'class'=>'inputText', 'placeholder'=>'Email', 'required')); ?>
                    
                    <div class="invalid-msg"></div>


                    <?= $this->Form->input(__('phone'), array('label' =>__('Mobile number'),'id' => 'phone', 'type' => 'text', 'value' => '' , 'maxlength' => 20, )); ?>
                    <?= $this->Form->input(__('skype'), array('label' =>__('Skype'),'id' => 'skype', 'type' => 'text', 'value' => '' , 'maxlength' => 30, )); ?>
                    <?= $this->Form->input(__('address'), array('label' =>__('Address'),'id' => 'address', 'type' => 'text', 'value' => '' , 'maxlength' => 100, )); ?>
                    <div class="form-group text">
                        <label class="col-md-2 control-label"><?= __("Choose color style") ?></label>
                        <div class="col-md-6">
                            <select id="style" class="form-control alo1">
                            <option value = "0">Xin chọn Style</option>
                                <?php foreach($listStyle as $key => $value) { ?>
                                <option value = "<?= $key ?>"><?= $value?></option>
                              <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="invalid-msg"></div>
                    <?= $this->Form->input('', array('id' => 'userId', 'type' => 'hidden', 'value' => 0)); ?>
                   
                <?= $this->Form->end(); ?>
            <div class="msg"></div>
            </div>
           
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id = "myButton_user">Close</button>
                <button type="button" id="addUser" class="btn btn-primary">Save</button>
            </div>

        </div>
    </div>
</div>

<div id="dialog-confirm-user" class="dialog-confirm" title="Are you delele?">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>These user will be permanently deleted. Are you sure?</p>
</div>
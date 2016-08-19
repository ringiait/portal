<div id="memberModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" style= "color: red";><strong><?= __("Add new task") ?></strong></h3> 
            </div>
            
            <div class="modal-body form-group">
            
                <?= $this->Form->create(null, array('id' => 'frmCreateTask', 'name' => 'frmCreateTask', 'horizontal' => true)); ?>

                    <?= $this->Form->input('', array('id' => 'taskId', 'type' => 'hidden', 'value' => 0)); ?>

                    <?= $this->Form->input(__('redmine_id'), array('label' =>__('Redmine_id'),'id' => 'redmine_id', 'type' => 'text', 'value' => '' , 'maxlength' => 30, 'class'=>'inputText1', 'placeholder'=>'Redmine_id', 'required')); ?>

                    
                    <div class="invalid-msg"></div>


                    <?= $this->Form->input(__('created'), array('id' => 'created', 'type' => 'hidden', 'value' => '')); ?>



                    <div class="form-group text ">
                        <label class="col-md-2 control-label"><?= __("Assigned") ?></label>
                          <div class="col-md-6">
                            <select  id = "assigned" class="form-control alo">
                            <option value = "0">Chọn người thực hiện</option>
                              <?php foreach($arrMembers as $key => $value) { ?>
                                <option value = "<?= $key ?>"><?= $value?></option>
                              <?php } ?>
                            </select>
                          </div>
                    </div>
                    <div class="invalid-msg"></div>

                    <div class="form-group text ">
                        <label class="col-md-2 control-label"><?= __("Member_review") ?></label>
                          <div class="col-md-6">
                            <select id = "member_review"class="form-control alo">
                            <option value = "0">Chọn người review</option>
                              <?php foreach($arrMembers as $key => $value) { ?>
                                <option value = "<?= $key ?>" ><?= $value?></option>
                              <?php } ?>
                            </select>
                          </div>
                    </div>

                   <div class="invalid-msg"></div>

                   <div class="form-group text ">
                        <label class="col-md-2 control-label"><?= __("Project") ?></label>
                          <div class="col-md-6">
                            <select id = "project_id" class="form-control alo">
                            <option value = "0">Chọn Project</option>
                              <?php foreach($arrProjects as $key => $value) { ?>
                                <option value = "<?= $key ?>"><?= $value?></option>
                              <?php } ?>
                            </select>
                          </div>
                    </div>


                   <div class="invalid-msg"></div>

                   <div class="form-group text ">
                        <label class="col-md-2 control-label"><?= __("Status") ?></label>
                          <div class="col-md-6">
                            <select id = "task_status" class="form-control alo">
                            <option value = "0">Chọn Status</option>
                              <?php foreach($task_status as $key => $value) { ?>
                                <option value = "<?= $key ?>"><?= $value?></option>
                              <?php } ?>
                            </select>
                          </div>
                    </div>


                   <div class="invalid-msg"></div>

                   <?= $this->Form->input(__('title'), array('label' =>__('Title'),'id' => 'title_task', 'type' => 'text', 'value' => '' , 'maxlength' => 30, 'class'=>'inputText1', 'placeholder'=>'Title', 'required')); ?>
                   
                    <div class="invalid-msg"></div>

                    
                    <?= $this->Form->input(__('task_goal'), array('label' =>__('Task_goal'),'id' => 'task_goal', 'type' => 'textarea', 'value' => '' , 'maxlength' => 255, 'class'=>'inputText1', 'placeholder'=>'Task_goal', 'required')); ?>
                    
                    <div class="invalid-msg"></div>


                    

                    <?= $this->Form->file('doc_file', array('button-label' =>__('Tài liệu đính kèm'), 'id' => 'doc_file', 'style' => 'width:450px; margin-left: 22px;')); ?>

                   <div class="invalid-msg"></div>

                   <?= $this->Form->input(__('test_cases'), array('label' =>__('Test_cases'),'id' => 'test_cases', 'type' => 'textarea', 'value' => '' , 'maxlength' => 255, 'placeholder'=>'Test_cases', 'required')); ?>

                   <div class="invalid-msg"></div>

                   <?= $this->Form->input(__('review_testcase'), array('label' =>__('Review_testcase'),'id' => 'review_testcase', 'type' => 'textarea', 'value' => '' , 'maxlength' => 255, 'placeholder'=>'Review_testcase', 'required')); ?>

                   <div class="invalid-msg"></div>

                   

                   <?= $this->Form->input(__('merge_req_test'), array('label' =>__('Merge_req_test'),'id' => 'merge_req_test', 'type' => 'text', 'value' => '' , 'maxlength' => 20, 'placeholder'=>'Merge_req_test', 'required')); ?>


                   <?= $this->Form->input(__('merge_reg_staging'), array('label' =>__('Merge_reg_staging'),'id' => 'merge_reg_staging', 'type' => 'text', 'value' => '' , 'maxlength' => 20, 'placeholder'=>'Merge_reg_staging', 'required')); ?>


                   <?= $this->Form->input(__('merge_reg_live'), array('label' =>__('Merge_reg_live'),'id' => 'merge_reg_live', 'type' => 'text', 'value' => '' , 'maxlength' => 20, 'placeholder'=>'Merge_reg_live', 'required')); ?>
                   
                   
                <?= $this->Form->end(); ?>
            <div class="msg"></div>
            </div>
           
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id = "myButton">Close</button>
                <button type="button" id="addTask" class="btn btn-primary">Save</button>
            </div>

        </div>
    </div>
</div>

<div id="dialog-confirm" class="dialog-confirm" title="Are you delele?">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>These task will be permanently deleted. Are you sure?</p>
</div>
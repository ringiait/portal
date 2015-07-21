<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author  ThanhN
 * @date    2015/07/17
 * 
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;


if (!Configure::read('debug')):
    throw new NotFoundException();
endif;
$this->assign('title', 'Add New Task Document');
?>

<div class="web-register">
    <?php echo $this->Form->create(null, array('id' => 'frmCreateTask', 'name' => 'frmCreateTask', 
        	'enctype' => "multipart/form-data",
        	'url' => '/tasks/saveTask/', 'horizontal' => true)); ?>	
    	<?php echo $this->Form->input('redmine_id', array('label' =>__('Redmine ID'), 'id' => 'redmine_id', 'type' => 'text', 'value' => '' , 'maxlength' => 255, 'class'=>'inputText')); ?>				 
    	<?php echo $this->Form->input('assigned', array('options'=>$arrMembers, 'label'=>__('Người được giao'),
    				  'empty'=>'Chọn thành viên','selected'=>''));  ?>
    	<?php echo $this->Form->input('title', array('label' =>__('Tiêu đề task'),'id' => 'title','type' => 'text', 'value' => '' , 'maxlength' => 255, 'class'=>'inputText')); ?>				 
    	<?php echo $this->Form->input('task_goal', array('label' =>__('Mục đích task'), 'id' => 'task_goal', 'type' => 'textarea', 'value' => '' , 'maxlength' => 255, 'class'=>'inputText')); ?>				 
    	<div class="center-input">
    		<?php echo $this->Form->file('doc_file', array('button-label' =>__('Tài liệu đính kèm'), 'id' => 'doc_file', 'class' => 'doc_file','style' => 'width:450px; margin: 0 auto;', 'class'=>'inputText')); ?>				 
    	</div>
    	<?php echo $this->Form->input('test_case', array('label' =>__('Test case'), 'id' => 'test_case', 'type' => 'textarea', 'value' => '' , 'maxlength' => 255, 'class'=>'inputText')); ?>				 		
    	<?php echo $this->Form->input('task_id', array('label' => '', 'id' => 'task_id', 'type' => 'hidden', 'value' => '' , 'maxlength' => 255, 'class'=>'inputText')); ?>
        
        <!-- Tinh nang thay doi -->        
        <div class="change_location box_change">
            <h3 class="title_box">Điểm thay đổi</h3>
            <?php echo $this->Form->input('function_change', array('label' =>__('Tính năng'), 'id' => 'function_change', 'type' => 'text', 'value' => '', 'maxlength' => 255, 'class'=>'inputText')); ?>
            <?php echo $this->Form->input('function_type', array('options' => $arrFuncType, 'id' => 'function_type', 'label' => __('Loại thay đổi'), 'empty' => 'Loại thay đổi' , 'selected' => ''));?>
            <?php echo $this->Form->input('function_description', array('label' =>__('Mô tả'), 'id' => 'function_description', 'type' => 'textarea', 'value' => '' , 'maxlength' => 1000, 'class'=>'inputText')); ?>
            <?php echo $this->Form->input('function_note', array('label' =>__('Note'), 'id' => 'function_note', 'type' => 'textarea', 'value' => '' , 'maxlength' => 1000, 'class'=>'inputText')); ?>
            <input type="button" value="Add" class="add_function_change btn_add"/>
            <div class="clear"></div>
        </div>
        
        <!-- Database thay doi -->        
        <div class="change_database box_change">
            <h3 class="title_box">Database</h3>
            <?php echo $this->Form->input('database_table_name', array('label' =>__('Tên table'), 'id' => 'database_table_name', 'type' => 'text', 'value' => '', 'maxlength' => 255, 'class'=>'inputText')); ?>
            <?php echo $this->Form->input('database_type', array('options' => $arrFuncType, 'id' => 'database_type', 'label' => __('Loại thay đổi'), 'empty' => 'Loại thay đổi' , 'selected' => ''));?>
            <?php echo $this->Form->input('database_description', array('label' =>__('Mô tả'), 'id' => 'database_description', 'type' => 'textarea', 'value' => '' , 'maxlength' => 1000, 'class'=>'inputText')); ?>
            <?php echo $this->Form->input('database_queries', array('label' =>__('Câu query'), 'id' => 'database_queries', 'type' => 'textarea', 'value' => '' , 'maxlength' => 1000, 'class'=>'inputText')); ?>
            <?php echo $this->Form->input('database_optimized', array('options'=>$arrDbOtimized, 'id' => 'database_optimized', 'label'=>__('Query đã tối ưu chưa?'),
    				  'empty'=>'Chọn trạng thái','selected'=>''));  ?>
            <input type="button" value="Add" class="add_database_change btn_add"/>
            <div class="clear"></div>
        </div>
        
        <!-- Du kien thuc hien -->        
        <div class="process_step box_change">
            <h3 class="title_box">Dự kiến thực hiện</h3>
            <?php echo $this->Form->input('process_title', array('label' =>__('Tiêu đề'), 'id' => 'process_step_title', 'type' => 'text', 'value' => '', 'maxlength' => 255, 'class'=>'inputText')); ?>
            <?php echo $this->Form->input('process_change_file', array('label' =>__('File thay đổi'), 'id' => 'process_change_file', 'type' => 'textarea', 'value' => '' , 'maxlength' => 1000, 'class'=>'inputText'));?>
            <?php echo $this->Form->input('process_description', array('label' =>__('Mô tả'), 'id' => 'process_description', 'type' => 'textarea', 'value' => '' , 'maxlength' => 1000, 'class'=>'inputText')); ?>
            <?php echo $this->Form->input('process_editor', array('options'=>$arrMembers, 'label'=>__('Người thực hiện'),
    				  'empty'=>'Chọn thành viên', 'selected'=>''));  ?>
            <?php echo $this->Form->input('process_status', array('options'=>$arrProcessStatus, 'id' => 'process_status', 'label'=>__('Trạng thái step'),
    				  'empty'=>'Chọn trạng thái','selected'=>''));  ?>
            <input type="button" value="Add" class="add_process_step btn_add"/>
            <div class="clear"></div>
        </div>
        
        <?php echo $this->Form->submit(__('Lưu Task'), array('bootstrap-type' => 'danger', 'bootstrap-size' => 'large', 'id' => 'saveButton','name' => 'saveButton')); ?>
    <?php echo $this->Form->end(); ?>
</div>

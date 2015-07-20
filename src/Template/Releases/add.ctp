<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
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
	'url' => '/releases/saveRelease/', 'horizontal' => true)); ?>
	<?php echo $this->Form->input('redmine_id', array('label' =>__('Redmine ID'),'id' => 'redmine_id', 'type' => 'text', 'value' => '' , 'maxlength' => 255, 'class'=>'inputText')); ?>
	<?php echo $this->Form->input('release_date', array('type' => 'date', 'label'=>__('Release date'), 'id' => 'release_date'));  ?>
	<?php echo $this->Form->input('change_db', array('label' =>__('Change Database'),'id' => 'changeDB','type' => 'checkbox', 'value' => '0')); ?>
	<?php echo $this->Form->input('checklist_status', array('label' =>__('Checklist status'),'id' => 'checklistStatus','type' => '', 'value' => '' , 'maxlength' => 255, 'class'=>'inputText')); ?>
	<div class="center-input">
		<?php echo $this->Form->file('doc_file', array('button-label' =>__('Tài liệu đính kèm'),'id' => 'doc_file', 'class' => 'doc_file','style' => 'width:450px; margin: 0 auto;', 'class'=>'inputText')); ?>				 
	</div>
	<?php echo $this->Form->input('test_case', array('label' =>__('Test case'),'id' => 'test_case','type' => 'textarea', 'value' => '' , 'maxlength' => 255, 'class'=>'inputText')); ?>				 
	<?php echo $this->Form->submit(__('Lưu'), array('bootstrap-type' => 'danger', 'bootstrap-size' => 'large', 'id' => 'saveButton','name' => 'saveButton')); ?>		
	<?php echo $this->Form->input('task_id', array('label' => '','id' => 'task_id','type' => 'hidden', 'value' => '' , 'maxlength' => 255, 'class'=>'inputText')); ?>				 
	<!-- Button -->
<?php echo $this->Form->end(); ?>
</div>

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


<?php
    echo $this->Html->icon('pencil');
?>


<?php
    echo $this->Html->label('My Label', 'primary') ;
    echo $this->Html->label('My Label', 'danger') ;
    echo $this->Html->label('My Label', 'success') ;
?>



<div class="web-register">
<?php echo $this->Form->create(null, array('id' => 'frmCreateTask', 'name' => 'frmCreateTask', 
	'enctype' => "multipart/form-data",
	'url' => '/tasks/saveTask/')); ?>	
	<?php echo $this->Form->input('redmine_id', array('label' =>__('Redmine ID'),'id' => 'redmine_id', 'type' => 'text', 'value' => '' , 'maxlength' => 255, 'class'=>'inputText')); ?>				 
	<?php echo $this->Form->input('assigned', array('options'=>$arrMembers, 'label'=>__('Người được giao'),
				  'empty'=>'Chọn thành viên','selected'=>''));  ?>
	<?php echo $this->Form->input('title', array('label' =>__('Tiêu đề task'),'id' => 'title','type' => 'text', 'value' => '' , 'maxlength' => 255, 'class'=>'inputText')); ?>				 
	<?php echo $this->Form->input('task_goal', array('label' =>__('Mục đích task'),'id' => 'task_goal','type' => 'textarea', 'value' => '' , 'maxlength' => 255, 'class'=>'inputText')); ?>				 
	<?php echo $this->Form->input('doc_file', array('label' =>__('Tài liệu đính kèm'),'id' => 'doc_file','type' => 'file', 'value' => '' , 'maxlength' => 255, 'class'=>'inputText')); ?>				 
	<?php echo $this->Form->input('test_case', array('label' =>__('Test case'),'id' => 'test_case','type' => 'textarea', 'value' => '' , 'maxlength' => 255, 'class'=>'inputText')); ?>				 
	<input type="submit" id="saveButton" name="saveButton" value="<?php print __(' Lưu ');  ?>" class="btn_organce" />		
	<!-- Button -->
<?php echo $this->Form->end(); ?>
</div>

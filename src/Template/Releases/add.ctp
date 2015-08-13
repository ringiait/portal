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
<?= $this->Form->create(null, array('id' => 'frmCreateTask', 'name' => 'frmCreateTask',
	'enctype' => "multipart/form-data",
	'url' => '/releases/saveRelease/', 'horizontal' => true)); ?>
    <?php
        $redmine_id = isset($arrDataRelease[0]['redmine_id']) ? $arrDataRelease[0]['redmine_id'] : "";
        $release_date = isset($arrDataRelease[0]['release_date']) ? date("Y-m-d H:i:s", strtotime($arrDataRelease[0]['release_date'])) : "";
        $has_change_db = isset($arrDataRelease[0]['has_change_db']) ? $arrDataRelease[0]['has_change_db'] : "";
        $db_backup = isset($arrDataRelease[0]['db_backup']) ? $arrDataRelease[0]['db_backup'] : "";
        $status = isset($arrDataRelease[0]['status']) ? $arrDataRelease[0]['status'] : "";
        $pass_checklist = isset($arrDataRelease[0]['pass_checklist']) ? $arrDataRelease[0]['pass_checklist'] : "";
        $id = isset($arrDataRelease[0]['id']) ? $arrDataRelease[0]['id'] : "";
    ?>
	<?= $this->Form->input('redmine_id', array('label' =>__('Redmine ID'),'id' => 'redmine_id', 'type' => 'text', 'value' => $redmine_id , 'maxlength' => 255, 'class'=>'inputText')); ?>
	<?= $this->Form->input('release_date', array('type' => 'text', 'label'=>__('Release date'), 'id' => 'datepicker', 'value' => $release_date));  ?>
	<?= $this->Form->input('has_change_db', array('label' =>__('Change Database'),'id' => 'changeDB','type' => 'checkbox', 'value' => 1, 'checked' => $has_change_db)); ?>
    <?= $this->Form->input('db_backup', array('label' =>__('Backup Database'),'id' => 'backupDB','type' => 'checkbox', 'value' => 1, 'checked' => $db_backup)); ?>
    <?= $this->Form->input('status', array('options' => $statusRelease, 'id' => 'release_status', 'label' => __('Release status'), 'value' => $status));?>
    <?= $this->Form->input('pass_checklist', array('options' => $statusChecklist, 'id' => 'pass_checklist', 'label' => __('Checklist status'), 'value' => $pass_checklist));?>
    <?= $this->Form->input('id', array('type' => 'hidden', 'value' => $id)); ?>
    <?= $this->element('add_task'); ?>
	<?= $this->Form->submit(__('Lưu'), array('bootstrap-type' => 'danger', 'bootstrap-size' => 'large', 'id' => 'saveButton','name' => 'saveButton')); ?>
	<!-- Button -->
<?= $this->Form->end(); ?>
</div>

<script>
    $(function() {
        $( "#datepicker" ).datetimepicker({
            dateFormat: 'yy-mm-dd'
        });
        $("#timeDo").datetimepicker({
            dateFormat: 'yy-mm-dd'
        });
    });
</script>

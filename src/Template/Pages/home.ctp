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

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<body>
<div id="wrapper">
	<!-- Notification Ringi -->
	<div class="notification-ringi">
		<!--<div class="tn-box tn-box-color-1">
			<p>Ngày 06/03/2015 : Team hoàn thành SPECS đơn đề xuất </p>
		</div>            
		<div class="tn-box tn-box-color-2">
			<p>Ngày 20/03/2015 : Team hoàn thành SPECS đơn xin dấu</p>
		</div>  
		<div class="tn-box tn-box-color-3">
			<p>Ngày 03/04/2015 : Team hoàn thành SPECS đơn hiếu hỉ</p>
		</div>
		<div class="tn-box tn-box-color-1">
			<p>Ngày 14/04/2015 : Giao KH Test phần sửa menu trên TEST </p>
		</div>-->  
		<div class="clear"></div>
	</div>
	<!-- Team Member Ringi -->
    <fieldset class="fsStyle">
        <legend class="legendStyle">
            <?= __('Member of team') ?>
            <a data-toggle="modal" data-target="#memberModal" data-title="add">
                <span class="glyphicon glyphicon-plus"></span>
            </a>
        </legend>
	<div class="team-member">
        <?php if(is_array($users) && count($users) > 0): ?>
            <?php foreach($users as $key => $dataUser): ?>
                <div class="colum-item">
                    <h1 class="<?= $dataUser->style ?> hmargin" id='fullname<?= $dataUser->id ?>'><?= $dataUser->full_name ?> </h1>
                    <?php $office_name = isset($listPosition[$dataUser->office_id]) ? $listPosition[$dataUser->office_id] : ""; ?>
                    <p><?= __('Chức vụ') . ': <strong>' . $office_name . '</strong>' ?></p>
                    <p><?= __('Số ĐT') . ': <strong id="phone' . $dataUser->id . '">' . $dataUser->phone . '</strong>' ?></p>
                    <p><?= __('Email') . ': <strong id="email' . $dataUser->id . '">' .$dataUser->email . '</strong>' ?></p>
                    <p><?= __('Skype') . ': <strong id="skype' . $dataUser->id . '">' . $dataUser->skype . '</strong>' ?></p>
                    <?= $this->Form->input('username', array('id' => 'username' . $dataUser->id, 'type' => 'hidden', 'value' => $dataUser->tms_username)); ?>
                    <?= $this->Form->input('address', array('id' => 'address' . $dataUser->id, 'type' => 'hidden', 'value' => $dataUser->address)); ?>
                    <?= $this->Form->input('style', array('id' => 'style' . $dataUser->id, 'type' => 'hidden', 'value' => $dataUser->style)); ?>
                    <?= $this->Form->input('style', array('id' => 'office' . $dataUser->id, 'type' => 'hidden', 'value' => $dataUser->office_id)); ?>
                    <a data-toggle="modal" data-target="#memberModal" data-title="edit" data-member='<?= $dataUser->id ?>'>
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    <a onclick="deleteUser(<?= $dataUser->id ?>);">
                        <span class="glyphicon glyphicon-trash"></span>
                    </a>
                </div>
            <?php endforeach ?>
        <?php else: ?>
            <?= __('Have no user, please add') ?>
        <?php endif ?>
		<div class="clear"></div>
	</div>
    </fieldset>
	<div class="clear"></div>
	<?php echo $linkHtml; ?>
</div>

<?= $this->element('add_user'); ?>

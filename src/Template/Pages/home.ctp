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
	<div class="notification-ringi">
		<div class="clear"></div>
	</div>
    <fieldset class="fsStyle">
        <legend class="legendStyle">
            <?= __('Member of team') ?>
            <div class = "msg_user" style="display: inline; font-size: 15px;"></div>
			<span style="float: right;" >
				<a data-toggle="modal" data-target="#memberModal" data-title="add_user">
					<span class="glyphicon glyphicon-plus"></span>
				</a>
			</span>
        </legend>
	<div id = "list_user">
        <?php if(is_array($users) && count($users) > 0): 
       //kiểm tra phần từ trong mảng và đếm số lượng phần tử trong mảng ?> 
 		<?php
		$dem = 0;
		foreach ($users as $key => $dataUser) {
			$dem++;
			?>

			<?php $office_name = isset($listPosition[$dataUser->office_id]) ? $listPosition[$dataUser->office_id] : ""; ?>
			<div class="colum-item" style="width: 300px">
				<table class="table table-hover table-condensed" style="margin-bottom: 0px;">
				
					<tr id="2<?= $dataUser->id?>" class="<?= $dataUser->style ?>">
						<th colspan="2" style="color: white;">
							<strong id="1<?= $dataUser->id?>" style="font-size:19px;"><?= $dataUser->full_name ?></strong>
							<span style="float: right;" >
								<a class="btn btn-success" data-toggle="modal" data-target="#memberModal" data-title="edit" data-member='<?= $dataUser->id ?>'>
									<span class="glyphicon glyphicon-pencil"></span>
								</a>
								<a class="btn btn-primary" onclick="deleteUser(<?= $dataUser->id ?>);">
									<span class="glyphicon glyphicon-trash"></span>
								</a>
							</span>
						</th>
					</tr>
					<tr>
						<td><strong><?= __('Tms_username') ?></strong></strong></td>
						<td id='tms_username<?= $dataUser->id ?>'> <?= $dataUser->tms_username ?></td>
					</tr>
					<tr>
						<td><strong><?= __('Chức vụ') ?></strong></strong></td>
						<td id='office_id<?= $dataUser->id ?>'> <?= $office_name ?></td>
					</tr>
					<tr>
						<td><strong><?= __('Số ĐT') ?></strong></td>
						<td id="phone<?= $dataUser->id ?>"><?= $dataUser->phone ?></td>
					</tr>
					<tr>
						<td><strong><?= __('Email') ?></strong></td>
						<td id="email<?= $dataUser->id ?>"><?= $dataUser->email ?></td>
					</tr>
					<tr>
						<td><strong><?= __('Skype') ?></strong></td>
						<td id="skype<?= $dataUser->id ?>"><?= $dataUser->skype ?></td>
					</tr>
					<div style = "display:none;">
						<input value = "<?= $dataUser->office_id ?>"  id='office_id<?= $dataUser->id ?>'> </input>
						<input value = "<?= $dataUser->style ?>"  id='style<?= $dataUser->id ?>'> </input>
						<p id="3<?= $dataUser->id ?>"><?= $dataUser->address ?></p>
					</div>
				</table>
				
			</div>	
			<?php if ($dem%4 == 0) {?>
				<div class = "clearfix"></div>
				<?php } ?>
			<?php
		}
		?>
        <?php else: ?>
            <?= __('Have no user, please add') ?>
        <?php endif ?>
	</div>
    </fieldset>

</div>
<?= $this->element('add_user'); ?>

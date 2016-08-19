<div class="header">
	<?php
		
		foreach ($link_type_arr as $lt_id => $lt_title) {
			?>
			<div class="colum-item" style="width: <?=$width?>px">
				<table class="table table-striped" style="margin-bottom: 0px;">
					<tr class="danger">
						<th>#</th>
						<th width="70%">
							<?= $lt_title ?>
						</th>
						<th align="left">
							<a data-toggle="modal" data-target="#linkModal" data-title="add" data-member='' data-type="<?= $lt_id ?>">
								<span class="glyphicon glyphicon-plus"></span>
							</a>
						</th>
					</tr>
					<?php
						$i = 0;
						foreach($link_arr[$lt_id] as $link) {
							$i++
							?>
								<tr class="<?=$link->style_type?>">
									<td>
										<?=$i?>
									</td>
									<td>
										<a rel="nofollow" target="<?=$link->target?>" href="<?=$link->link?>">
                                            <?php $dataPost = array(
                                                "id" => $link->id,
                                                "title" => $link->title,
                                                "link" => $link->link,
                                                "linkTypeId" => $link->link_type_id,
                                                "styleType" => $link->style_type,
                                                "target" => $link->target
                                            ) ?>
											<?= $link->title ?>
										</a>
                                        <?= $this->Form->input('', array('id' => 'editLink'.$link->id, 'type' => 'hidden', 'value' => json_encode($dataPost))); ?>
									</td>
									<td>
										<a data-toggle="modal" data-target="#linkModal" data-title="edit" data-link='<?= $link->id ?>' data-type="<?= $lt_id ?>">
										  <span class="glyphicon glyphicon-pencil"></span>
										</a>
										<a onclick="deleteLink(<?= $link->id ?>);">
											<span class="glyphicon glyphicon-trash"></span>
										</a>
									</td>
								</tr>
							<?php
						}
					?>
				</table>
				
			</div>	
			<?php
		}
	?>
</div>

<div id="linkModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><?= __("Add new link") ?></h4>
            </div>
            <div class="modal-body">
                <?= $this->Form->create(null, array('id' => 'frmCreateTask', 'name' => 'frmCreateTask')); ?>
                <?= $this->Form->input(__('Title link'), array('label' =>__('Title link'),'id' => 'titleLink', 'type' => 'text', 'value' => '' , 'maxlength' => 250, 'class'=>'')); ?>
                <?= $this->Form->input(__('Link'), array('label' =>__('Link'),'id' => 'linkLink', 'type' => 'text', 'value' => '' , 'maxlength' => 250, 'class'=>'')); ?>
                <?= $this->Form->input(__('Target link'), array('options' => $targetLink, 'id' => 'targetLink', 'label' => __('Target link')));?>
                <label><?= __("Style type") ?></label>
                <select id="styleTypeLink">
					<option><?= __('No Color') ?></option>
                    <?php if(!empty($listStyle)): ?>
                        <?php foreach($listStyle as $kStyle => $vStyle): ?>
                            <option class="<?= $kStyle ?>"><?= $kStyle ?></option>
                        <?php endforeach ?>
                    <?php endif ?>
                </select>
                <?= $this->Form->input('', array('id' => 'typeLink', 'type' => 'hidden', 'value' => 0)); ?>
                <?= $this->Form->input('', array('id' => 'linkId', 'type' => 'hidden', 'value' => 0)); ?>
                <?= $this->Form->end(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="addLink" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<div id="dialog-confirm-link" class="dialog-confirm" title="Are you delele?">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>These link will be permanently deleted. Are you sure?</p>
</div>
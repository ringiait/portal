<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#info" aria-controls="info" role="tab" data-toggle="tab">Information</a></li>
</ul>
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="info">
        <table id = "users" class="table table-hover table-bordered ui-widget ui-widget-content">
            <thead>
                <tr class = "first ui-widget-header">
                    <td><?= $this->Paginator->sort('Redmine_ID');?></td>
                    <td><?= $this->Paginator->sort('release_date');?></td>
                    <td><?= $this->Paginator->sort('user_release');?></td>
                    <td><?= $this->Paginator->sort('title_release');?></td>
                    <td><span class="glyphicon glyphicon-hand-down" aria-hidden="true"></span></td>
                </tr>
            </thead>
            <tbody>
            <?php foreach($ele_release as $data){ ?> <!-- show data !-->
                <tr>
                    <td id="redmine_id<?= $data['id']; ?>"><?= $data['redmine_id']; ?></td>
                    <td id="release_date<?= $data['id']; ?>"><?= $data['release_date']; ?></td>
                    <td><?=$data['user_release']; ?></td>
                    <td style= "word-break: break-all;"><?= mb_substr($data['title_release'],0,10); ?>
                        <input type = "hidden" id="title_release<?= $data['id']; ?>" value="<?= $data['title_release']; ?>" />
                    </td>
                    <td>
                    <?= $this->Html->link((''),['action'=>'details',$data['id']],array('class' => 'glyphicon glyphicon-list-alt')); ?>
                    <div style = " margin-left: 15px; margin-right:15px; ; cursor:pointer;" class="glyphicon glyphicon-trash" onclick="deleteRelease(<?= $data['id']; ?>);">    
                    </div>
                    <div style = "cursor:pointer;" onclick="editRelease(<?= $data['id']; ?>)" class="glyphicon glyphicon-wrench"> 
                    </div>
                    </td>
                     <input type = "hidden" id="user_release<?= $data['id']; ?>" value="<?= $data['user_release']; ?>" />
                        <div style = "display:none;">
                         <input type = "hidden" id="inlineCheckbox1<?= $data['id']; ?>" value="<?= (int)$data['has_change_db']; ?>" />
                         <input type = "hidden" id="inlineCheckbox2<?= $data['id']; ?>" value="<?= (int)$data['db_backup']; ?>" />
                    <input type = "hidden" id="status<?= $data['id']; ?>" value="<?= $data['status']; ?>" /></div>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <div class="paginator" >
            <ul class="pagination">
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
            </ul>
            <p><?= $this->Paginator->counter() ?></p>
        </div>
        <button id="create-user" class = "btn btn-success">Create New Release</button>
        <?= $this->element('addRelease'); ?>
    </div>
</div>
<div style=" display: none;" id="dialog-confirm-deleteRelease" class="dialog-confirm-deleteRelease" title="Are you delete?">
<p><span class="ui-icon ui-icon-trash" style=" float:left; margin:0 7px 20px 0;"></span>Your Release Note will be deleted. Are you sure?</p>
</div>

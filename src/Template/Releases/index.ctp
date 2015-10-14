<?= $this->element('title_page', array('title_page' => __('List Release'))) ?>
<?= $this->Flash->render('positive') ?>
<div class="header">
    <div class="">
        <table class="table table-striped" style="margin-bottom: 0px;" width="100%">
            <tr class="danger">
                <th width="3%">#</th>
                <th width="10%">
                    <?= __('Redmine Id') ?>
                </th>
                <th width="10%">
                    <?= __('Release Date') ?>
                </th>
                <th width="10%">
                    <?= __('Change DB') ?>
                </th>
                <th width="10%">
                    <?= __('Backup DB') ?>
                </th>
                <th width="10%">
                    <?= __('Pass Checklist') ?>
                </th>
                <th width="10%">
                    <?= __('Status') ?>
                </th>
                <th width="10%">
                    <?= __('Created Date') ?>
                </th>
                <th width="10%">
                    <?= __('Modified Date') ?>
                </th>
                <th align="left" width="4%">
                    <a href="/releases/add?item_menu=6" >
                        <span class="glyphicon glyphicon-plus"></span>
                    </a>
                </th>
            </tr>
            <?php if(!empty($arrDataRelease)): ?>
            <?php $i = 1 ?>
            <?php foreach($arrDataRelease as $kDataRelease => $vDataRelease): ?>
                <tr>
                    <td>
                        <?= $i ?>
                    </td>
                    <td>
                        <?= $this->Html->link($vDataRelease->redmine_id, "/releases/detail/" . $vDataRelease->id, ['class' => 'edit']); ?>
                    </td>
                    <td>
                        <?= date("Y-m-d H:i:s", strtotime($vDataRelease->release_date)) ?>
                    </td>
                    <td>
                        <?php if ( $vDataRelease->has_change_db == 1): ?>
                            <button class="btn btn-success" type="button"><?= __('yes') ?></button>
                        <?php else: ?>
                            <button class="btn btn-danger" type="button"><?= __('no') ?></button>
                        <?php endif ?>
                    </td>
                    <td>
                        <?php if ( $vDataRelease->db_backup == 1): ?>
                            <button class="btn btn-success" type="button"><?= __('yes') ?></button>
                        <?php else: ?>
                            <button class="btn btn-danger" type="button"><?= __('no') ?></button>
                        <?php endif ?>
                    </td>
                    <td>
                        <?= $statusChecklist[$vDataRelease->pass_checklist] ?>
                    </td>
                    <td>
                        <?= isset($statusRelease[$vDataRelease->status]) ? $statusRelease[$vDataRelease->status] : "" ?>
                    </td>
                    <td>
                        <?= $vDataRelease->created ?>
                    </td>
                    <td>
                        <?= $vDataRelease->modified ?>
                    </td>
                    <td>
                        <a href="/releases/add/<?= $vDataRelease->id ?>">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                        <a href="/releases/deleteRelease/<?= $vDataRelease->id ?>">
                            <span class="glyphicon glyphicon-trash"></span>
                        </a>
                    </td>
                </tr>
                <?php $i++ ?>
            <?php endforeach ?>
            <?php endif ?>

        </table>

    </div>
</div>
<ul class="pager">
    <?= $this->Paginator->prev('« Previous') ?>
    <?= $this->Paginator->numbers() ?>
    <?= $this->Paginator->next('Next »') ?>
</ul>
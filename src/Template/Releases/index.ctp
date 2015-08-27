<div class="header">
    <div class="colum-item">
        <table class="table table-striped" style="margin-bottom: 0px;">
            <tr class="danger">
                <th>#</th>
                <th width="70%">
                    <?= __('Redmine Id') ?>
                </th>
                <th width="70%">
                    <?= __('Release Date') ?>
                </th>
                <th width="70%">
                    <?= __('Change DB') ?>
                </th>
                <th width="70%">
                    <?= __('Pass Checklist') ?>
                </th>
                <th width="70%">
                    <?= __('Backup DB') ?>
                </th>
                <th width="70%">
                    <?= __('Status') ?>
                </th>
                <th width="70%">
                    <?= __('Created Date') ?>
                </th>
                <th width="70%">
                    <?= __('Modified Date') ?>
                </th>
                <th align="left">
                    <a data-toggle="modal" data-target="#linkModal" data-title="add" data-member='' data-type="">
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
                        <?= $vDataRelease->has_change_db ?>
                    </td>
                    <td>
                        <?= $vDataRelease->pass_checklist ?>
                    </td>
                    <td>
                        <?= $vDataRelease->db_backup ?>
                    </td>
                    <td>
                        <?= $vDataRelease->status ?>
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
                        <a href="/releases/edit/<?= $vDataRelease->id ?>">
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
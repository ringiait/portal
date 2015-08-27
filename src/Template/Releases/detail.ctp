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
$this->assign('title', $title);
?>

<?php if (! empty($arrDataRelease)): ?>
    <?php foreach ($arrDataRelease as $key => $value): ?>
        <fieldset>
            <legend class="legendStyle">
                <?= __('Release Information') ?>
            </legend>
            <table class="table table-striped" style="margin-bottom: 0px;">
                <tr>
                    <td><?= __('ID') ?></td>
                    <td>
                        <?= $value->id ?>
                        <?= $this->Form->input('', array('id' => 'releaseID', 'type' => 'hidden', 'value' => $value->id)); ?>
                    </td>
                </tr>
                <tr>
                    <td><?= __('Redmine ID') ?></td>
                    <td>
                        <?= $value->redmine_id ?>
                        <?= $this->Form->input('', array('id' => 'redmineID', 'type' => 'hidden', 'value' => $value->redmine_id)); ?>
                    </td>
                </tr>
                <tr>
                    <td><?= __('Release Date') ?></td>
                    <td><?= $value->release_date ?></td>
                </tr>
                <tr>
                    <td><?= __('Has Change Databse') ?></td>
                    <td><?= $value->has_change_db ?></td>
                </tr>
                <tr>
                    <td><?= __('Pass Checklist') ?></td>
                    <td><?= $statusChecklist[$value->pass_checklist] ?></td>
                </tr>
                <tr>
                    <td><?= __('Database Backup') ?></td>
                    <td><?= $value->db_backup ?></td>
                </tr>
                <tr>
                    <td><?= __('Status') ?></td>
                    <td><?= $statusRelease[$value->status] ?></td>
                </tr>
                <tr>
                    <td><?= __('Create Time') ?></td>
                    <td><?= $value->created ?></td>
                </tr>
                <tr>
                    <td><?= __('Modified Time') ?></td>
                    <td><?= $value->modified ?></td>
                </tr>
                <tr>
                    <td><?= __('List Task') ?></td>
                    <td>
                        <?php
                            if (! empty($value->release_task)) {
                                $listTask = "";
                                foreach ($value->release_task as $krlTask => $vrlTask) {
                                    if ($listTask == "") {
                                        $listTask = $vrlTask->task_id;
                                    } else {
                                        $listTask = $listTask . ", " . $vrlTask->task_id;
                                    }
                                }
                                echo $listTask;
                            }
                        ?>
                    </td>
                </tr>
            </table>
        </fieldset>
        <fieldset>
            <legend class="legendStyle">
                <?= __('Release Process') ?>
			<span style="float: right;" >
				<a data-toggle="modal" data-target="#releaseModal" data-title="add">
                    <span class="glyphicon glyphicon-plus"></span>
                </a>
			</span>
            </legend>
            <?php if (! empty($value->release_process)): ?>
                <table width="100%">
                    <tr>
                        <td>#</td>
                        <td><?= __("Todo") ?></td>
                        <td><?= __("Time") ?></td>
                        <td><?= __("Member Do") ?></td>
                        <td><?= __("Member Review") ?></td>
                        <td><?= __("Status") ?></td>
                        <td><?= __("Note") ?></td>
                        <td><?= __("Created") ?></td>
                        <td><?= __("Modified") ?></td>
                        <td><?= __("###") ?></td>
                    </tr>
                    <?php $i = 1 ?>
                    <?php foreach ($value->release_process as $kProcess => $vProcess): ?>
                        <tr>
                            <td><?= $i ?> </td>
                            <td id="pToDo<?= $vProcess->id ?>"><?= $vProcess->todo ?></td>
                            <td id="pTime<?= $vProcess->id ?>"><?= $vProcess->time ?></td>
                            <td>
                                <?= $arrUserId[$vProcess->member_do] ?>
                                <?= $this->Form->input('', array('id' => "pMemberDo" . $vProcess->id, 'type' => 'hidden', 'value' => $vProcess->member_do)); ?>
                            </td>
                            <td>
                                <?= $arrUserId[$vProcess->member_review] ?>
                                <?= $this->Form->input('', array('id' => "pMemberReview" . $vProcess->id, 'type' => 'hidden', 'value' => $vProcess->member_review)); ?>
                            </td>
                            <td>
                                <?= $statusProcessRelease[$vProcess->status] ?>
                                <?= $this->Form->input('', array('id' => "pStatus" . $vProcess->id, 'type' => 'hidden', 'value' => $vProcess->status)); ?>
                            </td>
                            <td id="pNote<?= $vProcess->id ?>"><?= $vProcess->note ?></td>
                            <td><?= $vProcess->created ?></td>
                            <td><?= $vProcess->modified ?></td>
                            <td>
                                <span style="" >
                                    <a data-toggle="modal" data-target="#releaseModal" data-title="edit" data-release='<?= $vProcess->id ?>'>
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </a>
                                    <a onclick="deleteReleaseProcess(<?= $vProcess->id ?>);">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
							    </span>
                            </td>
                        </tr>
                        <?php $i++ ?>
                    <?php endforeach ?>
                </table>
            <?php endif ?>
        </fieldset>
    <?php endforeach ?>
<?php endif ?>
<?= $this->element('add_process_release'); ?>
<script>
    $(function() {
        $( "#datepicker" ).datetimepicker({
            dateFormat: 'yy-mm-dd'
        });
        $("#timeDo").datetimepicker({
            dateFormat: 'yy-mm-dd'
        });
    });

    $(document).ready(function() {
        $("#releaseModal").on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var title = button.data('title');
            if (title === 'edit') {
                var releaseProcessID = button.data('release');
                $("#processID").val(releaseProcessID);
                var toDo = $("#pToDo" + releaseProcessID).html();
                $("#todo").val(toDo);
                var timeDo = $("#pTime" + releaseProcessID).html();
                $("#timeDo").val(timeDo);
                var memberDo = $("#pMemberDo" + releaseProcessID).val();
                $("#member-do").val(memberDo);
                var memberReview = $("#pMemberReview" + releaseProcessID).val();
                $("#member-review").val(memberReview);
                var status = $("#pStatus" + releaseProcessID).val();
                $("#status").val(status);
                var note = $("#pNote" + releaseProcessID).html();
                $("#note").val(note);
            } else {
                $("#processID").val(0);
            }
        });

        $("#addReleaseProcess").click(function() {
            var toDo = $("#todo").val();
            var timeDo = $("#timeDo").val();
            var memberDo = $("#member-do").val();
            var memberReview = $("#member-review").val();
            var status = $("#status").val();
            var note = $("#note").val();
            var releaseID = $("#releaseID").val();
            var redmineID = $("#redmineID").val();
            var id = $("#processID").val();
            $.ajax({
                beforeSend: function(){
                },
                delay: 0,
                url: '/releases/saveProcess',
                type: 'POST',
                dataType: 'json',
                data : { id : id, redmine_id : redmineID, release_id : releaseID, todo : toDo, time : timeDo, member_do : memberDo, member_review : memberReview, status : status, note : note},
                success: function(data){
                    if(data.status == true){
                        alert(data.msg);
                        window.location.reload(true);
                    }else{
                        alert(data.msg);
                    }
                }
            });
        });

    });

    function deleteReleaseProcess(processID) {
        $( "#dialog-confirm" ).dialog({
            resizable: false,
            height:250,
            width:350,
            modal: true,
            buttons: {
                "Delete": function() {
                    $.ajax({
                        beforeSend: function(){
                        },
                        delay: 0,
                        url: '/releases/deleteProcess',
                        type: 'POST',
                        dataType: 'json',
                        data : { id : processID },
                        success: function(data){
                            if(data.status == true){
                                alert(data.msg);
                                window.location.reload(true);
                            }else{
                                alert(data.msg);
                            }
                            $( this ).dialog( "close" );
                        }
                    });
                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
    }

</script>

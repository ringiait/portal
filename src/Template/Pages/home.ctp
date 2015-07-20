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
            <a href="#" data-toggle="modal" data-target="#memberModal" data-title="add">
                <span class="glyphicon glyphicon-plus"></span>
            </a>
        </legend>
	<div class="team-member">
        <?php if(is_array($users) && count($users) > 0): ?>
            <?php foreach($users as $key => $dataUser): ?>
                <div class="colum-item">
                    <h1 class="<?= $dataUser->style ?>" id='fullname<?= $dataUser->id ?>'><?= $dataUser->full_name ?> </h1>
                    <p><?= __('Chức vụ') . ': <strong id="office' . $dataUser->id . '">' . $listPosition[$dataUser->office_id] . '</strong>' ?></p>
                    <p><?= __('Số ĐT') . ': <strong id="phone' . $dataUser->id . '">' . $dataUser->phone . '</strong>' ?></p>
                    <p><?= __('Email') . ': <strong id="email' . $dataUser->id . '">' .$dataUser->email . '</strong>' ?></p>
                    <p><?= __('Skype') . ': <strong id="skype' . $dataUser->id . '">' . $dataUser->skype . '</strong>' ?></p>
                    <?= $this->Form->input('username', array('id' => 'username' . $dataUser->id, 'type' => 'hidden', 'value' => $dataUser->tms_username)); ?>
                    <?= $this->Form->input('address', array('id' => 'address' . $dataUser->id, 'type' => 'hidden', 'value' => $dataUser->address)); ?>
                    <?= $this->Form->input('style', array('id' => 'style' . $dataUser->id, 'type' => 'hidden', 'value' => $dataUser->style)); ?>
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
	<!-- Main information of Ringi -->
	<div class="header">
		<div class="colum-item">
			<h1>Ringi Portal</h1>
			<ol>
				<li><a rel="nofollow" target="_blank" href="https://redmine.1steam.com:8443/projects/ringi">Link to Redmine</a></li>
				<li><a rel="nofollow" target="_blank" href="https://docs.google.com/a/ai-t.vn/spreadsheets/d/1fsenOFPJDF_0mjKmLZL-_pfWgjtZ0Pg1juBDJl2uoAU/edit#gid=0">Dev request upcode &amp; up code logs</a></li>
				<li><a rel="nofollow" target="_blank" href="https://docs.google.com/a/ai-t.vn/spreadsheets/d/1Rth9CGqUALtLOMSYZorCOpsivozC1BZREMj4cubEeMc/edit#gid=393872852">Check list release server</a></li>
				<li><a rel="nofollow" target="_blank" href="https://docs.google.com/a/ai-t.vn/spreadsheets/d/1Rth9CGqUALtLOMSYZorCOpsivozC1BZREMj4cubEeMc/edit#gid=1256904670">Release note server mẫu</a></li>
				<li><a rel="nofollow" target="_blank" href="https://docs.google.com/a/ai-t.vn/spreadsheets/d/1Rth9CGqUALtLOMSYZorCOpsivozC1BZREMj4cubEeMc/edit#gid=1026896915">Check list build IOS</a></li>
				<li><a rel="nofollow" target="_blank" href="https://docs.google.com/a/ai-t.vn/spreadsheets/d/1Rth9CGqUALtLOMSYZorCOpsivozC1BZREMj4cubEeMc/edit#gid=0">Check list build android</a></li>
				<li><a rel="nofollow" target="_blank" href="https://docs.google.com/a/ai-t.vn/spreadsheets/d/1Rth9CGqUALtLOMSYZorCOpsivozC1BZREMj4cubEeMc/edit#gid=1764784669">Release note build android &amp; IOS mẫu</a></li>
				<li><a rel="nofollow" target="_blank" href="https://svn.ai-t-vietnam.com/repos/ringi_repos/">SVN</a></li>
				<li><a rel="nofollow" target="_blank" href="https://git.1steam.com/groups/ringi">GIT</a></li>
			</ol>
		</div>
		<div class="colum-item">
			<h1>Link hệ thống</h1>
			<ol>
				<li><a rel="nofollow" target="_blank" href="https://eapply.adways.net/">Production Web</a></li>
				<li><a rel="nofollow" target="_blank" href="https://eapply-staging.adways.net/">Staging Web</a></li>
				<li><a rel="nofollow" target="_blank" href="https://eapply-test.adways.net/">Test Web</a></li>
				<li><a rel="nofollow" target="_blank" href="https://ringi-dev.ai-t.mobi:4343/">Dev Web</a></li>
				<li><a rel="nofollow" target="_blank" href="https://eapply-dev.adways.net/">Pma trên server thật</a></li>
				<li><a rel="nofollow" target="_blank" href="https://ringi-dev.ai-t.mobi:4343/pmadadver/">Pma trên server dev</a></li>
				<li><a rel="nofollow" target="_blank" href="https://eapply-test-sp.adways.net/appdl/ringi1.php">Link tải app test (IOS &amp; Android)</a></li>
				<li><a rel="nofollow" target="_blank" href="https://eapply-sp.adways.net/appdl/ringi.php">Link tải app end user (IOS &amp; Android)</a></li>
				<li><a rel="nofollow" target="_blank" href="http://testlink.ai-t-vietnam.com:8080/login.php">Test Link</a></li>            			
			</ol>
		</div>
		
		<div class="colum-item">
			<h1>Link Report</h1>
			<ol>           
				<li><a rel="nofollow" target="_blank" href="https://docs.google.com/a/ai-t.vn/spreadsheets/d/19BqYSoY1bEbj1zhLd521O0EyaS0SfuSUXosf2i387WE">Daily &amp; Weekly Schedule</a></li>
				<li><a rel="nofollow" target="_blank" href="https://docs.google.com/a/ai-t.vn/spreadsheets/d/1YeppfT6AzcNwCJKx9i7WmxjBSejM3BL2qRs-qqch9J4/edit#gid=0">Plan Task Detail</a></li>
				<li><a rel="nofollow" target="_blank" href="https://docs.google.com/a/ai-t.vn/spreadsheets/d/1657OBqPeYAhkr8LVrZEFVqThvHIVxvTTkp225lb8nH0">VN Diary report</a></li>
				<li><a rel="nofollow" target="_blank" href="https://docs.google.com/a/ai-t.vn/spreadsheets/d/1Bink4DzhnAwOQslYaDBptyJShlee3cIO0sVw5ram6eg">JP Diary report</a></li>
				<li><a rel="nofollow" target="_blank" href="https://docs.google.com/a/ai-t.vn/spreadsheets/d/1VrzaEi5TXCOFdmC59_zpR9QqFtsuZmwcXjavndxXCOk">Test report</a></li>
				<li><a rel="nofollow" target="_blank" href="https://docs.google.com/a/ai-t.vn/spreadsheets/d/1g8Z6zjIo0q3Xzfor9bMEF8IonuHcrj8x9V6UDkzZHJY">Review TC của dev</a></li>
				<li><a rel="nofollow" target="_blank" href="https://docs.google.com/spreadsheets/d/19BqYSoY1bEbj1zhLd521O0EyaS0SfuSUXosf2i387WE/edit#gid=1139203523">Ringi Schedule</a></li>

				<li><a rel="nofollow" target="_blank" href="https://docs.google.com/spreadsheets/d/1UlHIWoq3oiT-EtaLITwzY78iCZxX6Foo7WgQQCXS_x4/edit#gid=2072768977">Bug report</a></li>
				<li><a rel="nofollow" target="_blank" href="https://docs.google.com/spreadsheets/d/1G1kwBjdZ2Lio6_AfKZCpfeWJs_v04fetcJ70aqHqojs/edit#gid=260938026">Quality report</a></li>
			</ol>
		</div>	
		
		<div class="colum-item">
			<h1>Link Tài liệu</h1>
			<ol>  		
				<li><a rel="nofollow" target="_blank" href="https://docs.google.com/a/ai-t.vn/spreadsheets/d/14ELJZbfGrhO37ob6yJqSUeRCBTCe38YaLzv2mAvOR70/edit#gid=0">Server setting logs</a></li>
				<li><a rel="nofollow" target="_blank" href="https://docs.google.com/a/ai-t.vn/spreadsheets/d/18mUMjvcHQtpA8urn0lLO-jR3Wfnr24R9R1wDCMQQWS4/edit#gid=580276073">Tài liệu các task của Dev</a></li>
				<li><a rel="nofollow" target="_blank" href="https://docs.google.com/a/ai-t.vn/spreadsheets/d/1IjvnfPSk6CLAocq9-hlRRx1oAbe--S8f48ZZKrQkozU/edit#gid=1605078349">QA &amp; Logic Note: Đơn nhân sự(Pending)</a></li>
				<li><a rel="nofollow" style="color:red;" target="_blank" href="https://docs.google.com/a/ai-t.vn/spreadsheets/d/1lPliWX7tPzI9_AXzD6bFHEZQdigA8LqhiGWNWW4ROAo/edit#gid=120747335">QA &amp; Logic Note: Đơn hiếu hỉ</a></li>    		
				<li><a rel="nofollow" target="_blank" href="https://docs.google.com/a/ai-t.vn/spreadsheet/ccc?key=0Ali3ZBWc_6WAdDJHV3hURHFPRUZfODhkQ0tLVGl5aEE&amp;usp=drive_web#gid=0">QA &amp; Logic Note: Đơn xin dấu</a></li>                    
				<li><a rel="nofollow" target="_blank" href="https://docs.google.com/a/ai-t.vn/spreadsheet/ccc?key=0AokdSZssV1nZdG9vNmpOdlFvMlRGdXpzVjQ0RExEVWc#gid=1">QA &amp; Logic Note: Ringi cũ (HangDT)</a></li>
				<li><a rel="nofollow" target="_blank" href="https://docs.google.com/a/ai-t.vn/spreadsheet/ccc?key=0AokdSZssV1nZdDhwbmU2TTdVRUVrRS1wbUVNR2otd2c#gid=0">Meeting note ringi cũ (HangDT)</a></li>
				<li><a rel="nofollow" target="_blank" href="https://docs.google.com/a/ai-t.vn/presentation/d/1HJnPE4DGh2t5kmE00cd67Dqhpei6g9Don1XVsjS7oI0/edit#slide=id.g2c6ac9ace_011">Server Note tổng hợp (ThanhDN)</a></li>		
				<li><a rel="nofollow" target="_blank" href="https://docs.google.com/spreadsheets/d/1SLJWJETERh1rEhw5ilp-6R04RzWvu5zw2B_qKFnAD-M/edit#gid=297322172">Ringi KPT</a></li>		
				<li><a rel="nofollow" target="_blank" href="https://docs.google.com/spreadsheets/d/1458ZQNhhJORTtN34B6i2fMY8kaqe2pPlsg-sWQyK6p8/edit#gid=0">Ringi Language Change Log</a></li>		
				<li><a rel="nofollow" target="_blank" href="https://docs.google.com/spreadsheets/d/1mkb5HX7EmlZYTYC8GSv9znCf4H2_D_9S8l-Saj0cT8M/edit#gid=1678431705">Meeting Notes 2015</a></li>		
				<li><a rel="nofollow" target="_blank" href="https://docs.google.com/spreadsheets/d/1i_qtCa5nb3TftvPSqmGSFp8AQiLumEv5d-yakIwf_ks/edit#gid=0">QA Ringi</a></li>		
			</ol>
		</div>
		<div class="clearFix"></div>
	</div>
	
</div>

<?= $this->element('add_user'); ?>

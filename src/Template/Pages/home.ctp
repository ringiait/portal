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
	<div class="team-member">
		<div class="colum-item">
			<h1>Lê anh Hoài</h1>              
				<p>Chức vụ: <strong>Leader</strong></p>
				<p>Số ĐT: <strong>0942.705.<span>750</span></strong></p>
				<p>Email: <strong>hoaila@ai-t.vn</strong></p>
				<p>Skype: <strong>le.anh.hoai</strong></p>
		</div>
		<div class="colum-item">
			<h1>Trần Thị Thúy Hằng</h1>              
				<p>Chức vụ: <strong>Comtor</strong></p>
				<p>Số ĐT: <strong>+818096776<span>759</span></strong></p>
				<p>Email: <strong>hangttt@ai-t.vn</strong></p>
				<p>Skype: <strong>tranhang1912</strong></p>
		</div>
		<div class="colum-item">
			<h1>Phạm Đức Tùng</h1>              
				<p>Chức vụ: <strong>Comtor/Dev</strong></p>
				<p>Số ĐT: <strong>0986.984.<span>262</span></strong></p>
				<p>Email: <strong>tungpd@ai-t.vn</strong></p>
				<p>Skype: <strong>tungpd84</strong></p>
		</div>
		<div class="colum-item">
			<h1>Đinh Văn Chung</h1>              
				<p>Chức vụ: <strong>Developer</strong></p>
				<p>Số ĐT: <strong>0166.888.<span>6999</span></strong></p>
				<p>Email: <strong>chungdv@ai-t.vn</strong></p>
				<p>Skype: <strong>chungdv1984</strong></p>
		</div>
		<div class="colum-item">
			<h1>Nguyễn Huy Văn</h1>              
				<p>Chức vụ: <strong>Developer</strong></p>
				<p>Số ĐT: <strong>0168.637.<span>6009</span></strong></p>
				<p>Email: <strong>vannh@ai-t.vn</strong></p>
				<p>Skype: <strong>huyvan_8x</strong></p>
		</div>
		<div class="colum-item">
			<h1>Nguyễn Thành</h1>              
				<p>Chức vụ: <strong>Developer</strong></p>
				<p>Số ĐT: <strong>0169.534.<span>1410</span></strong></p>
				<p>Email: <strong>thanhn@ai-t.vn</strong></p>
				<p>Skype: <strong>nguyenthanhictu</strong></p>
		</div>
		<div class="colum-item">
			<h1>Mai Thị Hồng Hạnh</h1>              
				<p>Chức vụ: <strong>Tester</strong></p>
				<p>Số ĐT: <strong>0165.699.<span>1992</span></strong></p>
				<p>Email: <strong>hanhmth@ai-t.vn</strong></p>
				<p>Skype: <strong>maihanh-st</strong></p>
		</div>                
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
	
	<?php echo $linkHtml; ?>
	
</div>

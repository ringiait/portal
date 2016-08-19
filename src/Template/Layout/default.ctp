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

?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('bootstrap.css') ?>
    <?= $this->Html->css('bootstrap-theme.css') ?>
    <?= $this->Html->css('jquery.datetimepicker.css')?>
    <?= $this->Html->css('jquery-ui.css')?>
    <?= $this->Html->css('jquery-ui.theme.css')?>
    <?= $this->Html->css('edit_info.css')?>
     <?= $this->Html->css('add_user.css') ?>
     <?= $this->Html->css('style.css') ?>
    <?= $this->Html->script('jquery-2.2.0.js') ?>
    <?= $this->Html->script('jquery-ui.js') ?>
    <?= $this->Html->script('bootstrap.js')?>
    <?= $this->Html->script('jquery.datetimepicker.full.js') ?>
    <?= $this->Html->script('Release.js') ?>
    <?= $this->Html->script('ReleaseTask.js') ?>
    <?= $this->Html->script('ReleaseFile.js') ?>
    <?= $this->Html->script('ReleaseDB.js') ?>
    <?= $this->Html->script('ReleaseExpected.js') ?>
    <?= $this->Html->script('Schedule.js') ?>
    <?= $this->Html->script('npm') ?>
    <?= $this->Html->script('user') ?>
    <?= $this->Html->script('task') ?>
    <?= $this->Html->script('link') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <header>        
	  <?php
		echo $MenuHtml;
	  ?>
    </header>
    <div id="container" class="container">

        <div id="content">
            <?= $this->Flash->render('success') ?>
            <?= $this->Flash->render('error') ?>

            <div class="row">
                <?= $this->fetch('content') ?>
            </div>
        </div>
        <footer>
        </footer>
    </div>
</body>
</html>

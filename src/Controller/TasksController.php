<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\ORM\TableRegistry;
/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class TasksController extends AppController
{
	public $helpers = [
		'Form' => [
			'className' => 'Bootstrap3.BootstrapForm',
			'useCustomFileInput' => true
		]
	];
    /**
     * Fucntion to display form to add new task
     * Author	: 	Hoaila
	 * Date		: 	15/07/2015
     * @return void
     * 
     */
    public function add()
    {
		//tạo mảng user assigned
		$arrMembers = array(1 => 'hoaila', 2 => 'thanhn', 3 => 'vannh'); //sau này đổi thành arr member từ db
		
		$this->set('title', 'Add New Task Document');
		$this->set('arrMembers', $arrMembers);
    }
	
	
    /**
     * Function to save task to data base
     * Author	: 	Hoaila
	 * Date		: 	15/07/2015
     *
     * @return redirect back.
     * @throws Exception Database.
     */
	function saveTask(){ 
		$Tasks = TableRegistry::get('Tasks');
		
		$this->autoRender = false;
		$data = $this->request['data'];
		$taskArr = $Tasks->newEntity($this->request->data());
		
		//Thêm đoạn validate data vao đây. Tạm thời chưa làm
		
		
		//gan giá trị neu task moi
		if($id) {
			$taskArr->created	= date('Y/m/d G:i:s', time());
			$taskArr->modified = date('Y/m/d G:i:s', time());
		}
		
		//tạo transacion
		$res = $Tasks->updateAll($taskArr);
		if ($res) {
			$this->Flash->set('The task has been saved.', [
				'element' => 'success'
			]);
		} else {
			$this->Flash->set('The task cannot be saved.', [
				'element' => 'error'
			]);
		}
		return $this->redirect('/');
	}
}

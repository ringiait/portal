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
use Cake\Config\AppConst;
use Cake\Controller\Component\FlashComponent;
/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class TasksController extends AppController
{
    public $name = 'Tasks';
    public $uses = array('Member');
    
    public function initialize()
    {
        // Always enable the CSRF component.
        $this->loadComponent('Csrf');
        $this->loadComponent('Flash');
    }
    
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
        $MemberTable = TableRegistry::get('Member');
        
		// Get data member from DB   
        $dataMembers = $MemberTable->find('all')->toArray();
        
        // Get array member
        $arrMembers = array();
        if(!empty($dataMembers)){
            foreach($dataMembers as $key => $value){
                $arrMembers[$value['id']] = $value['full_name'];
            }
        }
        
        // Define function type
        $arrFuncType = Configure::read('arrFuncType');    
        
        // Define database status optimized
        $arrDbOtimized  = Configure::read('arrDbOtimized');   
        
        // Define database status optimized
        $arrProcessStatus = Configure::read('arrProcessStatus');
		
		$this->set('title', 'Add New Task Document');
		$this->set('arrMembers', $arrMembers);
		$this->set('arrFuncType', $arrFuncType);
		$this->set('arrDbOtimized', $arrDbOtimized);
		$this->set('arrProcessStatus', $arrProcessStatus);
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
		$tasksTable = TableRegistry::get('Tasks');		
		$this->autoRender = false;
        
        if ($this->request->is('post')){
            // Get data when submit
            $data = $this->request->data;
            
            // Set data to entity
    		$dataTasks = $tasksTable->newEntity();
            
            // Set data to update table rpt_tasks
            $dataTasks->redmine_id = (!empty($data['redmine_id'])) ? $data['redmine_id'] : '';
            $dataTasks->assigned = (!empty($data['assigned'])) ? $data['assigned'] : 0;
            $dataTasks->title = (!empty($data['title'])) ? $data['title'] : '';
            $dataTasks->task_goal = (!empty($data['task_goal'])) ? $data['task_goal'] : '';            
            $dataTasks->test_cases = (!empty($data['test_cases'])) ? $data['test_cases'] : '';
            $dataTasks->modified = date('Y/m/d G:i:s', time());
            $dataTasks->created = date('Y/m/d G:i:s', time());
            
            // Lam sau
            //$dataUpdateTask['doc_file'] = (!empty($data['doc_file'])) ? $data['doc_file'] : '';
    		
            
            // Save to DB
    		$ressult = $tasksTable->save($dataTasks);
    		if ($ressult) {
    			$this->Flash->success('Tạo task thành công!', [
                    'key' => 'success',
                ]);
    		} else {
    			$this->Flash->error('Tạo task thất bại!', [
                    'key' => 'error',
                ]);
    		}
            
    		return $this->redirect('/tasks/add');
      }
	}
}

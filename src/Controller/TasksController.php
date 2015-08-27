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
    
    public function initialize1()
    {
        // Always enable the CSRF component.
        $this->loadComponent('Csrf');
        $this->loadComponent('Flash');
		$MenuHtml = $this->cell('Menu');
		$this->set('MenuHtml', $MenuHtml);	
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
    public function add(){
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
            $data = $this->request->data;debug($data);die;
            
            // Set data to entity
    		$dataTasks = $tasksTable->newEntity();
            
            // Set data to update table rpt_tasks
            $dataTasks->redmine_id = (!empty($data['redmine_id'])) ? $data['redmine_id'] : '';
            $dataTasks->assigned = (!empty($data['assigned'])) ? $data['assigned'] : 0;
            $dataTasks->title = (!empty($data['title'])) ? $data['title'] : '';
            $dataTasks->task_goal = (!empty($data['task_goal'])) ? $data['task_goal'] : '';            
            $dataTasks->test_cases = (!empty($data['test_case'])) ? $data['test_case'] : '';
            $dataTasks->modified = date('Y/m/d G:i:s', time());
            $dataTasks->created = date('Y/m/d G:i:s', time());
            
            $strFileUpload = '';
            
            
            //Loop through each file
            if(!empty($_FILES['fileUpload'])){
                $pathFileStore = 'uploadFiles/'.date('Y-m-d').'/'.time();
                $this->createDirPath($pathFileStore);
                                
                for($i=0; $i<count($_FILES['fileUpload']['name']); $i++) {
                                                            
                  //Get the temp file path
                  $tmpFilePath = $_FILES['fileUpload']['tmp_name'][$i];
                
                  //Make sure we have a filepath
                  if ($tmpFilePath != ""){
                    //Setup our new file path
                    $newFilePath = $pathFileStore.'/'.$_FILES['fileUpload']['name'][$i];
                
                    //Upload the file into the temp dir
                    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                        $strFileUpload .= $newFilePath.',';
                    }
                  }
                }
                
                if(!empty($strFileUpload)){
                    rtrim($strFileUpload, ",");
                }
            } 
            
            // Set doc_file
            $dataTasks->doc_file = $strFileUpload;           
            
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
    
    /**
     * Function to create directoty path
     * Author	: 	ThanhN
	 * Date		: 	21/07/2015
     *
     */
	function createDirPath($path, $from_root = 0){
		$path_full = ($from_root) ? '/' : '../webroot';
		$result =array();
		if($path)
		{

			$arr_path = explode('/', $path);

			if (!empty($arr_path))
			{
				foreach ($arr_path as $val)
				{
					if($val)
					{
						$path_full .='/'.$val;
						$this->makeDir($path_full);
					}
				}
			}
			
		}
		return $path_full;
		
	}
    
    /**
	 * create forlder
	 * @author ThanhN
	 * @create date: 2015/07/21
	 * @param $string
	 * @return array
	 */
	static public function makeDir($path)
	{
		return is_dir($path) || mkdir($path,0777);
	}
}

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
     * Author	: 	VanNH
	 * Date		: 	16/07/2015
     * @return void
     * 
     */

    public function index()
    {
        $task = $this->Tasks->find('all');
        $this->set(compact('task')); 
        $UsersTable = TableRegistry::get('Users');
        $ProjectsTable = TableRegistry::get('Projects');
        
        // Get data member from DB   
        $dataUsers = $UsersTable->find('all')->toArray();
        $dataProjects = $ProjectsTable->find('all')->toArray();
        
        // Get array member
        $arrMembers = array();
        $arrProjects = array();
        if(!empty($dataUsers)){
            foreach($dataUsers as $key => $value){
                $arrMembers[$value['id']] = $value['full_name'];
            }
        }
        if(!empty($dataProjects)){
            foreach($dataProjects as $key => $value){
                $arrProjects[$value['id']] = $value['name'];
            }
        }
        
        $this->set('arrMembers', $arrMembers);
        $this->set('arrProjects', $arrProjects);
        $task_status = Configure::read('task_status');  
        $this->set('task_status', $task_status);
    }



     public function chitiet($id = null)
    {
        $this->loadModel('Functionchanges');
        $this->loadModel('Member');
        $this->loadModel('Databasechanges');
        $this->loadModel('Processsteps');
        $task = $this->Tasks->get($id);
        $this->set(compact('task'));
        $functionchange = $this->Functionchanges->find('all');
        $this->set(compact('functionchange')); 
        $databasechange = $this->Databasechanges->find('all');
        $this->set(compact('databasechange')); 
        $processstep = $this->Processsteps->find('all');
        $this->set(compact('processstep')); 

        $arrFuncType = Configure::read('arrFuncType');  
        $this->set('arrFuncType', $arrFuncType);
        $arrDbOtimized = Configure::read('arrDbOtimized');  
        $this->set('arrDbOtimized', $arrDbOtimized);
        $arrProcessStatus = Configure::read('arrProcessStatus');  
        $this->set('arrProcessStatus', $arrProcessStatus);
        $task_status = Configure::read('task_status');  
        $this->set('task_status', $task_status);

        $UsersTable1 = TableRegistry::get('Member');
        $dataUsers1 = $UsersTable1->find('all')->toArray();
        $arrMembers1 = array();
        if(!empty($dataUsers1)){
            foreach($dataUsers1 as $key => $value){
                $arrMembers1[$value['id']] = $value['full_name'];
            }
        }
        $this->set('arrMembers1', $arrMembers1);

    }


    // save function changes
    public function saveFunc()
    {
        
        $this->loadModel('Functionchanges');
        $functionchange = $this->Functionchanges->newEntity(); 
        $arrReturn = array();
        $test = array();
        $test = $this->request->data;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        if ($this->request->is('post')) { 
        // Validate bằng PHP trên server
            $error = $this->validate_func($this->request->data); // kết quả trả về của hàm validate
            if ($error != ""){
                $arrReturn = array("status" => false, "msg" => $error);
            }
            else{
                        $id = $this->request->data['id'];
                           if ($id == 0){
                                $date_now = date("Y-m-d H:i:s");
                                $functionchange->created = $date_now;
                                $functionchange->modified = $date_now;
                            }else{
                                $date_now = date("Y-m-d H:i:s");
                                $functionchange->modified = $date_now;
                            }
                    $functionchange = $this->Functionchanges->patchEntity($functionchange, $this->request->data); 
                    if ($this->Functionchanges->save($functionchange)) {
                        $arrReturn = array("status" => true, "msg" => __("The functionchange has been saved"));
                    } else {
                        $arrReturn = array("status" => false, "msg" => __("The functionchange could not be saved. Please, try again."));
                        }
                }
                        
                
        }
        echo json_encode($arrReturn); 
        die; //đổi kiểu mảng sang chuỗi json. JSON là chữ viết tắt của Javascript Object Notation, đây là một dạng dữ liệu tuân theo một quy luật nhất định mà hầu hết các ngôn ngữ lập trình hiện nay đều có thể đọc được
    }


    // save Process step
    public function saveStep()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $this->loadModel('Processsteps');
        $processstep = $this->Processsteps->newEntity(); 
        $arrReturn = array();
        $test = array();
        $test = $this->request->data;
        if ($this->request->is('post')) { 
        // Validate bằng PHP trên server
            $error = $this->validate_step($this->request->data); // kết quả trả về của hàm validate
            if ($error != ""){
                $arrReturn = array("status" => false, "msg" => $error);
            }
            else{
                    $id = $this->request->data['id'];
                           if ($id == 0) {
                                $date_now = date("Y-m-d H:i:s");
                                $processstep->created = $date_now;
                                $processstep->modified = $date_now;
                            }else{
                                $date_now = date("Y-m-d H:i:s");
                                $processstep->modified = $date_now;
                            }
                    $processstep = $this->Processsteps->patchEntity($processstep, $this->request->data); 
                    if ($this->Processsteps->save($processstep)) {
                        $arrReturn = array("status" => true, "msg" => __("The process step has been saved"));
                    } else {
                        $arrReturn = array("status" => false, "msg" => __("The process step could not be saved. Please, try again."));
                        }
                }
                        
                
        }
        echo json_encode($arrReturn); 
        die; //đổi kiểu mảng sang chuỗi json. JSON là chữ viết tắt của Javascript Object Notation, đây là một dạng dữ liệu tuân theo một quy luật nhất định mà hầu hết các ngôn ngữ lập trình hiện nay đều có thể đọc được
    }



    // save Database
    public function saveDatabase()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $this->loadModel('Databasechanges');
        $databasechange = $this->Databasechanges->newEntity(); 
        $arrReturn = array();
        $test = array();
        $test = $this->request->data;
        if ($this->request->is('post')) { 
        // Validate bằng PHP trên server
            $error = $this->validate_data($this->request->data); // kết quả trả về của hàm validate
            if ($error != ""){
                $arrReturn = array("status" => false, "msg" => $error);
            }
            else{
                    $id = $this->request->data['id'];
                           if ($id == 0) {
                                $date_now = date("Y-m-d H:i:s");
                                $databasechange->created = $date_now;
                                $databasechange->modified = $date_now;
                            }else{
                                $date_now = date("Y-m-d H:i:s");
                                $databasechange->modified = $date_now;
                            }
                    $databasechange = $this->Databasechanges->patchEntity($databasechange, $this->request->data); 
                    if ($this->Databasechanges->save($databasechange)) {
                        $arrReturn = array("status" => true, "msg" => __("The database change has been saved"));
                    } else {
                        $arrReturn = array("status" => false, "msg" => __("The database change could not be saved. Please, try again."));
                        }
                }
                        
                
        }
        echo json_encode($arrReturn); 
        die; //đổi kiểu mảng sang chuỗi json. JSON là chữ viết tắt của Javascript Object Notation, đây là một dạng dữ liệu tuân theo một quy luật nhất định mà hầu hết các ngôn ngữ lập trình hiện nay đều có thể đọc được
    }




    // save Task
    public function save()
    {
        $task = $this->Tasks->newEntity(); 
        $arrReturn = array();
        $test = array();
        $test = $this->request->data;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        if ($this->request->is('post')) { 
        // Validate bằng PHP trên server
            $error = $this->validate($this->request->data); // kết quả trả về của hàm validate
            if ($error != ""){
                $arrReturn = array("status" => false, "msg" => $error);
            }
            else{
                    // Kiểm tra trùng redmine_id nếu Add new task
                        $error1 = $this->Tasks->find('all')->where(['redmine_id'=> $test['redmine_id'], 'id !=' => $test['id']])->toArray();
                        if (empty($error1)){
                            $id = $this->request->data['id'];
                           if ($id == 0) {
                                $date_now = date("Y/m/d H:i:s");
                                $task->created = $date_now;
                                $task->modified = $date_now;
                            }else{
                                $date_now = date("Y/m/d H:i:s");
                                $task->modified = $date_now;
                            }
                                $task = $this->Tasks->patchEntity($task, $this->request->data); 
                                if ($this->Tasks->save($task)) {
                                    $arrReturn = array("status" => true, "msg" => __("The task has been saved"));
                                } else {
                                    $arrReturn = array("status" => false, "msg" => __("The task could not be saved. Please, try again."));
                                    }
                        }else {
                                $arrReturn = array("status"=>false, "msg"=>__("<strong>Task</strong> đã tồn tại"));
                            }
                }
        }
        echo json_encode($arrReturn); 
        die; //đổi kiểu mảng sang chuỗi json. JSON là chữ viết tắt của Javascript Object Notation, đây là một dạng dữ liệu tuân theo một quy luật nhất định mà hầu hết các ngôn ngữ lập trình hiện nay đều có thể đọc được
    }

    // xóa task
    public function delete()
    {
        $this->loadModel('Functionchanges');
        $this->loadModel('Processsteps');
        $this->loadModel('Databasechanges');
        $id = $this->request->data['id'];
        $task = $this->Tasks->get($id);
        if ($this->Tasks->delete($task)) {
            $arrReturn = array("status" => true, "msg" => __("The task has been deleted"));
            $this->Functionchanges->deleteAll(['task_id' => $id]);
            $this->Processsteps->deleteAll(['task_id' => $id]);
            $this->Databasechanges->deleteAll(['task_id' => $id]);
        } else {
            $arrReturn = array("status" => false, "msg" => __("The task could not be deleted. Please, try again."));
        }
        echo json_encode($arrReturn); 
        die;
    }

    // xóa function change
    public function deleteFunc()
    {
        $this->loadModel('Functionchanges');
        $id = $this->request->data['id'];
        $func = $this->Functionchanges->get($id);
        if ($this->Functionchanges->delete($func)) {
            $arrReturn = array("status" => true, "msg" => __("The Function has been deleted"));
        } else {
            $arrReturn = array("status" => false, "msg" => __("The Function could not be deleted. Please, try again."));
        }
        echo json_encode($arrReturn); 
        die;
    }

    // xóa Process step
    public function deleteStep()
    {
        $this->loadModel('Processsteps');
        $id = $this->request->data['id'];
        $step = $this->Processsteps->get($id);
        if ($this->Processsteps->delete($step)) {
            $arrReturn = array("status" => true, "msg" => __("The Process step has been deleted"));
        } else {
            $arrReturn = array("status" => false, "msg" => __("The Process step could not be deleted. Please, try again."));
        }
        echo json_encode($arrReturn); 
        die;
    }


    // xóa Database
    public function deleteDatabase()
    {
        $this->loadModel('Databasechanges');
        $id = $this->request->data['id'];
        $database = $this->Databasechanges->get($id);
        if ($this->Databasechanges->delete($database)) {
            $arrReturn = array("status" => true, "msg" => __("The database has been deleted"));
        } else {
            $arrReturn = array("status" => false, "msg" => __("The database could not be deleted. Please, try again."));
        }
        echo json_encode($arrReturn); 
        die;
    }

    // validate task
    public function validate($data)
    {
        $msg = "";
        if(empty($data["redmine_id"])){
            $msg .='<em>Vui lòng không để trống </em><strong>Redmine_id</strong> </em> </br>';
        }else if(!preg_match("/^[0-9]+$/", $data["redmine_id"])){
                 $msg .= "<strong>Redmine_id</strong> <em>chỉ bao gồm số </em></br>";
             }

        if(empty($data["title"])){
            $msg .='<em>Vui lòng không để trống </em><strong>Title </strong>  </br>';
        }

        if(empty($data["task_goal"])){
            $msg .='<em>Vui lòng không để trống  </em><strong>task_goal</strong> </br>';
        }

        if($data["assigned"] == 0){
            $msg .='<em>Vui lòng chọn  </em><strong>Assigned</strong>  </br>';
        }

        if($data["member_review"] == 0){
            $msg .='<em>Vui lòng chọn  </em><strong>Member review</strong>  </br>';
        }

        if($data["project_id"] == 0){
            $msg .='<em>Vui lòng chọn  </em><strong>Project id</strong>  </br>';
        }
        return $msg;
    }

    // validate function change
    public function validate_func($data)
    {
        $msg = "";
        if(empty($data["func"])){
            $msg .='<em>Vui lòng không để trống </em><strong>Func</strong> </em> </br>';
        }

        if(empty($data["description"])){
            $msg .='<em>Vui lòng không để trống </em><strong>Description </strong>  </br>';
        }

        if($data["change_type"] == 0){
            $msg .='<em>Vui lòng chọn  </em><strong>Change type</strong>  </br>';
        }

        return $msg;
    }

    // validate process step
    public function validate_step($data)
    {
        $msg = "";
        if(empty($data["title"])){
            $msg .='<em>Vui lòng không để trống </em><strong>Title</strong> </em> </br>';
        }

        if(empty($data["change_files"])){
            $msg .='<em>Vui lòng không để trống </em><strong>Change_files</strong> </em> </br>';
        }

        if(empty($data["description"])){
            $msg .='<em>Vui lòng không để trống </em><strong>Description </strong>  </br>';
        }

        if($data["status"] == 0){
            $msg .='<em>Vui lòng chọn  </em><strong>Status/strong>  </br>';
        }

        if($data["editor"] == 0){
            $msg .='<em>Vui lòng chọn  </em><strong>Editor/strong>  </br>';
        }
        return $msg;
    }


    // validate Database
    public function validate_data($data)
    {
        $msg = "";
        if(empty($data["table_name"])){
            $msg .='<em>Vui lòng không để trống </em><strong>Table name</strong> </em> </br>';
        }

        if($data["change_type"] == 0){
            $msg .='<em>Vui lòng chọn  </em><strong>Change type</strong>  </br>';
        }

        if(empty($data["description"])){
            $msg .='<em>Vui lòng không để trống </em><strong>Description </strong>  </br>';
        }

        if(empty($data["queries"])){
            $msg .='<em>Vui lòng không để trống </em><strong>Queries</strong> </em> </br>';
        }

        if($data["optimized"] == 0){
            $msg .='<em>Vui lòng chọn  </em><strong>Optimized/strong>  </br>';
        }

        if(empty($data["note"])){
            $msg .='<em>Vui lòng không để trống </em><strong>Note</strong> </em> </br>';
        }
        return $msg;
    }

}



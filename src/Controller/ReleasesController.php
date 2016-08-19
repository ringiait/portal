<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\ORM\TableRegistry;
use Cake\Config\AppConst;
use Cake\Controller\Component\FlashComponent;

class ReleasesController extends AppController
{
    public function index()
    {
        $this->loadModel('Users');// get data user
        $users = $this->Users->find()->toArray();
        $this->set(compact('users'));
        $ele_release = $this->paginate('rpt_releases');
        $this->set(compact('ele_release')); 
        $statusTest = Configure::read('statusTest');
        $this->set(compact('statusTest'));
    }

    public $paginate = array(
        'limit' => 5,
        'order'=>['id'=>'desc']
    );

    public function details($id = null)
    {
        $Users = TableRegistry::get('Users');
        $Tasks = TableRegistry::get('Tasks');
        $Release_Database = TableRegistry::get('ReleaseDatabase');
        $ele_release = $this->Releases->get($id);
        $db = Configure::read('db_change_and_backup');
        $this->set(compact('db'));
        $this->set(compact('ele_release'));
        //data task selection
        $query_tmp = $Tasks->find('all')
        ->hydrate(false)
        ->join([
            'm' => [
                'table' => 'rpt_member',
                'type' => 'INNER',
                'conditions' => 'm.id = Tasks.assigned',
            ]
        ])
        ->select(['Tasks.id','Tasks.redmine_id', 'Tasks.title','m.full_name']);
        $this->set('data',$query_tmp);
        $query = $Tasks->find('all')
        ->hydrate(false)
        ->join([
            'r' => [
                'table' => 'rpt_release_task',
                'type' => 'INNER',
                'conditions' => 'r.task_id = Tasks.id',
            ],
            'm' => [
                'table' => 'rpt_member',
                'type' => 'INNER',
                'conditions' => 'm.id = Tasks.assigned',
            ]
        ])
        ->select(['Tasks.redmine_id', 'Tasks.title','m.full_name','r.id'])
        ->order(['r.id'=>'desc'])
        ->where(['r.release_id' => $id]);   
        $this->set('tmp',$query);
        $status = Configure::read('statusTest');
        $this->set('status',$status);
        $state = Configure::read('state');
        $this->set('state',$state);
        $query_file = $this->Releases->find('all')
        ->hydrate(false)
        ->join([
            'f' => [
                'table' => 'rpt_release_files',
                'type' => 'INNER',
                'conditions' => ' f.release_id = Releases.id',
            ],
            'm' => [
                'table' => 'rpt_member',
                'type' => 'INNER',
                'conditions' => 'm.id = f.coder',
            ]
        ])
        ->select(['Releases.id','f.id','f.file_path','f.state','f.coder', 'm.full_name'])
        ->order(['f.id'=>'desc'])
        ->where(['f.release_id' => $id]); 
        $this->set('data_file',$query_file);
        $users = $Users->find()->toArray();
        $this->set('users',$users);
        $query_database = $this->Releases->find('all')
        ->hydrate(false)
        ->join([
            'd' => [
                'table' => 'rpt_release_database',
                'type' => 'INNER',
                'conditions' => ' d.release_id = Releases.id'
            ]
        ])
        ->select(['Releases.id','d.id','d.editor','d.query_db', 'd.table_db','d.status'])
        ->order(['d.id'=>'desc'])
        ->where(['d.release_id' => $id]);
        $this->set('database_data',$query_database);
        $Status_DB = Configure::read('Status_Change_Database');
        $Type_Database = Configure::read('Type_Change_Database');
        $this->set(compact('Status_DB','Type_Database'));
        $query_expected = $this->Releases->find('all')
        ->hydrate(false)
        ->join([
            'e' => [
                'table' => 'rpt_release_expected',
                'type' => 'INNER',
                'conditions' => ' e.release_id = Releases.id'
            ],
            'm' => [
                'table' => 'rpt_member',
                'type' => 'LEFT',
                'conditions' => 'm.id = e.assignee',
            ],
            'tmp' => [
                'table' => 'rpt_member',
                'type' => 'LEFT',
                'conditions' => 'tmp.id = e.review',
            ],
        ])
        ->select(['Releases.id','e.id','e.time','e.action','tmp.full_name','m.full_name','e.assignee','e.status','e.review','e.note'])
        ->order(['e.id'=>'desc'])
        ->where(['e.release_id' => $id]);
        $this->set('query_expected',$query_expected);
        $status_process = Configure::read('status_process');
        $this->set(compact('status_process'));
    }

    public function addRelease()
    {   
        $arrayData = array();
        $arrReturn = array();
        $arrayData = $this->request->data;
        $test = $this->validate($arrayData);
         $query =  $this->Releases->find('all')->where(['redmine_id' => trim($arrayData['redmine_id']),'id !=' => $arrayData['id']])->toArray();
        if ($test != ""){
            $arrReturn = array("status" => false, "text" => $test);
        }
        if(!empty($query)){
            $arrReturn = array("status" => false, "msg" => "Your Release Are Duplicate . Please, Try Again.");
        } else {
            $release = $this->Releases->newEntity();
            $id = $this->request->data['id'];
            if ($id == 0){
                $date_now = date("Y-m-d H:i:s");
                $release->created = $date_now;
                $release->modified = $date_now;
            } else {
                $date_now = date("Y-m-d H:i:s");
                $release->modified = $date_now;
            }
            if ($this->request->is('post')){
                $release = $this->Releases->patchEntity($release, $arrayData);
                if ($this->Releases->save($release)){
                    $arrReturn = array( "status"=>true,"msg" => "Your Release has been saved"); 
                }
                else{
                    $arrReturn = array("status" => false, "msg" => "Your Release could not be saved. Please, try again.");
                            }
                }
        }
        echo json_encode($arrReturn);
        exit;
    }

    public function addReleaseTask()
    {
        $this->loadModel('ReleaseTask');
        $arrayData = array();
        $arrReturn = array();
        $arrayData = $this->request->data;
        $query =  $this->ReleaseTask->find('all')->where(['release_id'=> $arrayData['release_id'],'task_id' => $arrayData['task_id']])->toArray();
        if(!empty($query)){
             $arrReturn = array("status" => false, "msg" => "Your Task Are Duplicate . Please, Try Again.");
        } else {
            $task = $this->ReleaseTask->newEntity();
            $date_now = date("Y-m-d H:i:s");
            $task->created = $date_now;
            $task->modified = $date_now;
            if ($this->request->is('post')){
                $task = $this->ReleaseTask->patchEntity($task,$this->request->data);
                if ($this->ReleaseTask->save($task)){
                    $arr = $arrReturn = array( "status"=>true,"msg" => "Your Task has been saved"); 
                } else {
                        $arrReturn = array("status" => false, "msg" => "Your Task could not be saved. Please, try again.");
                }
            }
        }
        echo json_encode($arrReturn);
        exit;
    }

    public function addReleaseFile()
    {
        $this->loadModel('ReleaseFiles');
        $arrayData = array();
        $arrReturn = array();
        $arrayData = $this->request->data;
        $test = $this->validate_file($arrayData);
         $query =  $this->ReleaseFiles->find('all')->where(['release_id'=> $arrayData['release_id'],'file_path' => trim($arrayData['file_path']),'coder' => $arrayData['coder'],'id !=' => $arrayData['id']])->toArray();
        if ($test != ""){
            $arrReturn = array("status" => false, "text" => $test);
        }
        if(!empty($query)){
            $arrReturn = array("status" => false, "msg" => "Your File_Path Are Duplicate . Please, Try Again.");
        } else {
            $file = $this->ReleaseFiles->newEntity();
            $id = $this->request->data['id'];
            if ($id == 0){
                $date_now = date("Y-m-d H:i:s");
                $file->created = $date_now;
                $file->modified = $date_now;
            }else{
                $date_now = date("Y-m-d H:i:s");
                $file->modified = $date_now;
            }
            if ($this->request->is('post')){
                $file = $this->ReleaseFiles->patchEntity($file, $arrayData);
                if ($this->ReleaseFiles->save($file)){
                    $arrReturn = array( "status"=>true,"msg" => "Your File has been saved"); 
                } else {
                    $arrReturn = array("status" => false, "msg" => "Your File_Path could not be saved. Please, try again.");
                            }
                }
        }
        echo json_encode($arrReturn);
        exit;
    }

    public function addReleaseDB()
    {
        $this->loadModel('ReleaseDatabase');
        $arrayData = array();
        $arrReturn = array();
        $arrayData = $this->request->data;
        $test = $this->validate_db($arrayData);
        $query =  $this->ReleaseDatabase->find('all')->where(['release_id'=> $arrayData['release_id'],'query_db' => trim($arrayData['query_db']),'table_db' => trim($arrayData['table_db']),'id !=' => $arrayData['id']])->toArray();
        if ($test != ""){
             $arrReturn = array("status" => false, "text" => $test);
        }
        if(!empty($query)){
            $arrReturn = array("status" => false, "msg" => "Your option Are Duplicate . Please, Try Again.");
        } else {
            $db = $this->ReleaseDatabase->newEntity();
            $id = $this->request->data['id'];
            if ($id == 0){
                $date_now = date("Y-m-d H:i:s");
                $db->created = $date_now;
                $db->modified = $date_now;
            } else {
                $date_now = date("Y-m-d H:i:s");
                $db->modified = $date_now;
            }
            if ($this->request->is('post')){
                $db = $this->ReleaseDatabase->patchEntity($db, $arrayData);
                if($this->ReleaseDatabase->save($db)){
                    $arrReturn = array( "status"=>true,"msg" => "Your option has been saved"); 
                }
                else{
                    $arrReturn = array("status" => false, "msg" => "Your option could not be saved. Please, try again.");
                }   
             }
        }
        echo json_encode($arrReturn);
        exit;
    }

    public function addReleaseExpected()
    {
        $this->loadModel('ReleasesExpected');
        $arrayData = array();
        $arrReturn = array();
        $arrayData = $this->request->data;
        $test = $this->validate_expected($arrayData);
        if ($test != ""){
             $arrReturn = array("status" => false, "text" => $test);
        } else {
            $ex = $this->ReleasesExpected->newEntity();
            $id = $this->request->data['id'];
            if ($id == 0){
                $date_now = date("Y-m-d H:i:s");
                $ex->created = $date_now;
                $ex->modified = $date_now;
            }else{
                $date_now = date("Y-m-d H:i:s");
                $ex->modified = $date_now;
            }
            if ($this->request->is('post')){
                $ex = $this->ReleasesExpected->patchEntity($ex, $arrayData);
                if($this->ReleasesExpected->save($ex)){
                    $arrReturn = array( "status"=>true,"msg" => "Your option has been saved"); 
                }
                else{
                    $arrReturn = array("status" => false, "msg" => "Your option could not be saved. Please, try again.");
                }   
             }
        }
        echo json_encode($arrReturn);
        exit;
    }

    public function DeleteReleaseDB(){
        $this->loadModel('ReleaseDatabase');
        $id = $this->request->data['id'];
        $db = $this->ReleaseDatabase->get($id);
        if ($this->ReleaseDatabase->delete($db)) {
            $arrReturn = array("status" => true, "msg" => "Your Option has been deleted");
        } else {
            $arrReturn = array("status" => false, "msg" => "Your Option could not be deleted. Please, try again.");
        }
        echo json_encode($arrReturn); 
        exit;

    }

    public function DeleteReleaseExpected(){
        $this->loadModel('ReleasesExpected');
        $id = $this->request->data['id'];
        $ex = $this->ReleasesExpected->get($id);
        if ($this->ReleasesExpected->delete($ex)) {
            $arrReturn = array("status" => true, "msg" => "Your Option has been deleted");
        } else {
            $arrReturn = array("status" => false, "msg" => "Your Option could not be deleted. Please, try again.");
        }
        echo json_encode($arrReturn); 
        exit;

    }

    public function deleteReleaseTask()
    {
        $this->loadModel('ReleaseTask');
        $id = $this->request->data['id'];
        $task = $this->ReleaseTask->get($id);
        if ($this->ReleaseTask->delete($task)) {
            $arrReturn = array("status" => true, "msg" => "Your Task has been deleted");
        } else {
            $arrReturn = array("status" => false, "msg" => "Your Task could not be deleted. Please, try again.");
        }
        echo json_encode($arrReturn); 
        exit;
    }

    public function DeleteReleaseFile()
    {
        $this->loadModel('ReleaseFiles');
        $id = $this->request->data['id'];
        $file = $this->ReleaseFiles->get($id);
        if ($this->ReleaseFiles->delete($file)) {
            $arrReturn = array("status" => true, "msg" => "Your Task has been deleted");
        } else {
            $arrReturn = array("status" => false, "msg" => "Your Task could not be deleted. Please, try again.");
        }
        echo json_encode($arrReturn); 
        exit;
    }

    public function deleteRelease()
    {
        $this->loadModel('ReleaseTask');
        $this->loadModel('ReleaseFiles');
        $this->loadModel('ReleaseDatabase');
        $this->loadModel('ReleasesExpected');
        $this->loadModel('Releases');
        $id = $this->request->data['id'];
        $release_del =  $this->Releases->get($id);
        $query_del_task = $this->ReleaseTask->find('all')->where(['release_id'=> $id])->toArray();
        $query_del_file = $this->ReleaseFiles->find('all')->where(['release_id'=> $id])->toArray();
        $query_del_db =$this->ReleaseDatabase->find('all')->where(['release_id'=> $id])->toArray();
        $query_del_expected = $this->ReleasesExpected->find('all')->where(['release_id'=> $id])->toArray();
        $arrayQuery = array($query_del_task, $query_del_file, $query_del_db , $query_del_expected);
        $arrayName = array('ReleaseTask','ReleaseFiles','ReleaseDatabase','ReleasesExpected');
        $arrQueryLength = count($arrayQuery);
        if($this->Releases->delete($release_del))
        {
            for($i = 0; $i < $arrQueryLength; $i++)
            {
                if(!empty($arrayQuery[$i]))
                {
                    $this->$arrayName[$i]->deleteAll(['release_id' => $id]);
                }
                else{break;}
            }

            $arrReturn = array("status" => true, "msg" => "Your Task has been deleted");
        } else {

             $arrReturn = array("status" => false, "msg" => "Your Task could not be deleted. Please, try again.");
        }
       
        echo json_encode($arrReturn); 
        exit;
    }

    public function validate($data)
    {
        $msg = "";
        if(!preg_match("/^[0-9]{1,10}+$/i", $data["redmine_id"])){
            $msg .=' redmine_id must be Number between 1 and 10. ';
        }
        if(strlen($data["release_date"]) == 0){ 
            $msg .='You must add data in Releases date.>';
        }
        if(strlen($data["title_release"]) < 1 || strlen($data["redmine_id"]) > 500){
            $msg .='Length of title_release must be between 1 and 500.';
        }
        return $msg;
    }

    public function validate_file($data)
    {
        $msg = "";
        if(!preg_match("/^[a-zA-Z0-9-._:\/\\\]{1,255}+$/i", $data["file_path"])){
            $msg= "File Path Not Valid";
        }
        return $msg;
    }

    public function validate_db($data)
    {
        $msg = "";
        if(strlen($data["table_db"]) < 1 || strlen($data["table_db"]) > 50){
            $msg .='Length of Table Name must be between 1 and 50.';
        }
        if(strlen($data["query_db"]) == 0){
            $msg .='You must add data in Query';
        }
        return $msg;
    }

    public function validate_expected($data)
    {
        $msg = "";
        if(strlen($data["action"]) < 1 || strlen($data["action"]) > 255){
            $msg .='Length of Table Name must be between 1 and 255. ';
        }
        if(strlen($data["time"]) == 0){
            $msg .='You must add data in Time Field ';
        } 
        return $msg;
    }
}
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
use Cake\I18n\Time;
/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class ReleasesController extends AppController
{
    public $helpers = [
        'Form' => [
            'className' => 'Bootstrap3.BootstrapForm',
            'useCustomFileInput' => true
        ]
    ];

    /**
     * Fucntion to display form to add new task
     * Author    :    Hoaila
     * Date        :    15/07/2015
     * @return void
     *
     */
    public function add($id = 0)
    {
        $this->loadModel('Tasks');
        $this->loadModel('ReleaseTask');
        $this->loadModel('Users');
        $dataReleaseTask = $arrTaskId = array();
        if ($id != 0) {
            $title = 'Edit Release';
            $dataReleaseTask = $this->ReleaseTask->find()->where(array("release_id" => $id))->toArray();
            if (! empty($dataReleaseTask)) {
                foreach ($dataReleaseTask as $k => $vReleaseTask) {
                    $arrTaskId[] = $vReleaseTask->task_id;
                }
            }
        } else {
            $title = 'Add Release';
        }

        $arrUser = $this->Users->find()->toArray();

        $arrUserId = array();
        if (! empty($arrUser)) {
            foreach ($arrUser as $key => $value) {
                $arrUserId[$value['id']] = $value['full_name'];
            }
        }

        $arrDataRelease = $this->Releases->find()->where(array("id" => $id))->toArray();
        $arrReleaseTask = $this->Tasks->find()->toArray();
        $statusRelease = Configure::read('statusRelease');
        $statusChecklist = Configure::read('statusChecklist');
        $statusProcessRelease = Configure::read('statusProcessRelease');
        $this->set(compact('title', 'statusRelease', 'statusChecklist', 'id', 'arrDataRelease', 'arrReleaseTask', 'arrTaskId', 'statusProcessRelease', 'arrUserId'));
    }

    public function index()
    {
        $title = 'List Release';
        //$arrDataRelease = $this->Releases->find()->order(['created' => 'DESC'])->toArray();
        $this->paginate = [
            // Other keys here.
            'maxLimit' => 10
        ];
        $arrDataRelease = $this->paginate($this->Releases->find()->order(['created' => 'DESC']));
        $statusRelease = Configure::read('statusRelease');
        $statusChecklist = Configure::read('statusChecklist');
        $statusProcessRelease = Configure::read('statusProcessRelease');
        $this->set(compact('arrDataRelease', 'statusRelease', 'statusChecklist', 'statusProcessRelease'));
    }

    public function detail($id)
    {
        $this->loadModel('Users');
        $title = 'Detail Release ' . $id;
        $arrUser = $this->Users->find()->toArray();

        $arrUserId = array();
        if (! empty($arrUser)) {
            foreach ($arrUser as $key => $value) {
                $arrUserId[$value['id']] = $value['full_name'];
            }
        }

        $arrDataRelease = $this->Releases->find()->contain(['ReleaseTask', 'ReleaseProcess'])->where(array("id" => $id))->toArray();
        $statusRelease = Configure::read('statusRelease');
        $statusChecklist = Configure::read('statusChecklist');
        $statusProcessRelease = Configure::read('statusProcessRelease');
        $this->set(compact('title', 'statusRelease', 'statusChecklist', 'id', 'arrDataRelease', 'arrReleaseTask', 'arrTaskId', 'statusProcessRelease', 'arrUserId'));
    }
	
    /**
     * Function to save release to data base
     * Author	: 	VanNH
	 * Date		: 	15/07/2015
     *
     * @return redirect back.
     * @throws Exception Database.
     */
	function saveRelease()
    {
        $release = $this->Releases->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['release_date'] = (isset($this->request->data['release_date']) && $this->request->data['release_date'] != '') ? new Time($this->request->data['release_date']) : "";
            if (isset($this->request->data['id']) && $this->request->data['id'] != '') {
                $urlError = '/releases/add/' . $this->request->data['id'] . '?item_menu=6';
                $this->request->data['modified'] = new Time(Date("Y-m-d H:i:s", time()));
            } else {
                $urlError = '/releases/add?item_menu=6';
                $this->request->data['created'] = new Time(Date("Y-m-d H:i:s", time()));
            }
            $release = $this->Releases->patchEntity($release, $this->request->data, ['validate' => 'update']);
            if ($release->errors()) {
                $this->Flash->error($release->errors(), [
                    'key' => 'positive'
                ]);
                return $this->redirect($urlError);
            }
            $listTask = $this->request->data['listTask'];
            $listTask = explode(",", $listTask);
            $result = $this->Releases->save($release);
            $oldTaskRealse = explode(",", $this->request->data['oldTaskRelease']);
            if ($result->id) {
                // Save Release Task
                $this->loadModel('ReleaseTask');
                $arrIdDelete = $arrIdAdd = array();

                if (! empty($listTask)) {
                    foreach ($listTask as $k => $vTaskId) {
                        if(! in_array($vTaskId, $oldTaskRealse)) {
                            $arrIdAdd[] = $vTaskId;
                        }
                    }
                }

                if (! empty($oldTaskRealse)) {
                    foreach ($oldTaskRealse as $k => $vTaskOld) {
                        if(! in_array($vTaskOld, $listTask)) {
                            $arrIdDelete[] = $vTaskOld;
                        }
                    }
                }

                if (! empty($arrIdAdd)) {
                    $arrDataUpdate = array();
                    $oReleaseTask = TableRegistry::get('ReleaseTask');
                    $oQuery = $oReleaseTask->query();
                    foreach($arrIdAdd as $k => $taskID) {
                        $oQuery->insert(['redmine_id','release_id','task_id','created'])
                            ->values(array(
                                'redmine_id' => $this->request->data['redmine_id'],
                                'release_id' => $result->id,
                                'task_id'   => $taskID,
                                'created'   => date("Y-m-d H:i:s", time())
                            ));
                    }
                    $oQuery->execute();
                }

                if (! empty($arrIdDelete)) {
                    $this->ReleaseTask->deleteAll(['release_id' => $this->request->data['id'], 'task_id in' => $arrIdDelete]);
                }

                $this->Flash->success('The release has been saved.', [
                    'key' => 'positive'
                ]);
            } else {
                $this->Flash->error('The release cannot be saved.', [
                    'key' => 'positive'
                ]);
            }
        }
		return $this->redirect('/releases/index');
	}

    /**
     * Fucntion delete release process from database
     * Author	: 	VanNH
     * Date		: 	13/08/2015
     * @return void
     *
     */
    public function deleteRelease($id)
    {
        $this->loadModel('Releases');
        $release = $this->Releases->get($id);
        if ($this->Releases->delete($release)) {
            $this->Flash->success('The release has been deleted', [
                'key' => 'positive'
            ]);
            $arrReturn = array("status" => true, "msg" => __("The release has been deleted"));
        } else {
            $this->Flash->error('The release could not be deleted. Please, try again.', [
                'key' => 'positive'
            ]);
        }
        return $this->redirect('/releases/index');
    }

    /**
     * Fucntion save release process to database
     * Author	: 	VanNH
     * Date		: 	13/08/2015
     * @return void
     *
     */
    public function saveProcess()
    {
        $this->loadModel('ReleaseProcess');
        $arrReturn = array();
        if ($this->request->is('post')) {
            $releaseProcess = $this->ReleaseProcess->newEntity();
            $this->request->data['time'] = new Time($this->request->data['time']);
            if (isset($this->request->data['id']) && $this->request->data['id'] == 0) {
                $this->request->data['created'] = new Time(Date("Y-m-d H:i:s", time()));
            } else {
                $this->request->data['modified'] = new Time(Date("Y-m-d H:i:s", time()));
            }
            $releaseProcess = $this->ReleaseProcess->patchEntity($releaseProcess, $this->request->data);


            if ($this->ReleaseProcess->save($releaseProcess)) {
                $arrReturn = array("status" => true, "msg" => __("The release process has been saved"));
            } else {
                $arrReturn = array("status" => false, "msg" => __("The release process could not be saved. Please, try again."));
            }
        }
        echo json_encode($arrReturn); die;
    }

    /**
     * Fucntion delete release process from database
     * Author	: 	VanNH
     * Date		: 	13/08/2015
     * @return void
     *
     */
    public function deleteProcess()
    {
        $this->loadModel('ReleaseProcess');
        $id = $this->request->data['id'];
        $releaseProcess = $this->ReleaseProcess->get($id);
        if ($this->ReleaseProcess->delete($releaseProcess)) {
            $arrReturn = array("status" => true, "msg" => __("The release process has been deleted"));
        } else {
            $arrReturn = array("status" => false, "msg" => __("The release process could not be deleted. Please, try again."));
        }
        echo json_encode($arrReturn); die;
    }
}

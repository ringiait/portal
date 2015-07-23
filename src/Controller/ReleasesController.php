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

        $arrDataRelease = $this->Releases->find()->where(array("id" => $id))->toArray();
        $arrReleaseTask = $this->Tasks->find()->toArray();
        $statusRelease = Configure::read('statusRelease');
        $statusChecklist = Configure::read('statusChecklist');
        $this->set(compact('title', 'statusRelease', 'statusChecklist', 'id', 'arrDataRelease', 'arrReleaseTask', 'arrTaskId'));
    }

    public function index()
    {
        $title = 'List Release';
        $arrDataRelease = $this->Releases->find()->toArray();
        $this->set(compact('arrDataRelease'));
    }
	
    /**
     * Function to save task to data base
     * Author	: 	Hoaila
	 * Date		: 	15/07/2015
     *
     * @return redirect back.
     * @throws Exception Database.
     */
	function saveRelease()
    {
        $release = $this->Releases->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['release_date'] = new Time($this->request->data['release_date']);
            $this->request->data['created'] = new Time(Date("Y-m-d H:i:s", time()));
            $release = $this->Releases->patchEntity($release, $this->request->data);
            $listTask = $this->request->data['listTask'];
            $listTask = explode(",", $listTask);
            $result = $this->Releases->save($release);
            $oldTaskRealse = explode(",", $this->request->data['oldTaskRelease']);
            if ($result->id) {
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
                    $this->ReleaseTask->deleteAll(['release_id' => $this->request->data['id'], 'redmine_id' => $arrIdDelete]);
                }
                $this->Flash->set('The task has been saved.', [
                    'element' => 'success'
                ]);
            } else {
                $this->Flash->set('The task cannot be saved.', [
                    'element' => 'error'
                ]);
            }
        }
		return $this->redirect('/releases/index');
	}
}

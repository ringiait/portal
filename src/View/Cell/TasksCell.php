<?php
/**
 * Make a cell to show menu on top all page.
 *
 * This cell will render views from Template/Pages/Cell/Menu
 *
 * Author:		Hoaila
 * Date:		16-07-2015
 */
 
namespace App\View\Cell;

use Cake\View\Cell;

class TasksCell extends Cell
{
	
	/**
	* Fucntion to display cell content
	*
	* This cell will render views from Template/Pages/Cell/Menu/display.ctp
	*
	* Author:		Hoaila
	* Date:		16-07-2015
	*/
 
	public function display()
    {
		$this->loadModel('Tasks');
		$task_list = $this->Tasks->find()->contain(['Users', 'UsersReview','Projects'])->toArray();
		
		$tasks = array() ;
		
		if(!empty($task_list)){
			foreach ($task_list as $tmpTask){
				$tmp['id'] = $tmpTask->id;
				$tmp['redmine_id'] = $tmpTask->redmine_id;
				$tmp['assigned'] = $tmpTask->user->full_name;
				$tmp['title'] = $tmpTask->title;
				$tmp['member_review'] = $tmpTask->users_review->full_name;
				$tmp['project'] = $tmpTask->project->name;
				$tmp['modified'] = $tmpTask->modified;
				$tasks[] = $tmp;
			}
		}
		
        $this->set('tasks', $tasks);
    }

}
?>
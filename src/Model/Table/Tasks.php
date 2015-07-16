<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class TasksTable extends Table
{
    /**
     * Function to save task to data base
     * Author	: 	Hoaila
	 * Date		: 	15/07/2015
     *
     * @return boolean
     * @throws Exception Database.
     */
	 function saveTask($data){
		$dataSource = $this->getDataSource();	
		$dataSource->begin();
		
		$condition = ($data['id']) ? array('id'=>$data['id']) : array();
		
		$res = $this->updateAll($taskArr, $condition);
		if ($res) {
			$dataSource->commit();
			return true;
		} else {
			$dataSource->rollback();
			return false;
		}
	}
}

?>
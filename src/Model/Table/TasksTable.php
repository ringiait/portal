<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class TasksTable extends Table
{
    
    public function initialize(array $config)
    {
        $this->table('rpt_tasks');
    }
    
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
		
		$condition = ($data['id']) ? array('id'=> $data['id']) : array();
		
		$result = $this->updateAll($taskArr, $condition);
		if ($result) {
			$dataSource->commit();
			return true;
		} else {
			$dataSource->rollback();
			return false;
		}
	}
}

?>
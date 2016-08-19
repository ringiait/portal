<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class TasksTable extends Table
{
    public function initialize(array $config)
    {
        $this->table('rpt_tasks');
    }
}

?>
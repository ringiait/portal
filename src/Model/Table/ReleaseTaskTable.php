<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class ReleaseTaskTable extends Table
{
    public function initialize(array $config)
    {
        $this->table('rpt_release_task');
    }
}

?>
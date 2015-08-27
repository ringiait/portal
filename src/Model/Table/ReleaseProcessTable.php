<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class ReleaseProcessTable extends Table
{
    public function initialize(array $config)
    {
        $this->table('rpt_release_processes');
    }
}

?>
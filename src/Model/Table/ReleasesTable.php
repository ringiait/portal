<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class ReleasesTable extends Table
{
    public function initialize(array $config)
    {
        $this->table('rpt_releases');
    }
}

?>
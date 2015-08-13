<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class ReleasesTable extends Table
{
    public function initialize(array $config)
    {
        $this->table('rpt_releases');
        $this->hasMany('ReleaseTask', [
            'className' => 'ReleaseTask',
            'foreignKey' => 'release_id',
            'dependent' => false
        ]);
        $this->hasMany('ReleaseProcess', [
            'className' => 'ReleaseProcess',
            'foreignKey' => 'release_id',
            'dependent' => false
        ]);
    }
}

?>
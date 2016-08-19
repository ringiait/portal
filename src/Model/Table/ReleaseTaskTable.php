<?php
namespace App\Model\Table;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
class ReleaseTaskTable extends Table
{
    public function initialize(array $config)
    {
        $this->table('rpt_release_task');
    }
}

?>
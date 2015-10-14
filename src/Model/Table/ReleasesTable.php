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
            'dependent' => true
        ]);
        $this->hasMany('ReleaseProcess', [
            'className' => 'ReleaseProcess',
            'foreignKey' => 'release_id',
            'dependent' => true
        ]);
    }

    public function validationUpdate($validator)
    {
        $validator
            ->add('redmine_id', 'notBlank', [
                'rule' => 'notBlank',
                'message' => __('Redmine id is required'),
            ])
            ->add('redmine_id', [
                'valid' => ['rule' => 'numeric', 'message' => 'is number']
            ])
            ->add('redmine_id', [
                'valid' => ['rule' => 'validateUnique', 'provider' => 'table']
            ])
            ->add('release_date', 'notBlank', [
                'rule' => 'notBlank',
                'message' => __('Realease date is required')
            ]);
        return $validator;
    }

}

?>
<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class LinksTable extends Table
{
	
	public function initialize(array $config)
    {
		$this->belongsTo('LinkType', [
            'className' => 'LinkType',
            'foreignKey' => 'link_type_id',
            'dependent' => true
        ]);
		
        $this->table('rpt_links');
    }
}

?>
<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class LinkTypeTable extends Table
{
	
	public function initialize(array $config)
    {
        $this->table('rpt_link_types');
    }
   
}

?>
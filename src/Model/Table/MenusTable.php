<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class MenusTable extends Table
{
   public function initialize(array $config)
    {
        $this->table('rpt_menus');
    }
   
}

?>
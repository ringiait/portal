<?php
/**
 * Make a cell to show menu on top all page.
 *
 * This cell will render views from Template/Pages/Cell/Menu
 *
 * Author:		Hoaila
 * Date:		16-07-2015
 */
 
namespace App\View\Cell;

use Cake\View\Cell;

class TasksCell extends Cell
{
	
	/**
	* Fucntion to display cell content
	*
	* This cell will render views from Template/Pages/Cell/Menu/display.ctp
	*
	* Author:		Hoaila
	* Date:		16-07-2015
	*/
 
	public function display()
    {
		$this->loadModel('Menus');
		$currMenuItem = (isset($this->request->query['item_menu'])) ? $this->request->query['item_menu'] : 1;
		//load all active menus
		$conditions = array('active' => 1);
		$fields = array('id','title');
		$menus_list = $this->Menus->find()->where($conditions)->toArray();
		
		$parents = array();
		$child = array();
		$menuArr = array();
		//Take process to parents menu array and childs array
		foreach($menus_list as $menu){
			if($menu->parent) {
				$child[$menu->parent][] = $menu->id;
			}
			else{
				if(!in_array($menu->id, $parents)) $parents[] = $menu->id;
			}
			$menuArr[$menu->id] = $menu;
		}
		$this->set('menuArr', $menuArr);
		$this->set('child', $child);
		$this->set('parents', $parents);
		$this->set('currMenuItem', $currMenuItem);
    }

}
?>
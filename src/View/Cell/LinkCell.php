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
use Cake\Core\Configure;

class LinkCell extends Cell
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
		$this->loadModel('Links');
		$links_list = $this->Links->find()->contain(['LinkType'])->toArray();
        $targetLink = Configure::read('targetLink');
        $listStyle = Configure::read('listStyle');
		
		$link_arr = array();
		$link_type_arr = array();
		
		foreach ($links_list as $link) {
			$link_arr[$link->link_type_id][] = $link;
			if (!in_array($link->link_type_id, $link_type_arr)) $link_type_arr[$link->link_type_id] =  $link->link_type->title;
		}
		
		$this->set('link_arr', $link_arr);
		$this->set('link_type_arr', $link_type_arr);
        $this->set('targetLink', $targetLink);
        $this->set('listStyle', $listStyle);
    }

}
?>
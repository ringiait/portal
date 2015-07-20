<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\ORM\TableRegistry;
/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class LinksController extends AppController
{
	public $helpers = [
		'Form' => [
			'className' => 'Bootstrap3.BootstrapForm',
			'useCustomFileInput' => true
		]
	];
    /**
     * Fucntion to save link
     * Author	: 	VanNH
	 * Date		: 	20/07/2015
     * @return void
     * 
     */
    public function save()
    {
        $link = $this->Links->newEntity();
        $arrReturn = array();
        if ($this->request->is('post')) {
            if(isset($this->request->data['title']) && $this->request->data['title'] > 0) {
                $this->request->data['modified'] = date("Y-m-d H:i:s", time());
            } else {
                $this->request->data['created'] = date("Y-m-d H:i:s", time());
            }

            $link = $this->Links->patchEntity($link, $this->request->data);

            if ($this->Links->save($link)) {
                $arrReturn = array("status" => true, "msg" => __("The link has been saved"));
            } else {
                $arrReturn = array("status" => false, "msg" => __("The link could not be saved. Please, try again."));
            }
        }
        echo json_encode($arrReturn); die;
    }

    public function delete()
    {
        $id = $this->request->data['id'];
        $link = $this->Links->get($id);
        if ($this->Links->delete($link)) {
            $arrReturn = array("status" => true, "msg" => __("The link has been deleted"));
        } else {
            $arrReturn = array("status" => false, "msg" => __("The link could not be deleted. Please, try again."));
        }
        echo json_encode($arrReturn); die;
    }

}

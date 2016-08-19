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
class UsersController extends AppController
{
	public $helpers = [
		'Form' => [
			'className' => 'Bootstrap3.BootstrapForm',
			'useCustomFileInput' => true
		]
	];
    /**
     * Fucntion to display form to add new user
     * Author	: 	VanNH
	 * Date		: 	16/07/2015
     * @return void
     * 
     */


    public function save()
    {
        $user = $this->Users->newEntity(); 
        $arrReturn = array();
        $test = array();
        $test = $this->request->data;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        if ($this->request->is('post')) { 
        // Validate bằng PHP trên server
            $error = $this->validate($this->request->data); // kết quả trả về của hàm validate
            if ($error != ""){
                $arrReturn = array("status" => false, "msg" => $error);
            }
            else{
                    // Kiểm tra trùng username nếu Add new user
                        $error_tms_username = $this->Users->find('all')->where(['tms_username'=> $test['tms_username'], 'id !='  => $test['id']])->toArray();
                        if (empty($error_tms_username))
                        {
                            // save thời gian thực
                            $id = $this->request->data['id'];
                           if ($id == 0){
                                $date_now = date("Y-m-d H:i:s");
                                $user->created = $date_now;
                                $user->modified = $date_now;
                            }else{
                                $date_now = date("Y-m-d H:i:s");
                                $user->modified = $date_now;
                            }
                            $user = $this->Users->patchEntity($user, $this->request->data); 
                            if ($this->Users->save($user)) {
                                $arrReturn = array("status" => true, "msg" => __("The user has been saved"));
                            } else {
                                $arrReturn = array("status" => false, "msg" => __("The user could not be saved. Please, try again."));
                                }
                        }else {
                                $arrReturn = array("status"=>false, "msg"=>__("<strong>Member</strong> đã tồn tại"));
                            }
                    
                }

        }
        echo json_encode($arrReturn); 
        die; //đổi kiểu mảng sang chuỗi json. JSON là chữ viết tắt của Javascript Object Notation, đây là một dạng dữ liệu tuân theo một quy luật nhất định mà hầu hết các ngôn ngữ lập trình hiện nay đều có thể đọc được
    }


    public function delete()
    {
        $id = $this->request->data['id'];
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $arrReturn = array("status" => true, "msg" => __("The user has been deleted"));
        } else {
            $arrReturn = array("status" => false, "msg" => __("The user could not be deleted. Please, try again."));
        }
        echo json_encode($arrReturn); 
        die;
    }


    public function validate($data)
    {
        $msg = "";
        if(empty($data["email"])){
            $msg .='<em>Vui lòng không để trống </em><strong>Email</strong> </em> </br>';
        }else if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $data["email"])){
                 $msg .= "<em>Vui lòng nhập đúng định dạng </em><strong>Email</strong> </br>";
             }
    

        if(empty($data["phone"])){
            $msg .='<em>Vui lòng không để trống </em><strong>Số ĐT </strong>  </br>';
        }else if(!preg_match("/^[0-9]+$/", $data["phone"])){
                 $msg .= "<strong>Số ĐT</strong> <em>chỉ bao gồm số </em></br>";
             }

        if(empty($data["tms_username"])){
            $msg .='<em>Vui lòng không để trống  </em><strong>Tms_username</strong> </br>';
        }else if(!preg_match("/^[a-zA-Z0-9]+$/", $data["tms_username"]) && !preg_match("/^[a-zA-Z]+$/", $data["tms_username"])){
                 $msg .= "<strong>Tms_username</strong> <em>chỉ bao gồm chữ hoặc số</em> </br>";
             }
        return $msg;
    }

}



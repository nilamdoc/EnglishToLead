<?php
namespace app\controllers;

use app\models\Users;



class UsersController extends \lithium\action\Controller {

	protected function _init() {
  parent::_init();
  $this->_render['layout'] = 'default';
		$this->set(array('title'=>'Users'));
 }

public function index($format=""){
	
	if($this->request->data){
		$post = $this->request->data['post'];
		$format = $this->request->data['json'];
		
		switch($post){
			case 'add':
			break;
			case 'edit':
			break;
			case 'delete':
			break;
			case 'view':
			break;
			default:
	}
	}
	
		switch($format){
			case 'json';
				return $this->render(array('json' => array("success"=>"Yes")));		
			break;
			case "";
				return compact($data);
			break;
			default:
				return $this->render(array('json' => array("success"=>"No")));		
		}
		
	
		print_r($format);
	return $this->render(array('json' => array("success"=>"Yes","params"=>"Check Parameters")));		
}


public function randomuser($_id=null,$limit){
	
	$countUser = Users::count();
	$skip = rand(0,($countUser/$limit));
	
	$users = Users::find('all',array(
		'conditions'=>array('_id'=>array('$ne'=>(string)$_id)),
		'limit'=>$limit,
		'page'=>$skip,	
	));
	return $this->render(array('json' => array("success"=>"yes","skip"=>$skip,'users'=>$users)));		
}



}


?>



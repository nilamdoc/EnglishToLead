<?php
namespace app\controllers;

use app\models\Attachments;
use app\models\Courses;
use app\models\Weeks;
use app\models\Sections;
use app\models\Subjects;




class AttachmentsController extends \lithium\action\Controller {

	protected function _init() {
  parent::_init();
  $this->_render['layout'] = 'default';
		$this->set(array('title'=>'Attachments'));
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
	$courses = Courses::find('all');
		switch($format){
			case 'json';
				return $this->render(array('json' => array("success"=>"Yes")));		
			break;
			case "";
				return compact('courses');
			break;
			default:
				return $this->render(array('json' => array("success"=>"No")));		
		}
	
	
	
	//print_r($format);
	return $this->render(array('json' => array("success"=>"Yes","params"=>"Check Parameters")));		
}



}
?>
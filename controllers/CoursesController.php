<?php
namespace app\controllers;

use app\models\Courses;



class CoursesController extends \lithium\action\Controller {

	protected function _init() {
  parent::_init();
  $this->_render['layout'] = 'default';
		$this->set(array('title'=>'Courses'));
 }

public function index($format=""){
	
	
	if($this->request->data){
		
		$post = $this->request->data['post'];
		$format = $this->request->data['json'];

		switch($post){
			case 'add':
			$data = array(
				'course_name'=>$this->request->data['course_name']
			);
			Courses::create()->save($data);
			$data = Courses::find('all',array(
				'order'=>array('course_name'=>'ASC')
			));

			break;
			
			case 'edit':
			$data = array(
				'course_name'=>$this->request->data['course_name']
			);
			$conditions = array('_id'=>(string)$this->request->data['course_edit_id']);
			Courses::update($data,$conditions);
			break;
			
			case 'delete':
			$conditions = array('_id'=>(string)$this->request->data['course_delete_id']);
			Courses::remove($conditions);
			break;
			
			case 'view':
			break;
			default:
			$data = Courses::find('all',array(
				'order'=>array('course_name'=>'ASC')
			));
	}
	}
		$data = Courses::find('all',array(
				'order'=>array('course_name'=>'ASC')
		));
		
		switch($format){
			case 'json';
				return $this->render(array('json' => array("success"=>"Yes",'data'=>$data)));		
			break;
			case "";
				return compact('data');
			break;
			default:
				return $this->render(array('json' => array("success"=>"No")));		
		}
		
	
		print_r($format);
	return $this->render(array('json' => array("success"=>"Yes","params"=>"Check Parameters")));		
}


}


?>



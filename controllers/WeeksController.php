<?php
namespace app\controllers;

use app\models\Courses;
use app\models\Weeks;


class WeeksController extends \lithium\action\Controller {

	protected function _init() {
  parent::_init();
  $this->_render['layout'] = 'default';
		$this->set(array('title'=>'Weeks'));
 }

	public function index($course_id="",$format=""){	
	if($this->request->data){
		$post = $this->request->data['post'];
		$format = $this->request->data['json'];
		switch($post){
			case 'add':
			$data = array(
				'week_name'=>$this->request->data['week_name'],
				'week_description'=>$this->request->data['week_description'],
				'course_id'=>$this->request->data['course_id']
			);
			Weeks::create()->save($data);
			$data = Weeks::find('all',array(
				'order'=>array('week_name'=>'ASC')
			));
			break;
			
			case 'edit':
			$data = array(
				'week_name'=>$this->request->data['week_name'],
				'week_description'=>$this->request->data['week_edit_description'],
			);
			$conditions = array('_id'=>(string)$this->request->data['week_edit_id']);
			
			Weeks::update($data,$conditions);
			break;
			
			case 'delete':
			$conditions = array('_id'=>(string)$this->request->data['week_delete_id']);
			Weeks::remove($conditions);
			break;
			
			case 'view':
			break;
			default:
			$data = Weeks::find('all',array(
				'order'=>array('week_name'=>'ASC')
			));
		}
	}

	$data_courses = Courses::find('first',array(
		'conditions'=>array('_id'=>(string)$course_id)
	));
	$data_weeks = Weeks::find('all',array(
		'conditions'=>array('course_id'=>(string)$course_id),
		'order'=>array('week_name'=>'ASC')
	));
	$data = array();
	array_push($data,$data_courses,$data_weeks);
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
	return $this->render(array('json' => array("success"=>"Yes","params"=>"Check Parameters")));		
	}

}
?>
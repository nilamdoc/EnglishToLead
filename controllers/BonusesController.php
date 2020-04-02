<?php
namespace app\controllers;

use app\models\Courses;
use app\models\Bonuses;


class BonusesController extends \lithium\action\Controller {

	protected function _init() {
  parent::_init();
  $this->_render['layout'] = 'default';
		$this->set(array('title'=>'Bonuses'));
 }

	public function index($course_id="",$format=""){	
	if($this->request->data){
		$post = $this->request->data['post'];
		$format = $this->request->data['json'];
		switch($post){
			case 'add':
			$data = array(
				'bonus_name'=>$this->request->data['bonus_name'],
				'bonus_description'=>$this->request->data['bonus_description'],
				'course_id'=>$this->request->data['course_id']
			);
			Bonuses::create()->save($data);
			$data = Bonuses::find('all',array(
				'order'=>array('bonus_name'=>'ASC')
			));
			break;
			
			case 'edit':
			$data = array(
				'bonus_name'=>$this->request->data['bonus_name'],
				'bonus_description'=>$this->request->data['bonus_edit_description'],
			);
			$conditions = array('_id'=>(string)$this->request->data['bonus_edit_id']);
			
			Bonuses::update($data,$conditions);
			break;
			
			case 'delete':
			$conditions = array('_id'=>(string)$this->request->data['bonus_delete_id']);
			Bonuses::remove($conditions);
			break;
			
			case 'view':
			break;
			default:
			$data = Bonuses::find('all',array(
				'order'=>array('bonus_name'=>'ASC')
			));
		}
	}

	$data_courses = Courses::find('first',array(
		'conditions'=>array('_id'=>(string)$course_id)
	));
	$data_bonuses = Bonuses::find('all',array(
		'conditions'=>array('course_id'=>(string)$course_id),
		'order'=>array('bonus_name'=>'ASC')
	));
	$data = array();
	array_push($data,$data_courses,$data_bonuses);
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
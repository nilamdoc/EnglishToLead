<?php
namespace app\controllers;

use app\models\Courses;
use app\models\Weeks;
use app\models\Sections;


class SectionsController extends \lithium\action\Controller {

	protected function _init() {
  parent::_init();
  $this->_render['layout'] = 'default';
		$this->set(array('title'=>'Sections'));
 }

	public function index($week_id="",$format=""){	
	if($this->request->data){
		$post = $this->request->data['post'];
		$format = $this->request->data['json'];
		switch($post){
			case 'add':
			$data = array(
				'section_name'=>$this->request->data['section_name'],
				'section_description'=>$this->request->data['section_description'],
				'week_id'=>$this->request->data['week_id']
			);
			Sections::create()->save($data);
			$data = Sections::find('all',array(
				'order'=>array('section_name'=>'ASC')
			));
			break;
			
			case 'edit':
			$data = array(
				'section_name'=>$this->request->data['section_name'],
				'section_description'=>$this->request->data['section_edit_description'],
			);
			$conditions = array('_id'=>(string)$this->request->data['section_edit_id']);
			
			Sections::update($data,$conditions);
			break;
			
			case 'delete':
			$conditions = array('_id'=>(string)$this->request->data['section_delete_id']);
			Sections::remove($conditions);
			break;
			
			case 'view':
			break;
			default:
			$data = Sections::find('all',array(
				'order'=>array('section_name'=>'ASC')
			));
		}
	}

	$data_weeks = Weeks::find('first',array(
		'conditions'=>array('_id'=>(string)$week_id)
	));
	$data_sections = Sections::find('all',array(
		'conditions'=>array('week_id'=>(string)$week_id),
		'order'=>array('section_name'=>'ASC')
	));
	$data_courses = Courses::find('first',array(
		'conditions' => array('_id'=>$data_weeks['course_id'])
	));
	$data = array();
	array_push($data,$data_weeks,$data_sections,$data_courses);
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
<?php
namespace app\controllers;

use app\models\Courses;
use app\models\Weeks;
use app\models\Sections;
use app\models\Subjects;

class SubjectsController extends \lithium\action\Controller {

	protected function _init() {
  parent::_init();
  $this->_render['layout'] = 'default';
		$this->set(array('title'=>'Subjects'));
 }

	public function index($section_id="",$format=""){	
	if($this->request->data){
		$post = $this->request->data['post'];
		$format = $this->request->data['json'];
		switch($post){
			case 'add':
			$data = array(
				'subject_name'=>$this->request->data['subject_name'],
				'subject_description'=>$this->request->data['subject_description'],
				'section_id'=>$this->request->data['section_id']
			);
			Subjects::create()->save($data);
			$data = Subjects::find('all',array(
				'order'=>array('subject_name'=>'ASC')
			));
			break;
			
			case 'edit':
			$data = array(
				'subject_name'=>$this->request->data['subject_name'],
				'subject_description'=>$this->request->data['subject_edit_description'],
			);
			$conditions = array('_id'=>(string)$this->request->data['subject_edit_id']);
			
			Subjects::update($data,$conditions);
			break;
			
			case 'delete':
			$conditions = array('_id'=>(string)$this->request->data['subject_delete_id']);
			Subjects::remove($conditions);
			break;
			
			case 'view':
			break;
			default:
			$data = Subjects::find('all',array(
				'order'=>array('subject_name'=>'ASC')
			));
		}
	}

	$data_sections = Sections::find('first',array(
		'conditions'=>array('_id'=>(string)$section_id)
	));
	$data_subjects = Subjects::find('all',array(
		'conditions'=>array('section_id'=>(string)$section_id),
		'order'=>array('subject_name'=>'ASC')
	));
	$data_weeks = Weeks::find('first',array(
		'conditions'=> array('_id'=>$data_sections['week_id'])
	));
	$data_courses = Courses::find('first',array(
		'conditions' => array('_id'=>$data_weeks['course_id'])
	));
	
	$data = array();
	array_push($data,$data_sections,$data_subjects,$data_weeks, $data_courses);
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
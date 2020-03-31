<?php
namespace app\controllers;

use app\models\Courses;
use app\models\Weeks;
use app\models\Sections;
use app\models\Subjects;
use app\models\Topics;

class TopicsController extends \lithium\action\Controller {

	protected function _init() {
  parent::_init();
  $this->_render['layout'] = 'default';
		$this->set(array('title'=>'Topics'));
 }

	public function index($subject_id="",$format=""){	
	if($this->request->data){
		$post = $this->request->data['post'];
		$format = $this->request->data['json'];
		switch($post){
			case 'add':
			$data = array(
				'topic_name'=>$this->request->data['topic_name'],
				'topic_description'=>$this->request->data['topic_description'],
				'subject_id'=>$this->request->data['subject_id']
			);
			Topics::create()->save($data);
			$data = Topics::find('all',array(
				'order'=>array('_id'=>'ASC')
			));
			break;
			
			case 'edit':
			$data = array(
				'topic_name'=>$this->request->data['topic_name'],
				'topic_description'=>$this->request->data['topic_edit_description'],
			);
			$conditions = array('_id'=>(string)$this->request->data['topic_edit_id']);
			
			Topics::update($data,$conditions);
			break;
			
			case 'delete':
			$conditions = array('_id'=>(string)$this->request->data['topic_delete_id']);
			Topics::remove($conditions);
			break;
			
			case 'view':
			break;
			default:
			$data = Topics::find('all',array(
				'order'=>array('_id'=>'ASC')
			));
		}
	}

	$data_subjects = Subjects::find('first',array(
		'conditions'=>array('_id'=>(string)$subject_id)
	));
	
	$data_topics = Topics::find('all',array(
		'conditions'=>array('subject_id'=>(string)$subject_id),
		'order'=>array('_id'=>'ASC')
	));
	
	$data_sections = Sections::find('first',array(
		'conditions'=>array('_id'=>$data_subjects['section_id']),
	));
	$data_weeks = Weeks::find('first',array(
		'conditions'=> array('_id'=>$data_sections['week_id'])
	));
	$data_courses = Courses::find('first',array(
		'conditions' => array('_id'=>$data_weeks['course_id'])
	));
	
	$data = array();
	array_push($data,$data_subjects,$data_topics,$data_sections,$data_weeks, $data_courses);
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
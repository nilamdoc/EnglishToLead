<?php
namespace app\controllers;

use app\models\Attachments;
use app\models\Courses;
use app\models\Weeks;
use app\models\Sections;
use app\models\Subjects;

use lithium\data\Connections;


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
				Attachments::create()->save($this->request->data);
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
	$attachments = $this->getAttachments();
		switch($format){
			case 'json';
				return $this->render(array('json' => array("success"=>"Yes")));		
			break;
			case "";
				return compact('courses','attachments');
			break;
			default:
				return $this->render(array('json' => array("success"=>"No")));		
		}
	
	
	
	//print_r($format);
	return $this->render(array('json' => array("success"=>"Yes","params"=>"Check Parameters")));		
}

public function getWeeks(){
		if($this->request->data){
			$weeks = Weeks::find('all',array(
				'conditions'=>array("course_id"=>(string)$this->request->data['_id'])
			));
			return $this->render(array('json' => array("success"=>"Yes",'weeks'=>$weeks)));		
		}
		return $this->render(array('json' => array("success"=>"No")));		
}

public function getSections(){
		if($this->request->data){
			$sections = Sections::find('all',array(
				'conditions'=>array("week_id"=>(string)$this->request->data['_id'])
			));
			return $this->render(array('json' => array("success"=>"Yes",'sections'=>$sections)));		
		}
		return $this->render(array('json' => array("success"=>"No")));		
}


public function getSubjects(){
		if($this->request->data){
			$subjects = Subjects::find('all',array(
				'conditions'=>array("section_id"=>(string)$this->request->data['_id'])
			));
			return $this->render(array('json' => array("success"=>"Yes",'subjects'=>$subjects)));		
		}
		return $this->render(array('json' => array("success"=>"No")));		
}






public function getAttachments(){
		
$result = Attachments::find('all',array(
		'order'=>array('_id'=>'ASC')
	));
		
		$all_result=array();
		
		foreach ($result as $r){
			$course_id = $r['course_id'];
			$course = Courses::find('first',array(
					'_id'=>(string)$course_id
			));
			$week_id = $r['week_id'];
			$week = Weeks::find('first',array(
					'conditions'=>array('_id'=>(string)$week_id)
			));
			$section_id = $r['section_id'];
			$section = Sections::find('first',array(
					'conditions'=>array('_id'=>(string)$section_id)
			));
			$subject_id = $r['subject_id'];
			$subject = Subjects::find('first',array(
					'conditions'=>array('_id'=>(string)$subject_id)
			));
			
			array_push($all_result,array(
					'attachment_id'=>$r['_id'],
					'attach'=>$r['attach'],
					'attachment'=>$r['attachment'],
					'course_id'=>$r['course_id'],
					'course_name'=>$course['course_name']?:"",
					'week_id'=>$r['week_id'],
					'week_name'=>$week['week_name']?:"",
					'section_id'=>$r['section_id'],
					'section_name'=>$section['section_name']?:"",
					'subject_id'=>$r['subject_id'],
					'subject_name'=>$subject['subject_name']?:"",
			));
			
		}
		
		
		
		return $all_result;

}




}
?>
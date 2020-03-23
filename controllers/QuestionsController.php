<?php
namespace app\controllers;


use app\models\Courses;
use app\models\Weeks;
use app\models\Sections;
use app\models\Subjects;
use app\models\Questions;
use app\models\Questiontypes;


class QuestionsController extends \lithium\action\Controller {

	protected function _init() {
  parent::_init();
  $this->_render['layout'] = 'default';
		$this->set(array('title'=>'Questions'));
 }

public function index($subject_id="",$format=""){
		
	if($this->request->data){
		
		$post = $this->request->data['post'];
		$format = $this->request->data['json'];
		
		switch($post){
			case 'add':
			$data = array(
				'question_name'=>$this->request->data['question_name'],
				'question_description'=>$this->request->data['question_description'],
				'subject_id'=>$this->request->data['subject_id']
			);
			Questions::create()->save($data);
			$data = Questions::find('all',array(
				'order'=>array('subject_name'=>'ASC')
			));
			break;
			
			case 'edit':
			$data = array(
				'question_name'=>$this->request->data['question_name'],
				'question_description'=>$this->request->data['question_description'],
			);
			$conditions = array('_id'=>(string)$this->request->data['question_edit_id']);
			
			Questions::update($data,$conditions);
			break;
			
			case 'delete':
			$conditions = array('_id'=>(string)$this->request->data['question_delete_id']);
			Questions::remove($conditions);
			break;
			
			case 'view':
			break;
			default:
			$data = Questions::find('all',array(
				'order'=>array('question_name'=>'ASC')
			));
		}
	}

		$data_subjects = Subjects::find('first',array(
			'conditions'=>array('_id'=>(string)$subject_id)
		));
		$data_questions = Questions::find('all',array(
		'conditions'=>array('subject_id'=>(string)$subject_id),
			'order'=>array('question_name'=>'ASC')
		));
		$data_questiontypes = Questiontypes::find('all');
	$data = array();
	array_push($data,$data_subjects,$data_questions,$data_questiontypes);

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

public function qt(){}
}
?>
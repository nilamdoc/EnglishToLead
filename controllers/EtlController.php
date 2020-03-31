<?php
namespace app\controllers;
use lithium\storage\Session;
use \lithium\template\View;
use app\extensions\action\Functions;
use app\extensions\action\GoogleAuthenticator;


use app\models\Users;
use app\models\Audios;
use app\models\Bonuses;
use app\models\Attachments;
use app\models\Courses;
use app\models\Weeks;
use app\models\Sections;
use app\models\Subjects;
use app\models\Topics;
use app\models\Questions;


class EtlController extends \lithium\action\Controller {

	 protected function _init() {
  parent::_init();
  $this->_render['layout'] = 'default';
 }

	public function index(){
		return $this->render(array('json' => array("success"=>"Yes")));		
	}

	public function sendotp(){
		if($this->request->data){
		
		$mobile = $this->request->data['mobile'];
			if(substr($mobile,0,1)!="+"){
				return $this->render(array('json' => array("success"=>"No")));		
			}
	 $user = Users::find('first',array(
   'conditions'=>array(
				'mobile'=>(string)$mobile,
				)
		));
		if(count($user)==1){
			$mobile = $this->request->data['mobile'];
			
			$ga = new GoogleAuthenticator();
			$otp = $ga->getCode($ga->createSecret(64));	
			$data = array(
				'otp' => $otp,
				);
			$conditions = array("mobile"=>(string)$this->request->data['mobile']);
			
			Users::update($data,$conditions);
			$function = new Functions();
			$msg = "". $otp . " is the OTP for English To Lead registration in the app";
			$returncall = $function->twilio($mobile,$msg,$otp);	 // Testing if it works 
			$returnsms = $function->sendSms($mobile,$msg);	 // Testing if it works 
			$user = Users::find('first',array(
   'conditions'=>$conditions
			));
				return $this->render(array('json' => array("success"=>"Yes","otp"=>$otp,'user'=>$user)));		
		}else{
				$conditions = array("mobile"=>(string)$this->request->data['mobile']);
				$ga = new GoogleAuthenticator();
				$otp = $ga->getCode($ga->createSecret(64));	
				
				$data = array(
					'mobile' => $this->request->data['mobile'],
					'otp' => $otp,
					'DateTime'=>new \MongoDate,
				);
				Users::create()->save($data);
				$function = new Functions();
				$msg = "". $otp . " is the OTP for English To Lead registration in the app";
				$returncall = $function->twilio($mobile,$msg,$otp);	 // Testing if it works 
				$returnsms = $function->sendSms($mobile,$msg);	 // Testing if it works 
				$user = Users::find('first',array(
					'conditions'=>$conditions
					));
				return $this->render(array('json' => array("success"=>"Yes","otp"=>$otp,'user'=>$user)));		
				
		}
	}
	return $this->render(array('json' => array("success"=>"No")));		
	}

	public function verifyotp(){ 
		if($this->request->data){
		
			$mobile = $this->request->data['mobile'];
			$otp = $this->request->data['otp'];
			$conditions = array("mobile"=>(string)$this->request->data['mobile'],'otp'=>(string)$this->request->data['otp']);
			
			$user = Users::find('first',array(
   'conditions'=>$conditions,
			'fields'=>array('name','email','company','role','addresses'),
		));
		
		if(count($user)==1){
			return $this->render(array('json' => array("success"=>"Yes","otp"=>$otp,'user'=>$user,'addresses'=>count($user['addresses']))));		
		}else{
			return $this->render(array('json' => array("success"=>"No")));		
		}
		return $this->render(array('json' => array("success"=>"No")));		
	}
}

public function getinfo(){
		if($this->request->data){
			$mobile = $this->request->data['mobile'];
			
			$conditions = array("mobile"=>(string)$this->request->data['mobile']);
			$user = Users::find('first',array(
				'conditions'=>$conditions
			));
	if(count($user)==1){
			return $this->render(array('json' => array("success"=>"Yes",'user'=>$user)));		
		}else{
			return $this->render(array('json' => array("success"=>"No")));		
		}
		return $this->render(array('json' => array("success"=>"No")));		

		}
}


public function savedata(){
	$data = array(
		'name'=>$this->request->data['name'],
		'email'=>$this->request->data['email'],
		'company'=>$this->request->data['company'],
	);
	$conditions = array(
		'mobile'=>(string)$this->request->data['mobile'],
	);
	Users::update($data,$conditions);
	$user = Users::find('first',array(
		'conditions'=> $conditions,
		'fields'=>array('name','email','company','role'),
	));
	return $this->render(array('json' => array("success"=>"Yes",'user'=>$user)));		
}

public function saveaudio(){
		if($this->request->data){
			Audios::create()->save($this->request->data);
		}
		return $this->render(array('json' => array("success"=>"Yes",'data'=>$this->request->data)));		
		
}

public function getpath($type=null,$_id=null){

	switch($type){ 
				case 'course':
				$course = Courses::find('first',array(
					'conditions'=>array('_id'=>(string)$_id)
				));
				break;
				
				case 'week':
				$week = Weeks::find('first',array(
					'conditions'=>array('_id'=>(string)$_id)
				));
				$course = Courses::find('first',array(
					'conditions'=>array('_id'=>(string)$week['course_id'])
				));
				break;
				
				case 'section':
				$section = Sections::find('first',array(
					'conditions'=>array('_id'=>(string)$_id)
				));
				$week = Weeks::find('first',array(
					'conditions'=>array('_id'=>(string)$section['week_id'])
				));
				$course = Courses::find('first',array(
					'conditions'=>array('_id'=>(string)$week['course_id'])
				));				
				break;
				
				case 'subject':
				$subject = Subjects::find('first',array(
					'conditions'=>array('_id'=>(string)$_id)
				));
				$section = Sections::find('first',array(
					'conditions'=>array('_id'=>(string)$subject['section_id'])
				));
				$week = Weeks::find('first',array(
					'conditions'=>array('_id'=>(string)$section['week_id'])
				));
				$course = Courses::find('first',array(
					'conditions'=>array('_id'=>(string)$week['course_id'])
				));
				break;
				
				case 'topic':
				$topic = Topics::find('first',array(
					'conditions'=>array('_id'=>(string)$_id)
				));
				$subject = Subjects::find('first',array(
					'conditions'=>array('_id'=>(string)$topic['subject_id'])
				));
				$section = Sections::find('first',array(
					'conditions'=>array('_id'=>(string)$subject['section_id'])
				));
				$week = Weeks::find('first',array(
					'conditions'=>array('_id'=>(string)$section['week_id'])
				));
				$course = Courses::find('first',array(
					'conditions'=>array('_id'=>(string)$week['course_id'])
				));
				break;
				
				
				case 'question':
				$question = Questions::find('first',array(
					'conditions'=>array('_id'=>(string)$_id)
				));
				$topic = Topics::find('first',array(
					'conditions'=>array('_id'=>(string)$question['topic_id'])
				));
				$subject = Subjects::find('first',array(
					'conditions'=>array('_id'=>(string)$topic['subject_id'])
				));
				$section = Sections::find('first',array(
					'conditions'=>array('_id'=>(string)$subject['section_id'])
				));
				$week = Weeks::find('first',array(
					'conditions'=>array('_id'=>(string)$section['week_id'])
				));
				$course = Courses::find('first',array(
					'conditions'=>array('_id'=>(string)$week['course_id'])
				));
				break;

	
	
	}
	
	$data = array(
				'path'=>(string)$course['_id'].'/'.(string)$week['_id'].'/'.(string)$section['_id'].'/'.(string)$subject['_id'].'/'.(string)$question['_id'].'/',
					'attachment_id'=>$attachment['_id'],
					'attach_name'=>$r['attach_name'],
					'attachment'=>$r['attachment'],
					'question_id'=>$question['_id'],
					'question'=>$question['question_name'],
					'course_id'=>$course['_id'],
					'course_name'=>$course['course_name']?:"",
					'week_id'=>$week['_id'],
					'week_name'=>$week['week_name']?:"",
					'section_id'=>$section['_id'],
					'section_name'=>$section['section_name']?:"",
					'subject_id'=>$subject['_id'],
					'subject_name'=>$subject['subject_name']?:"",
					'topic_id'=>$topic['_id'],
					'topic_name'=>$topic['topic_name']?:"",
					
			);

		return $this->render(array('json' => array("success"=>"Yes",'data'=>$data)));		


}

public function getCourses(){
	$courses = Courses::find('all',array(
		'order'=>array('_id'=>'ASC')
	));
	$bonuses = Bonuses::find('all',array(
		'order'=>array('_id'=>'ASC')
	));	
	$weeks = Weeks::find('all',array(
		'order'=>array('_id'=>'ASC')
	));
	$sections = Sections::find('all',array(
		'order'=>array('_id'=>'ASC')
	));
	$subjects = Subjects::find('all',array(
		'order'=>array('_id'=>'ASC')
	));
	$topics = Topics::find('all',array(
		'order'=>array('_id'=>'ASC')
	));
	$questions = Questions::find('all',array(
		'order'=>array('_id'=>'ASC')
	));
	$attachments = Attachments::find('all',array(
		'order'=>array('_id'=>'ASC')
	));

	$data = array(
		'courses'=>count($courses),
		'bonuses'=>count($bonuses),
		'weeks'=>count($weeks),
		'sections'=>count($sections),
		'subjects'=>count($subjects),
		'topics'=>count($topics),
		'questions'=>count($questions),
		'attachments'=>count($attachments),
	);
	
	return $this->render(array('json' => array("success"=>"Yes",
			'data'=>$data,
			'courses'=>$courses,
			'bonuses'=>$bonuses,
			'weeks'=>$weeks,
			'sections'=>$sections,
			'subjects'=>$subjects,
			'topics'=>$topics,
			'questions'=>$questions,
			'attachments'=>$attachments,			
	)));		

	
}


}
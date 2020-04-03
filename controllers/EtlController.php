<?php
namespace app\controllers;
use lithium\storage\Session;
use \lithium\template\View;
use app\extensions\action\Functions;
use app\extensions\action\GoogleAuthenticator;


use app\models\Users;
use app\models\Audios;
use app\models\Attachments;
use app\models\Outlines;
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
	$directory = substr($hash,0,1)."/".substr($hash,1,1)."/".substr($hash,2,1)."/".substr($hash,3,1);
	

}

public function getOutline($_id=null){
	
	if($_id==null){
			$main = Outlines::find('first',array(
				'conditions' => array('outline_name'=>'English To Lead')
			));
			//print_r($main['_id']);
			$outline = Outlines::find('all',array(
				'conditions' => array('outline_refer_id'=>(string)$main['_id']),
				'order'=>array('left'=>'DESC')
			));		
			
	}else{
			$outline = Outlines::find('all',array(
				'conditions' => array('outline_refer_id'=>(string)$_id),
				'order'=>array('left'=>'DESC')
			));
			$downLevels = $this->downlLevels($_id);
	}
	return $this->render(array('json' => array("success"=>"Yes",'outline'=>$outline, 'down'=>$downLevels,'main'=$main)));		
}

function downlLevels($_id){
		$current = Outlines::find('first',array(
		'conditions'=>array('_id'=>(string)$_id)
		));
			$left = $current['left'];
			$right = $current['right'];
			$down = Outlines::count('all',array('conditions'=>
			array(
						'left'=>array('$gt'=>$left),
						'right'=>array('$lt'=>$right),
					)));
		return $down;
}


}
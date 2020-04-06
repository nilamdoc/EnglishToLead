<?php
namespace app\controllers;
use lithium\storage\Session;
use \lithium\template\View;
use app\extensions\action\Functions;
use app\extensions\action\GoogleAuthenticator;

use Google\Cloud\TextToSpeech\V1\AudioConfig;
use Google\Cloud\TextToSpeech\V1\AudioEncoding;
use Google\Cloud\TextToSpeech\V1\SsmlVoiceGender;
use Google\Cloud\TextToSpeech\V1\SynthesisInput;
use Google\Cloud\TextToSpeech\V1\TextToSpeechClient;
use Google\Cloud\TextToSpeech\V1\VoiceSelectionParams;
use Google\Cloud\Storage\StorageClient;

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
		$allnext = array();
			
			foreach($outline as $o){
//				print_r($o['_id']."**".$o['outline_name']."--".$o['outline_refer_id']."@@@@@@@@@@@@@@@\n");
				$depth = Outlines::find('first',array(
					'conditions'=>array('outline_refer_id'=>(string)$o['_id']),
				));
				array_push($allnext,$depth);
			}

	
	return $this->render(array('json' => array("success"=>"Yes",'outline'=>$outline, 'down'=>$downLevels, 'countDown'=> count($downLevels), 'main'=>$main,'allnext'=>$allnext)));		
}

function downlLevels($_id){
		$current = Outlines::find('first',array(
		'conditions'=>array('_id'=>(string)$_id)
		));
			$left = $current['left'];
			$right = $current['right'];
			$down = Outlines::find('all',array('conditions'=>
			array(
				'outline_refer_id'=>(string)$_id
					)));
		return $down;
}
























function audio(){

// instantiates a client
$client = new TextToSpeechClient();

// sets text to be synthesised
$synthesisInputText = (new SynthesisInput())
    ->setText('Hello, world!');

// build the voice request, select the language code ("en-US") and the ssml
// voice gender
$voice = (new VoiceSelectionParams())
    ->setLanguageCode('en-US')
    ->setSsmlGender(SsmlVoiceGender::FEMALE);

// Effects profile
$effectsProfileId = "telephony-class-application";

// select the type of audio file you want returned
$audioConfig = (new AudioConfig())
    ->setAudioEncoding(AudioEncoding::MP3)
    ->setEffectsProfileId(array($effectsProfileId));

// perform text-to-speech request on the text input with selected voice
// parameters and audio file type
$response = $client->synthesizeSpeech($synthesisInputText, $voice, $audioConfig);
$audioContent = $response->getAudioContent();

// the response's audioContent is binary
file_put_contents('output.mp3', $audioContent);
echo	'Audio content written to "output.mp3"' . PHP_EOL;
	
	return $this->render(array('json' => array("success"=>"Yes")));		
	
}


//

function auth_cloud_implicit($projectId)
{
	
		$v = new ImageAnnotatorClient([
    'credentials' => 'F:/Google-Cloud-API/Audio for ETL-ec977ca75aa3.json'
		]);
    $config = [
        'projectId' => $projectId,
								'key'=>GOOGLE_API_KEY
    ];

    # If you don't specify credentials when constructing the client, the
    # client library will look for credentials in the environment.
    $storage = new StorageClient($config);

    # Make an authenticated API request (listing storage buckets)
    foreach ($storage->buckets() as $bucket) {
        printf('Bucket: %s' . PHP_EOL, $bucket->name());
    }
}


function directory(){
	$outlines = Outlines::find('all');
	foreach ($outlines as $o){
		$hash = sha1($o['_id']);
		$directory = substr($hash,0,1)."\\".substr($hash,1,1)."\\".substr($hash,2,1)."\\".substr($hash,3,1);
		echo exec("mkdir ".LITHIUM_APP_PATH.'\\webroot\\documents\\'.$directory);
	}
	
	return $this->render(array('json' => array("success"=>"Yes",'hash'=>LITHIUM_APP_PATH.'\\webroot\\documents\\'.$directory)));		
}


}

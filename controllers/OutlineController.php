<?php
namespace app\controllers;

use app\models\Outlines;



class OutlineController extends \lithium\action\Controller {

	protected function _init() {
  parent::_init();
  $this->_render['layout'] = 'default';
		$this->set(array('title'=>'Outlines'));
 }

	public function index(){
		if($this->request->data){		
			$post = $this->request->data['post'];
			
			
			switch($post){
				case 'add':
				$data = array(
									'outline_name' => $this->request->data['outline_name'],
									'outline_text' => $this->request->data['outline_text'],
									'outline_description' => $this->request->data['outline_description'],
									'outline_order' => $this->request->data['outline_order'],
									'DateTime' => new \MongoDate(),
									'outline_refer_id' => $this->request->data['outline_refer'],
        );				
								
				$conditions = array("mobile"=>(string)$this->request->data['mobile']);
								
				if($this->addOutline($data)==true){
					
				}
				break;
				
				case 'edit':
				break;
				
				case 'delete':
				break;

			}
		
		}
		
		$data = Outlines::find('all',array(
				'fields'=>array('outline_name','_id','ancestors_names'),
				'order'=>array('_id'=>'ASC')
		));
		
		return compact('data');
		
	}

function AddOutline($data){
		if($data){
			if($data['outline_name']!="" ){
					$refer = Outlines::first(array(
						'conditions'=>array('_id'=>(string)$data['outline_refer_id'])
					));
				if(count($refer)>0){
						$refer_ancestors = $refer['ancestors'];
						$refer_ancestors_name = $refer['ancestors_names'];
							$ancestors = array();
							$ancestors_names = array();
							if(count($refer_ancestors)>0){
								foreach ($refer_ancestors as $ra){
									array_push($ancestors, $ra);
								}
							}
							if(count($refer_ancestors_name)>0){
								foreach ($refer_ancestors_name as $ra){
									array_push($ancestors_names, $ra);
								}
							}

					$refer_id = (string) $refer['_id'];
					$refer_name = (string) $refer['outline_name'];

					array_push($ancestors,$refer_id);
					array_push($ancestors_names,$refer_name);
					
					$refer_left = (integer)$refer['left'];
					$refer_left_inc = (integer)$refer['left'];
					
					Outlines::update(
						array(
							'$inc' => array('right' => (integer)2)
						),
						array('right' => array('>'=>(integer)$refer_left_inc)),
						array('multi' => true)
					);
					Outlines::update(
						array(
							'$inc' => array('left' => (integer)2)
						),
						array('left' => array('>'=>(integer)$refer_left_inc)),
						array('multi' => true)
					);
					
					
					
					
					$newData = array(
									'outline_name' => $data['outline_name'],
									'outline_text' => $data['outline_text'],
									'outline_description' => $data['outline_description'],
									'outline_order' => $data['outline_order'],
									'DateTime' => new \MongoDate(),
									'outline_refer_id' => $data['outline_refer_id'],
									'left'=>(integer)($refer_left+1),
									'right'=>(integer)($refer_left+2),
									'ancestors'=> $ancestors,
									'ancestors_names'=> $ancestors_names,
					);
					
					Outlines::create()->save($newData);
					return true;
				}else{
					return false;
				}
			}
	}	
}


}
?>
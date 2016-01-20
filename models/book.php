<?php
class model_book extends Model{
	protected function load(){
		$this->setTable('books');
	}

	public function GetByID($id){
		$data = $this->find(array(
			'conditions' => 'id='.$id,
			'single' => true
		));

		if(empty($data)){
			return null;
		}else{
			$Controller = Controller::$self;
			$Member = $Controller->loadModel('member');
			$data['creator'] = $Member->GetByID($data['creator']);
			return $data;
		}
	}
}
?>
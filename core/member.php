<?php
class Member{

	// Methodes
	public function __construct(){

	}

	private function LoadFromTable($data){
		if(!empty($data)){
			foreach ($data as $key => $value) {
				$this->$key = $value;
			}
		}
	}

	// Getter
	public function GetID(){
		return $this->id;
	}
	public function GetName(){
		return $this->name;
	}
	public function GetNameID(){
		return $this->nameid;
	}
	public function GetEmail(){
		return $this->email;
	}
	public function GetDescription(){
		return $this->description;
	}

	// Setter
	public function SetName($name){
		$this->name = $name;
	}
	public function SetEmail($email){
		$this->email = $email;
	}


	static function GetByID($id){
		global $Database;

		$sql = "SELECT * FROM member_profil WHERE id='$id'";
		$req = $Database->query($sql);
		$data = $req->fetch(PDO::FETCH_ASSOC);

		if(empty($data)){
			return null;
		}else{
			$member = new Member;
			$member->LoadFromTable($data);
			return $member;
		}
	}

	static function GetByNameID($nameid){
		global $Database;

		$data = Model::_find('member_profil', array(
			'conditions' => "nameid='".$nameid."'",
			'single'	 => true
		));

		if(empty($data)){
			return null;
		}else{
			$member = new Member;
			$member->LoadFromTable($data);
			return $member;
		}
	}

	static function AddMember($data){
		$data['confirmation_token'] = md5($data['nameid'].rand());

		print_r($data);
		// Model::_save('member_account', $data);
	}
}
?>
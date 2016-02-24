<?php
class model_page extends Model{


	protected function load(){
		$this->setTable('pages');
	}

	protected function InitTable(){
		$this->run("
			CREATE TABLE IF NOT EXISTS `pages` (
				`id`              	int(11)     	NOT NULL AUTO_INCREMENT,
				`book`            	int(11)     	NOT NULL,
				`title`           	varchar(256)	DEFAULT NULL,
				`content`         	text        	NOT NULL,
				`creator`         	int(11)     	NOT NULL,
				`updator`         	int(11)     	DEFAULT NULL,
				`publication_date`	timestamp   	NOT NULL DEFAULT CURRENT_TIMESTAMP,
				`update_date`     	timestamp   	NULL DEFAULT NULL,

				UNIQUE (`id`), 
				PRIMARY KEY (`id`),
				FOREIGN KEY (`book`)   	REFERENCES books(`id`),
				FOREIGN KEY (`creator`)	REFERENCES members(`id`),
				FOREIGN KEY (`updator`)	REFERENCES members(`id`)
			);

			CREATE UNIQUE INDEX `Page_ID` ON pages (`id`, `book`); 
		");
	}

	public function Create($data){
		$page = array(
			'book'   	=> $data['book'],
			'title'  	=> $data['title'] ?: null,
			'content'	=> $data['content'],
			'creator'	=> $data['creator']
		);

		return $this->save($page);
	}

	public function GetByID($id){
		$data = $this->find(array(
			'conditions'	=> 'id='.$id,
			'single'    	=> true
		));

		if(empty($data)){
			return null;
		}else{
			$page = new Page($data);
			return $page;
		}
	}

	public function GetByBookID($id){
		$data = $this->find(array(
			'conditions' => 'book='.$id
		));

		if(empty($data)){
			return null;
		}else{
			$books = array();
			foreach ($data as $key => $value) {
				$page = new Page($value);
				array_push($books, $page);
			}
			return $data;
		}
	}

	public function Count($id){
		$sql = "SELECT COUNT(id) AS count FROM ".$this->table." WHERE book=".$id;
		$req = $this->run($sql);
		return $req->fetch(PDO::FETCH_ASSOC)['count'];
	}

	public function GetAuthors($book){
		$data = $this->find(array(
			'fields' => 'DISTINCT creator',
			'conditions' => 'book='.$book
		));
		return array_map(function($v){return $v['creator'];}, $data);
	}
}
?>

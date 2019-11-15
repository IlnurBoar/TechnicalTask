<?php

class Database
{
	public $host = DB_HOST;
	public $user = DB_USER;
	public $pass = DB_PASS;
	public $dbname = DB_NAME;
	
	private static $_instance = null;

	public $link;
	public $error;

	private function __construct()
	{
		
		R::setup("mysql:host=".$this->host.";dbname=".$this->dbname."", $this->user, $this->pass);
		if ( !R::testConnection() )
{
        exit ('Нет соединения с базой данных');
}
	}

	public function __destruct(){
		R::close();
	}

	public static function getInstance(){
		if(is_null(self::$_instance)){
			self::$_instance = new Database;
		}
		return self::$_instance;
	}

	private function __clone() {}

	//insert
	public function select(){
		$this->link = R::findAll('user1');
		return $this->link;
	}

	public function selectById($id){
		$this->link = R::load('user1', $id);
		return $this->link;
	}

	//select 

	public function insert($table, $name, $price, $description, $features){
		$this->link = R::dispense($table);
		$this->link->name = $name;
		$this->link->price = $price;
		$this->link->description = $description;
		$this->link->features = $features;
		R::store($this->link);
	}

	public function update($id, $name, $price, $description, $features){
		$this->link = R::load('user1', $id);
		$this->link->name = $name;
		$this->link->price = $price;
		$this->link->description = $description;
		$this->link->features = $features;
		R::store($this->link);
		// return $this->link;
	}

	public function delete($query){
		$id = $query;
		$find = R::findOne('user1', 'id = ?',[$id]);
		$delete = R::load('user1', $find->id);
		$this->link = R::trash($delete);
	}

	//create table
	public function create($query){
		$insert = $this->link->query($query) or die($this->link->error.__LINE__);
		if($insert){
			return $insert;
		}
		return FALSE;
	}

}



?>
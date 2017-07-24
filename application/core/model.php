<?php
abstract class Model
{
	public $db;

	function __construct()
	{
		$this->db = new Database();
	}
	
	
	public function get_data()
	{
	}
}
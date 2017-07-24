<?php
class Controller_Query extends Controller
{


	function __construct()
	{
		$this->model = new Model_Query();
		$this->view = new View();
		$this->active = "query";
	}
	
	function action_index()
	{
		$data = $this->model->get_data();		
		$this->view->generate('query_view.php', 'template_view.php', $data, $this->active);
	}
}
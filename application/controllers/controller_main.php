<?php
class Controller_Main extends Controller
{
	function __construct()
	{
		$this->active = "main";
		$this->view = new View();
	}
	
	function action_index()
	{
		$data = null;		
		$this->view->generate('main_view.php', 'template_view.php', $data, $this->active);
	}
}
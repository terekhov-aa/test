<?php
class Controller_Regular extends Controller
{


	function __construct()
	{
		$this->model = new Model_Regular();
		$this->view = new View();
		$this->active = "regular";
	}
	
	function action_index()
	{
		if (isset($_POST['submit'])) {
			$data = $this->model->insert_data();		
			$this->view->generate('regular_view.php', 'template_view.php', $data, $this->active);
		}
		else{
			$data = $this->model->get_data();		
			$this->view->generate('regular_view.php', 'template_view.php', $data, $this->active);
		}
	}
}
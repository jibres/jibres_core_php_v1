<?php
class main_controller extends mvcController_cls
{
	public function config() 
	{
	}

	function options()
	{
		if($this->login())
		{
			//redirect to cp
			// var_dump('user login to system: redirect to cp');
			// $this->redirect->urlChange()->subdomain("cp");
			// var_dump($_SESSION['user'] );
		}
	}
}
?>

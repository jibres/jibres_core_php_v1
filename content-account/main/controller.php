<?php
class main_controller extends mvcController_cls
{
	function options()
	{
		if($this->login())
		{
			//redirect to cp
			var_dump('user login to system: redirect to cp');
			var_dump($_SESSION['user'] );
		}
	}

}
?>

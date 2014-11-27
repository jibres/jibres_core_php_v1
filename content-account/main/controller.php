<?php
class main_controller extends mvcController_cls{
	function options(){
		if(!$this->login()){
			$this->listen(array(
				"real_url" => array("/^(?!login|signup)/")
					),
				function(){
					header("Location: /login");
					exit();
				});
		}
	}
}
?>

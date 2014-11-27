<?php
class main_controller extends mvcController_cls{
	function options(){
		if(!$this->login()){
			$this->listen(array(
				"real_url" => array("/^(?!login)/")
					),
				function(){
					header("Location: /login");
					exit();
				});
		}
	}
}
?>

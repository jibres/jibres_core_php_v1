<?php
class config_cls{
	static function _before(){
		// if i remove below function, all of the modules on this class fail
		$l = config_lib::listen(
			array(
				"sub_domain" => array("account")
				)
			,function()
			{
				config_hendel_lib::url_unshift("account");
			}
			);

		$l = config_lib::listen(
			array(
				"sub_domain" => array("admin")
				)
			,function()
			{
				config_hendel_lib::url_unshift("admin");
			}
			);
		$l = config_lib::listen(
			array(
				"url" => array("~")
				)
			,function()
			{
				config_hendel_lib::url_unshift("~");
				exit();
				// config_hendel_lib::url_unshift("~");
			}
			);
	}
	static function _after(){
	}
}
<?php
class config_cls{
	static function _before()
	{
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
				config_hendel_lib::change_content("content-admin");
				config_hendel_lib::url_unshift("admin");
			}
		);

		$l = config_lib::listen(
			array(
				"sub_domain" => array("cp")
				)
			,function()
			{
				config_hendel_lib::url_unshift("cp");
			}
		);
	}
	static function _after()
	{
	}
}
//09194511025
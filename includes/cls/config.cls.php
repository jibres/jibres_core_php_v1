<?php
class config_cls{
	static function _before(){
		// login not work and i use redirect
		// $l = config_lib::listen(
		// 	array(
		// 		"url" => array("login")
		// 		)
		// 	,function(){
		// 		config_hendel_lib::change_content("content-account");
		// 	}
		// 	);
		$l = config_lib::listen(
			array(
				"sub_domain" => array("admin")
				)
			,function(){
				config_hendel_lib::url_unshift("admin");
			}
			);
		$l = config_lib::listen(
			array(
				"sub_domain" => array("cp")
				)
			,function(){
				config_hendel_lib::url_unshift("cp");
			}
			);
	}
	// static function _after(){
	// }
}
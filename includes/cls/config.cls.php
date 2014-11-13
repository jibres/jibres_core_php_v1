<?php
class config_cls{
	static function _before(){
		$l = config_lib::listen(
			array(
				"url" => array("test")
				)
			,function(){
				config_hendel_lib::url_shift("test");
			}
			);
	}
	static function _after(){
		$l = config_lib::listen(
			array(
				"sub_domain" => array("test")
				)
			,function(){
				config_hendel_lib::change_content("content-test");
			}
			);
	}
}
<?php
namespace content_a\setting\place\inventory;

class controller
{
	public static function routing()
	{

		if(\dash\request::get('id'))
		{
			\dash\data::dataRow(\lib\app\inventory\get::get(\dash\request::get('id')));
		}
	}
}
?>
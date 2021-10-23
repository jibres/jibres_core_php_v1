<?php
namespace content_b1\category\detail;


class view
{

	public static function config()
	{
		$dataRow = \lib\app\category\get::get(\dash\request::get('id'));
		\content_b1\tools::say($dataRow);
	}

}
?>
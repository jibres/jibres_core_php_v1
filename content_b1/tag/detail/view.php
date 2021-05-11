<?php
namespace content_b1\tag\detail;


class view
{

	public static function config()
	{
		$dataRow = \lib\app\tag\get::get(\dash\request::get('id'));
		\content_b1\tools::say($dataRow);
	}

}
?>
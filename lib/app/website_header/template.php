<?php
namespace lib\app\website_header;

class template
{

	public static function list()
	{
		$list             = [];
		$list['header_1'] = self::header_1();

		return $list;
	}


	private static function header_1
	{
		$header_1 =
		[
			'contain' => ['logo', 'header_menu_1', 'header_desc'],
		];

		return $header_1;
	}


}
?>
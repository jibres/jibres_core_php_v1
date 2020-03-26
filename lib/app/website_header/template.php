<?php
namespace lib\app\website_header;

class template
{

	public static function list()
	{
		$list             = [];
		$list['header_1'] = self::header_1();
		$list['header_2'] = self::header_2();

		return $list;
	}


	private static function header_1()
	{
		$header_1 =
		[
			'title'        => T_("Header #1"),
			'desc'         => T_("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud  xercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint  ccaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."),
			'sample_image' => \dash\url::logo(),
			'css_file'     => 'the css file location addr',
			'contain'      => ['logo', 'header_menu_1', 'header_description'],
		];

		return $header_1;
	}



	private static function header_2()
	{
		$header_2 =
		[
			'title'        => T_("Header #2"),
			'desc'         => T_("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud  xercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint  ccaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."),
			'sample_image' => \dash\url::logo(),
			'css_file'     => 'the css file location addr',
			'contain'      => ['logo', 'header_menu_2', 'header_description'],
		];

		return $header_2;
	}


}
?>
<?php
namespace content_a\product\variants;


class model
{
	public static function getPost()
	{
		$args =
		[
			'optionname1'  => \dash\request::post('optionname1'),
			'optionname2'  => \dash\request::post('optionname2'),
			'optionname3'  => \dash\request::post('optionname3'),
			'optionvalue1' => \dash\request::post('optionvalue1'),
			'optionvalue2' => \dash\request::post('optionvalue2'),
			'optionvalue3' => \dash\request::post('optionvalue3'),
		];

		return $args;
	}


	public static function post()
	{
		$request         = self::getPost();

		\lib\app\product\variants::set($request, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}

}
?>
